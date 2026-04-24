/* global Module, importScripts */
// JavaScript Document
// const playedCards = new Array() // Removed because unused
let history = []

let log = {}
log.remainCards = ''
log.currentTrickCards = []
log.trumps = ''
log.leader = ''
log.player = ''
log.tricksNS = 0
log.tricksEW = 0
log.trick = 0
log.trickCard = 0
log.lastSuit = 0
log.lastCard = 0

const playDir = 'nesw'
const cardStr = '23456789TJQKA'
const suitStr = 'SHDC'
const players = []

self.Module = {
  onAbort: function () {
    self.postMessage('failed')
  },
  onRuntimeInitialized: function () {
    players.push('north')
    players.push('east')
    players.push('south')
    players.push('west')

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
      const requestAction = event.data.context.request
      let msg
      let r1
      let dealstr
      let tmp

      if (requestAction === 'm') {
        dealstr = event.data.dealstr
        const vulstr = event.data.vulstr
        let leadstr = event.data.leadstr
        if (leadstr.length === 0) {
          leadstr = null
        }
        const sockref = '' + event.data.sockref

        r1 = res(
          dealstr,
          null,
          requestAction,
          null,
          vulstr,
          null,
          leadstr,
          null,
          sockref,
          null,
        )
        msg = {}
        r1 = JSON.parse(r1)
        r1.sess.pbn = dealstr
        r1.sess.leadstr = event.data.leadstr
        msg.result = JSON.stringify(r1)
        msg.context = event.data.context
      } else if (requestAction === 'b') {
        const vul = convertVulStr(event.data.vulstr)
        const scores = []

        // const starttime = Date.now() // Unused

        for (let i = 0; i < 4; i++) {
          r1 = res(
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
          tmp = JSON.parse(r1)
          scores.push(getBestScore(tmp))
        }

        // const elapsed = (Date.now() - starttime) / 1000 // Unused

        msg = {}
        msg.result = r1
        tmp = JSON.parse(msg.result)
        tmp.sess.trumps = event.data.trumps
        tmp.sess.scores = scores
        tmp.vul = vul

        delete tmp.sess.cards
        delete tmp.sess.currentTrick
        tmp.sess.sockref = event.data.sockref
        tmp.requesttoken = event.data.requesttoken

        msg.result = JSON.stringify(tmp)
        msg.context = event.data.context
      } else if (requestAction === 'a') {
        const cards = event.data.cards
        log.trumps = event.data.trumps
        log.leader = event.data.leader
        dealstr = event.data.pbn
        // const declarer = event.data.declarer // Unused
        // const names = event.data.names // Unused

        r1 = res(
          dealstr,
          log.trumps,
          requestAction,
          log.leader,
          null,
          cards,
          null,
          null,
          null,
          null,
        )
        msg = {}
        msg.result = r1
        msg.context = event.data.context
      } else if (requestAction === 'q') {
        return // Nothing to do
      } else if (requestAction === 'u') {
        if (history.length > 0) {
          log = history.pop()
          msg = log.msg
        } else {
          r1 = {}
          r1.sess = {}
          r1.sess.status = 207
          r1.sess.sockref = event.data.sockref
          msg = {}
          msg.result = JSON.stringify(r1)
          const context = {}
          context.request = 'u'
          msg.context = context
        }

        self.postMessage(msg)
      } else {
        let currentRequest = requestAction

        if (currentRequest === 'g') {
          history = []
          log = {}
          log.trumps = event.data.trumps.toUpperCase()
          log.leader = event.data.leader
          dealstr = event.data.pbn
          log.remainCards = dealstr
          log.currentTrickCards = []
          log.tricksNS = 0
          log.tricksEW = 0
          log.trick = 0
          log.trickCard = 0
        } else {
          history.push(log)
          log = JSON.parse(JSON.stringify(history[history.length - 1]))

          currentRequest = currentRequest.toUpperCase()
          log.lastSuit = suitStr.indexOf(currentRequest[0])
          log.lastCard = cardStr.indexOf(currentRequest[1])
          dealstr = log.remainCards
          log.currentTrickCards.push(currentRequest)
          log.trickCard++

          let combinedStr = ''

          for (let i = 0; i < log.currentTrickCards.length; i++) {
            combinedStr += log.currentTrickCards[i]
          }

          currentRequest = combinedStr

          if (log.currentTrickCards.length === 4) {
            // Trick played. Work out who won it
            evaluateTrick()
            // Call DDummy just to remove this card from the pbn
            r1 = res(
              dealstr,
              log.trumps,
              currentRequest,
              log.leader,
              null,
              null,
              null,
              null,
              null,
              null,
            )
            r1 = JSON.parse(r1)
            dealstr = r1.sess.pbn
            log.remainCards = r1.sess.pbn
            log.currentTrickCards = []
            log.trickCard = 0
            currentRequest = 'g'
          }
        }

        r1 = res(
          dealstr,
          log.trumps,
          currentRequest,
          log.leader,
          null,
          null,
          null,
          null,
          null,
          null,
        )
        msg = {}
        msg.result = r1
        tmp = JSON.parse(msg.result)

        tmp.sess.trumps = log.trumps
        tmp.sess.leader = log.leader

        if (tmp.sess.status !== -2) {
          let nxtplayer =
            playDir.indexOf(log.leader) + tmp.sess.currentTrick.length
          if (nxtplayer > 3) {
            nxtplayer = nxtplayer - 4
          }
          tmp.sess.player = players[nxtplayer]
          tmp.sess.remaining = convertPBN(tmp.sess.pbn)
          log.remainCards = tmp.sess.pbn
          tmp.sess.status = 0
        } else {
          tmp.sess.status = 208
          tmp.sess.errno = 0
          tmp.sess.remaining = convertPBN(log.remainCards)
          const cardsArray = []
          tmp.sess.cards = cardsArray
          tmp.sess.currentTrick = log.currentTrickCards
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

        msg.result = JSON.stringify(tmp)
        msg.context = event.data.context
        log.msg = msg
      }

      self.postMessage(msg)
    })
  },
}

