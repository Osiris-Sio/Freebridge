/* global importScripts */
// JavaScript Document
// var playedCards = new Array();
const history = [];

const log = {};
log.remainCards = '';
log.currentTrickCards = [];
log.trumps = '';
log.leader = '';
log.player = '';
log.tricksNS = 0;
log.tricksEW = 0;
log.trick = 0;
log.trickCard = 0;
log.lastSuit = 0;
log.lastCard = 0;

const playDir = 'nesw';
const cardStr = '23456789TJQKA';
const suitStr = 'SHDC';
const players = [];

const Module = {
  onAbort: function () {
    postMessage('failed');
  },
  onRuntimeInitialized: function () {
    players.push('north');
    players.push('east');
    players.push('south');
    players.push('west');

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
      'string'
    ]);
    postMessage('initialised');

    addEventListener('message', function (event) {
      const requestCtx = event.data.context.request;
      let msg;
      let r1;
      let dealstr;

      if (requestCtx === 'm') {
        dealstr = event.data.dealstr;
        const vulstr = event.data.vulstr;
        let leadstr = event.data.leadstr;
        if (leadstr.length === 0) {
          leadstr = null;
        }
        const sockref = '' + event.data.sockref;

        r1 = res(dealstr, null, requestCtx, null, vulstr, null, leadstr, null, sockref, null);
        msg = {};
        r1 = JSON.parse(r1);
        r1.sess.pbn = dealstr;
        r1.sess.leadstr = event.data.leadstr;
        msg.result = JSON.stringify(r1);
        msg.context = event.data.context;
      } else if (requestCtx === 'b') {
        const vul = convertVulStr(event.data.vulstr);
        const scores = [];

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
            null
          );
          const tmp = JSON.parse(r1);
          scores.push(getBestScore(tmp));
        }

        msg = {};
        msg.result = r1;
        const tmp = JSON.parse(msg.result);
        tmp.sess.trumps = event.data.trumps;
        tmp.sess.scores = scores;
        tmp.vul = vul;

        delete tmp.sess.cards;
        delete tmp.sess.currentTrick;
        tmp.sess.sockref = event.data.sockref;
        tmp.requesttoken = event.data.requesttoken;

        msg.result = JSON.stringify(tmp);
        msg.context = event.data.context;
      } else if (requestCtx === 'a') {
        const cards = event.data.cards;
        log.trumps = event.data.trumps;
        log.leader = event.data.leader;
        dealstr = event.data.pbn;

        r1 = res(dealstr, log.trumps, requestCtx, log.leader, null, cards, null, null, null, null);
        msg = {};
        msg.result = r1;
        msg.context = event.data.context;
      } else if (requestCtx === 'q') {
        return; // Nothing to do
      } else if (requestCtx === 'u') {
        if (history.length > 0) {
          Object.assign(log, history.pop());
          msg = log.msg;
        } else {
          r1 = { sess: { status: 207, sockref: event.data.sockref } };
          msg = { result: JSON.stringify(r1), context: { request: 'u' } };
        }

        postMessage(msg);
      } else {
        let request = requestCtx;
        if (requestCtx === 'g') {
          history.length = 0;
          log.trumps = event.data.trumps.toUpperCase();
          log.leader = event.data.leader;
          dealstr = event.data.pbn;
          log.remainCards = dealstr;
          log.currentTrickCards = [];
          log.tricksNS = 0;
          log.tricksEW = 0;
          log.trick = 0;
          log.trickCard = 0;
        } else {
          history.push(JSON.parse(JSON.stringify(log)));

          request = request.toUpperCase();
          log.lastSuit = suitStr.indexOf(request[0]);
          log.lastCard = cardStr.indexOf(request[1]);
          dealstr = log.remainCards;
          log.currentTrickCards.push(request);
          log.trickCard++;

          let str = '';

          for (let i = 0; i < log.currentTrickCards.length; i++) {
            str += log.currentTrickCards[i];
          }

          request = str;

          if (log.currentTrickCards.length === 4) {
            // Trick played. Work out who won it
            evaluateTrick();
            // Call DDummy just to remove this card from the pbn
            r1 = res(dealstr, log.trumps, request, log.leader, null, null, null, null, null, null);
            r1 = JSON.parse(r1);
            dealstr = r1.sess.pbn;
            log.remainCards = r1.sess.pbn;
            log.currentTrickCards = [];
            log.trickCard = 0;
            request = 'g';
          }
        }

        r1 = res(dealstr, log.trumps, request, log.leader, null, null, null, null, null, null);
        msg = {};
        msg.result = r1;
        const tmp = JSON.parse(msg.result);

        tmp.sess.trumps = log.trumps;
        tmp.sess.leader = log.leader;

        if (tmp.sess.status !== -2) {
          let nxtplayer = playDir.indexOf(log.leader) + tmp.sess.currentTrick.length;
          if (nxtplayer > 3) {
            nxtplayer = nxtplayer - 4;
          }
          tmp.sess.player = players[nxtplayer];
          tmp.sess.remaining = convertPBN(tmp.sess.pbn);
          log.remainCards = tmp.sess.pbn;
          tmp.sess.status = 0;
        } else {
          tmp.sess.status = 208;
          tmp.sess.errno = 0;
          tmp.sess.remaining = convertPBN(log.remainCards);
          tmp.sess.cards = [];
          tmp.sess.currentTrick = log.currentTrickCards;
          tmp.sess.sockref = event.data.sockref;
        }

        tmp.sess.tricksNS = log.tricksNS;
        tmp.sess.tricksEW = log.tricksEW;
        tmp.sess.trick = log.trick;
        tmp.sess.trickCard = log.trickCard;
        tmp.sess.lastSuit = log.lastSuit;
        tmp.sess.lastCard = log.lastCard;

        tmp.sess.sockref = event.data.sockref;
        tmp.requesttoken = event.data.requesttoken;

        msg.result = JSON.stringify(tmp);
        msg.context = event.data.context;
        log.msg = msg;
      }

      postMessage(msg);
    });
  }
};

