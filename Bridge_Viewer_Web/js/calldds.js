// Worker DDS (Double Dummy Solver)
// Gère la communication avec la bibliothèque dds.js compilée en WASM.

/* global importScripts */

const gameHistory = []

const log = {
  remainCards: null,
  currentTrickCards: [],
  trumps: '',
  leader: '',
  player: '',
  tricksNS: 0,
  tricksEW: 0,
  trick: 0,
  trickCard: 0,
  lastSuit: 0,
  lastCard: 0,
}

const playDir = 'nesw'
const cardStr = '23456789TJQKA'
const suitStr = 'SHDC'
const players = []

// eslint-disable-next-line no-var
var Module = {
  onAbort: function () {
    self.postMessage('failed')
  },
  onRuntimeInitialized: function () {
    players.push('north', 'east', 'south', 'west')

    const res = Module.cwrap('handleDDSRequest', 'string', [
      'string',
      'string',
      'string',
      'string',
      'string',
      'string',
      'string',
      'string',
      'string',
      'string',
    ])
    self.postMessage('initialised')

    self.addEventListener('message', function (event) {
      const requestType = event.data.context.request
      let msgResult

      if (requestType === 'm') {
        const dealstr = event.data.dealstr
        const vulstr = event.data.vulstr
        const leadstr = event.data.leadstr || null
        const sockref = '' + event.data.sockref

        let r1 = res(
          dealstr,
          null,
          requestType,
          null,
          vulstr,
          null,
          leadstr,
          null,
          sockref,
          null,
        )
        msgResult = new Object()
        r1 = JSON.parse(r1)
        r1.sess.pbn = dealstr
        r1.sess.leadstr = event.data.leadstr
        msgResult.result = JSON.stringify(r1)
        msgResult.context = event.data.context
      } else if (requestType === 'b') {
        const vul = convertVulStr(event.data.vulstr)
        const scores = []

        for (let i = 0; i < 4; i++) {
          const r1 = res(
            event.data.dealstr,
            event.data.trumps,
            'g',
            playDir[i],
            null,
            null,
            null,
            null,
            null,
            null,
          )
          const tmp = JSON.parse(r1)
          scores.push(getBestScore(tmp))
        }

        msgResult = new Object()
        const r1 = res(
          event.data.dealstr,
          event.data.trumps,
          'g',
          'n',
          null,
          null,
          null,
          null,
          null,
          null,
        )
        const tmp = JSON.parse(r1)
        tmp.sess.trumps = event.data.trumps
        tmp.sess.scores = scores
        tmp.vul = vul
        delete tmp.sess.cards
        delete tmp.sess.currentTrick
        tmp.sess.sockref = event.data.sockref
        tmp.requesttoken = event.data.requesttoken
        msgResult.result = JSON.stringify(tmp)
        msgResult.context = event.data.context
      } else if (requestType === 's') {
        const cards = event.data.cards
        const trumps = event.data.trumps
        const leader = event.data.leader
        const dealstr = event.data.pbn

        // Appel principal au solveur
        let r1 = res(
          dealstr,
          trumps,
          cards || 'g',
          leader,
          null,
          cards || 'g',
          null,
          null,
          null,
          null,
        )

        // Fallback si aucun résultat
        if (
          r1.indexOf('"cards":[]') !== -1 ||
          r1.indexOf('"cards": []') !== -1
        ) {
          r1 = res(
            dealstr,
            trumps,
            's',
            leader,
            null,
            cards,
            null,
            null,
            null,
            null,
          )
        }

        msgResult = new Object()
        msgResult.result = r1
        msgResult.context = event.data.context
      } else if (requestType === 'a') {
        const cards = event.data.cards
        log.trumps = event.data.trumps
        log.leader = event.data.leader
        const r1 = res(
          event.data.pbn,
          log.trumps,
          requestType,
          log.leader,
          null,
          cards,
          null,
          null,
          null,
          null,
        )
        msgResult = new Object()
        msgResult.result = r1
        msgResult.context = event.data.context
      } else if (requestType === 'u') {
        if (gameHistory.length > 0) {
          const poppedLog = gameHistory.pop()
          Object.assign(log, poppedLog)
          msgResult = log.msg
        } else {
          const r1 = { sess: { status: 207, sockref: event.data.sockref } }
          msgResult = {
            result: JSON.stringify(r1),
            context: { request: 'u' },
          }
        }
        self.postMessage(msgResult)
      } else {
        let dealstrLocal

        if (requestType === 'g') {
          gameHistory.length = 0
          Object.assign(log, {
            trumps: event.data.trumps.toUpperCase(),
            leader: event.data.leader,
            remainCards: event.data.pbn,
            currentTrickCards: [],
            tricksNS: 0,
            tricksEW: 0,
            trick: 0,
            trickCard: 0,
          })
          dealstrLocal = event.data.pbn
        } else {
          gameHistory.push(JSON.parse(JSON.stringify(log)))
          const reqUpper = requestType.toUpperCase()
          log.lastSuit = suitStr.indexOf(reqUpper[0])
          log.lastCard = cardStr.indexOf(reqUpper[1])
          dealstrLocal = log.remainCards
          log.currentTrickCards.push(reqUpper)
          log.trickCard++

          const trickStr = log.currentTrickCards.join('')

          if (log.currentTrickCards.length === 4) {
            evaluateTrick()
            const rTrick = res(
              dealstrLocal,
              log.trumps,
              trickStr,
              log.leader,
              null,
              null,
              null,
              null,
              null,
              null,
            )
            const resParsed = JSON.parse(rTrick)
            dealstrLocal = resParsed.sess.pbn
            log.remainCards = resParsed.sess.pbn
            log.currentTrickCards = []
            log.trickCard = 0
          }
        }

        const finalReq =
          log.currentTrickCards.length > 0
            ? log.currentTrickCards.join('')
            : 'g'
        const r1Local = res(
          dealstrLocal,
          log.trumps,
          finalReq,
          log.leader,
          null,
          null,
          null,
          null,
          null,
          null,
        )
        msgResult = new Object()
        msgResult.result = r1Local
        const tmp = JSON.parse(msgResult.result)

        tmp.sess.trumps = log.trumps
        if (
          tmp.sess &&
          tmp.sess.status !== -2 &&
          log.leader &&
          tmp.sess.currentTrick
        ) {
          const nxtplayer =
            (playDir.indexOf(log.leader) + tmp.sess.currentTrick.length) % 4
          tmp.sess.player = players[nxtplayer]
          tmp.sess.remaining = convertPBN(tmp.sess.pbn)
          log.remainCards = tmp.sess.pbn
          tmp.sess.status = 0
        } else if (tmp.sess) {
          tmp.sess.status = 208
          tmp.sess.errno = 0
          tmp.sess.remaining = convertPBN(
            log.remainCards || 'W:.... .... .... ....',
          )
          tmp.sess.cards = []
          tmp.sess.currentTrick = log.currentTrickCards || []
          tmp.sess.sockref = event.data.sockref
        }

        tmp.sess.tricksNS = log.tricksNS
        tmp.sess.tricksEW = log.tricksEW
        tmp.sess.trick = log.trick
        tmp.sess.trickCard = log.trickCard
        tmp.sess.lastSuit = log.lastSuit
        tmp.sess.lastCard = log.lastCard
        tmp.sess.sockref = event.data.sockref
        tmp.requesttoken = event.data.requesttoken

        msgResult.result = JSON.stringify(tmp)
        msgResult.context = event.data.context
        log.msg = msgResult
      }

      if (msgResult) {
        self.postMessage(msgResult)
      }
    })
  },
}