importScripts('dds.js')

function convertVulStr(vulstr) {
  const vul = ['None', 'All', 'NS', 'EW']

  const upperVulStr = vulstr.toUpperCase()

  for (let i = 0; i < vul.length; i++) {
    if (vul[i].toUpperCase() === upperVulStr) {
      return i
    }
  }

  return -1
}

function getBestScore(msg) {
  let score = 0

  for (let i = 0; i < msg.sess.cards.length; i++) {
    const sobj = msg.sess.cards[i]

    if (sobj.score > score) {
      score = sobj.score
    }
  }

  return 13 - score // Number of tricks makeable by declarer for this suit with this leader
}

function convertPBN(pbn) {
  const cardNames = '23456789TJQKA'
  const res = []

  const pbnStr = pbn.substring(2) // Eliminate W:
  const hands = pbnStr.split(' ') // Gives an array of the four hands, West first

  for (let i = 0; i < 4; i++) {
    // For each hand
    let j = i + 1 // Start with North hand first
    if (j > 3) {
      j = 0
    }

    const suits = []
    const hand = hands[j]
    const handSuits = hand.split('.') // Split into suits

    for (let k = 0; k < 4; k++) {
      const values = []
      const suitChars = handSuits[k]

      for (let m = 0; m < suitChars.length; m++) {
        values.push(cardNames.indexOf(suitChars.charAt(m)))
      }

      suits.push(values)
    }

    res.push(suits)
  }

  return res
}

function evaluateTrick() {
  // Which direction won trick, and is on lead for the next trick ?
  const suitsOrder = 'SHDC'
  const facesOrder = '23456789TJQKA'
  const trumpSuit = suitsOrder.indexOf(log.trumps.toUpperCase())
  let dir = 0

  let trickSuit = -1
  let lastTrump = -1
  let maxFace = -1

  for (let i = 0; i < 4; i++) {
    const suit = suitsOrder.indexOf(log.currentTrickCards[i].charAt(0))
    const face = facesOrder.indexOf(log.currentTrickCards[i].charAt(1))

    if (i === 0) {
      trickSuit = suit
      maxFace = face

      if (suit === trumpSuit) {
        lastTrump = face
      }
    } else {
      if (lastTrump === -1) {
        // Trump not played yet
        if (suit === trumpSuit) {
          lastTrump = face
          dir = i
        } else {
          if (face > maxFace && suit === trickSuit) {
            maxFace = face
            dir = i
          }
        }
      } else {
        // A trump has been played, so can only win trick by overruff
        if (suit === trumpSuit && face > lastTrump) {
          lastTrump = face
          dir = i
        }
      }
    }
  }

  let curlead = playDir.indexOf(log.leader)

  curlead = curlead + dir
  if (curlead > 3) {
    curlead = curlead - 4
  }

  log.leader = playDir.charAt(curlead)
  log.player = playDir.charAt(curlead)

  if (log.leader === 'n' || log.leader === 's') {
    log.tricksNS++
  } else {
    log.tricksEW++
  }

  log.trick++
}