importScripts('dds.js');

function convertVulStr(vulstr) {
  const vul = ['None', 'All', 'NS', 'EW'];

  const upperVulstr = vulstr.toUpperCase();

  for (let i = 0; i < vul.length; i++) {
    if (vul[i].toUpperCase() === upperVulstr) {
      return i;
    }
  }

  return -1;
}

function getBestScore(msg) {
  let score = 0;

  for (let i = 0; i < msg.sess.cards.length; i++) {
    const sobj = msg.sess.cards[i];

    if (sobj.score > score) {
      score = sobj.score;
    }
  }

  return 13 - score; // Number of tricks makeable by declarer for this suit with this leader
}

function convertPBN(pbn) {
  const localCardStr = '23456789TJQKA';
  const resArray = [];

  const hands = pbn.substring(2).split(' '); // West first

  for (let i = 0; i < 4; i++) {
    let j = i + 1; // Start with North hand first
    if (j > 3) {
      j = 0;
    }

    const suitsArray = [];
    const handStr = hands[j];
    const handSuits = handStr.split('.'); // Split into suits

    for (let k = 0; k < 4; k++) {
      const values = [];
      const suitText = handSuits[k];

      for (let m = 0; m < suitText.length; m++) {
        values.push(localCardStr.indexOf(suitText.charAt(m)));
      }

      suitsArray.push(values);
    }

    resArray.push(suitsArray);
  }

  return resArray;
}

function evaluateTrick() {
  const localSuitStr = 'SHDC';
  const localCardStr = '23456789TJQKA';
  const trumpIndex = localSuitStr.indexOf(log.trumps.toUpperCase());
  let winnerDir = 0;

  let trickSuit;
  let lastTrumpRank = -1;
  let maxFaceRank = -1;

  for (let i = 0; i < 4; i++) {
    const cardSuit = localSuitStr.indexOf(log.currentTrickCards[i].charAt(0));
    const cardFace = localCardStr.indexOf(log.currentTrickCards[i].charAt(1));

    if (i === 0) {
      trickSuit = cardSuit;
      maxFaceRank = cardFace;

      if (cardSuit === trumpIndex) {
        lastTrumpRank = cardFace;
      }
    } else {
      if (lastTrumpRank === -1) {
        if (cardSuit === trumpIndex) {
          lastTrumpRank = cardFace;
          winnerDir = i;
        } else {
          if (cardFace > maxFaceRank && cardSuit === trickSuit) {
            maxFaceRank = cardFace;
            winnerDir = i;
          }
        }
      } else {
        if (cardSuit === trumpIndex && cardFace > lastTrumpRank) {
          lastTrumpRank = cardFace;
          winnerDir = i;
        }
      }
    }
  }

  let curlead = playDir.indexOf(log.leader);

  curlead = curlead + winnerDir;
  if (curlead > 3) {
    curlead = curlead - 4;
  }

  log.leader = playDir.charAt(curlead);
  log.player = playDir.charAt(curlead);

  if (log.leader === 'n' || log.leader === 's') {
    log.tricksNS++;
  } else {
    log.tricksEW++;
  }

  log.trick++;
}