importScripts('dds.js')

function convertVulStr(vulstr) {
  const vul = ['None', 'All', 'NS', 'EW']
  const upperVul = vulstr.toUpperCase()
  for (let i = 0; i < vul.length; i++) {
    if (vul[i].toUpperCase() === upperVul) {
      return i
    }
  }
  return -1
}

function getBestScore(msg) {
  let score = 0
  for (let i = 0; i < msg.sess.cards.length; i++) {
    if (msg.sess.cards[i].score > score) {
      score = msg.sess.cards[i].score
    }
  }
  return 13 - score
}

function convertPBN(pbn) {
  const cardRankStr = '23456789TJQKA'
  const resArray = []
  const hands = pbn.substring(2).split(' ')

  for (let i = 0; i < 4; i++) {
    const j = (i + 1) % 4
    const suits = []
    const handSuits = hands[j].split('.')

    for (let k = 0; k < 4; k++) {
      const values = []
      const suitRanks = handSuits[k]
      for (let m = 0; m < suitRanks.length; m++) {
        values.push(cardRankStr.indexOf(suitRanks.charAt(m)))
      }
      suits.push(values)
    }
    resArray.push(suits)
  }
  return resArray
}

function evaluateTrick() {
  const localSuitStr = 'SHDC'
  const localCardStr = '23456789TJQKA'
  const trumpSuit = localSuitStr.indexOf(log.trumps.toUpperCase())
  let dir = 0
  let trickSuit = -1
  let lastTrump = -1
  let maxFace = -1

  for (let i = 0; i < 4; i++) {
    const suit = localSuitStr.indexOf(log.currentTrickCards[i].charAt(0))
    const face = localCardStr.indexOf(log.currentTrickCards[i].charAt(1))

    if (i === 0) {
      trickSuit = suit
      maxFace = face
      if (suit === trumpSuit) {
        lastTrump = face
      }
    } else {
      if (lastTrump === -1) {
        if (suit === trumpSuit) {
          lastTrump = face
          dir = i
        } else if (face > maxFace && suit === trickSuit) {
          maxFace = face
          dir = i
        }
      } else if (suit === trumpSuit && face > lastTrump) {
        lastTrump = face
        dir = i
      }
    }
  }

  const curleadIndex = (playDir.indexOf(log.leader) + dir) % 4
  log.leader = log.player = playDir.charAt(curleadIndex)
  if (log.leader === 'n' || log.leader === 's') {
    log.tricksNS++
  } else {
    log.tricksEW++
  }
  log.trick++
}
