/* global Module, importScripts */
// JavaScript Document
// Worker DDS Version 26 - Stabilité maximale pour ramassage différé

let history = []
let log = {}
log.remainCards = ''
log.currentTrickCards = []
log.trumps = ''
log.leader = ''
log.currentTrickLeader = ''
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
const players = ['north', 'east', 'south', 'west']

self.Module = {
  onAbort: function () {
    self.postMessage('failed')
  },
  onRuntimeInitialized: function () {
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
      let msg, r1, dealstr, tmp
      const trickLeader = log.leader

      if (requestAction === 'm') {
        dealstr = event.data.dealstr
        r1 = res(
          dealstr,
          null,
          requestAction,
          null,
          event.data.vulstr,
          null,
          event.data.leadstr || null,
          null,
          '' + event.data.sockref,
          null,
        )
        msg = {
          result: JSON.stringify(
            Object.assign(JSON.parse(r1), {
              sess: { pbn: dealstr, leadstr: event.data.leadstr },
            }),
          ),
          context: event.data.context,
        }
      } else if (requestAction === 'b') {
        const vul = convertVulStr(event.data.vulstr)
        const scores = []
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
          scores.push(getBestScore(JSON.parse(r1)))
        }
        tmp = JSON.parse(r1)
        Object.assign(tmp.sess, {
          trumps: event.data.trumps,
          scores: scores,
          sockref: event.data.sockref,
          status: 0,
        })
        tmp.vul = vul
        tmp.requesttoken = event.data.requesttoken
        msg = { result: JSON.stringify(tmp), context: event.data.context }
      } else if (requestAction === 'a') {
        log.trumps = event.data.trumps
        log.leader = event.data.leader
        dealstr = event.data.pbn
        r1 = res(
          dealstr,
          log.trumps,
          requestAction,
          log.leader,
          null,
          event.data.cards,
          null,
          null,
          null,
          null,
        )
        msg = { result: r1, context: event.data.context }
      } else if (requestAction === 'u') {
        if (history.length > 0) {
          log = history.pop()
          msg = log.msg
        } else {
          msg = {
            result: JSON.stringify({
              sess: { status: 207, sockref: event.data.sockref },
            }),
            context: { request: 'u' },
          }
        }
        self.postMessage(msg)
        return
      } else {
        let currentRequest = requestAction
        if (currentRequest === 'g') {
          history = []
          log = {
            trumps: event.data.trumps.toUpperCase(),
            leader: event.data.leader,
            remainCards: event.data.pbn,
            currentTrickCards: [],
            tricksNS: 0,
            tricksEW: 0,
            trick: 0,
            trickCard: 0,
            currentTrickLeader: event.data.leader,
          }
          dealstr = log.remainCards
        } else if (currentRequest === 'C') {
          // COMMANDE 'C' : Ramassage et Calcul du vainqueur (Uniquement si complet)
          if (log.currentTrickCards.length === 4) {
            evaluateTrick()
            log.currentTrickCards = []
            log.trickCard = 0
          }
          currentRequest = 'g'
          dealstr = log.remainCards
        } else {
          history.push(JSON.parse(JSON.stringify(log)))
          currentRequest = currentRequest.toUpperCase()
          if (log.currentTrickCards.length === 0) {
            log.currentTrickLeader = log.leader
          }
          log.currentTrickCards.push(currentRequest)
          log.trickCard++
          dealstr = log.remainCards
          currentRequest = log.currentTrickCards.join('')

          if (log.currentTrickCards.length === 4) {
            r1 = res(
              dealstr,
              log.trumps,
              currentRequest,
              log.currentTrickLeader,
              null,
              null,
              null,
              null,
              null,
              null,
            )
            dealstr = JSON.parse(r1).sess.pbn
            log.remainCards = dealstr
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
        tmp = JSON.parse(r1)
        tmp.sess.trumps = log.trumps
        tmp.sess.leader = log.currentTrickLeader || trickLeader
        tmp.sess.currentTrick =
          tmp.sess.currentTrick ||
          log.currentTrickCards.map((s) => [
            suitStr.indexOf(s[0]),
            cardStr.indexOf(s[1]),
          ])
        tmp.sess.cards = tmp.sess.cards || []

        if (tmp.sess.status !== -2) {
          const currentTrick = tmp.sess.currentTrick || []
          const nxtplayer =
            (playDir.indexOf(log.leader) + currentTrick.length) % 4
          tmp.sess.player = players[nxtplayer]
          tmp.sess.remaining = convertPBN(tmp.sess.pbn)
          log.remainCards = tmp.sess.pbn
          tmp.sess.status = 0
        } else {
          tmp.sess.status = 208
          tmp.sess.remaining = convertPBN(log.remainCards)
          tmp.sess.currentTrick = log.currentTrickCards.map((s) => [
            suitStr.indexOf(s[0]),
            cardStr.indexOf(s[1]),
          ])
        }
        Object.assign(tmp.sess, {
          tricksNS: log.tricksNS,
          tricksEW: log.tricksEW,
          trick: log.trick,
          trickCard: log.trickCard,
          sockref: event.data.sockref,
        })
        tmp.requesttoken = event.data.requesttoken
        msg = { result: JSON.stringify(tmp), context: event.data.context }
        log.msg = msg
      }
      self.postMessage(msg)
    })
  },
}

importScripts('dds.js')
function convertVulStr(v) {
  const vul = ['None', 'All', 'NS', 'EW']
  for (let i = 0; i < vul.length; i++) {
    if (vul[i].toUpperCase() === v.toUpperCase()) {
      return i
    }
  }
  return -1
}
function getBestScore(m) {
  let s = 0
  if (m.sess.cards) {
    for (let i = 0; i < m.sess.cards.length; i++) {
      if (m.sess.cards[i].score > s) {
        s = m.sess.cards[i].score
      }
    }
  }
  return 13 - s
}
function convertPBN(p) {
  const cardNames = '23456789TJQKA',
    res = []
  const hands = p.substring(2).split(' ')
  for (let i = 0; i < 4; i++) {
    const j = (i + 1) % 4
    const suits = [],
      handSuits = hands[j].split('.')
    for (let k = 0; k < 4; k++) {
      const values = [],
        s = handSuits[k]
      for (let m = 0; m < s.length; m++) {
        values.push(cardNames.indexOf(s.charAt(m)))
      }
      suits.push(values)
    }
    res.push(suits)
  }
  return res
}
function evaluateTrick() {
  if (log.currentTrickCards.length !== 4) {
    return
  }
  const suitsOrder = 'SHDC',
    facesOrder = '23456789TJQKA'
  const trumpSuit = suitsOrder.indexOf(log.trumps.toUpperCase())
  let dir = 0,
    trickSuit = -1,
    lastTrump = -1,
    maxFace = -1
  for (let i = 0; i < 4; i++) {
    const card = log.currentTrickCards[i]
    if (!card) {
      continue
    }
    const suit = suitsOrder.indexOf(card.charAt(0)),
      face = facesOrder.indexOf(card.charAt(1))
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
  const curlead = (playDir.indexOf(log.leader) + dir) % 4
  log.leader = playDir.charAt(curlead)
  log.player = log.leader
  if (log.leader === 'n' || log.leader === 's') {
    log.tricksNS++
  } else {
    log.tricksEW++
  }
  log.trick++
}
