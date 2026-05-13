/**
 * Moteur de simulation de Bridge.
 * Calcule le déroulement du jeu et les scores.
 */

/* global getLHO, formatSymbols, cardValue */
/* exported simulateGame, simulateStep */

const clone = (obj) => JSON.parse(JSON.stringify(obj))

/**
 * Simule toute la partie à partir des données parsées.
 */
function simulateGame(parsed) {
  const states = []

  const state = {
    hands: clone(parsed.initialHands),
    bidding: [],
    currentTrick: [],
    tricksWon: { NS: 0, EW: 0 },
    turn: parsed.dealer,
    phase: 'bidding',
    contract: parsed.contract,
    declarer: parsed.declarer,
    trump: null,
    displayComment: '',
    dealer: parsed.dealer,
    vul: parsed.vul,
    lastAction: null,
    trickWinner: null,
  }

  // Initialisation si le contrat est déjà connu (ex: PBN statique)
  if (state.contract && state.contract !== 'Pass') {
    const match = state.contract.match(/(\d)(N|S|H|D|C)/i)
    if (match) {
      state.trump =
        match[2].toUpperCase() === 'N' ? null : match[2].toUpperCase()
      state.phase = 'play'
      if (state.declarer) {
        state.turn = getLHO(state.declarer)
      }
    }
  }

  // --- TRAITEMENT DES ENCHÈRES ---
  parsed.tokens
    .filter((t) => t.type === 'bid')
    .forEach((t) => {
      if (state.phase !== 'bidding') {
        return
      }

      state.bidding.push({ player: state.turn, bid: t.value })
      state.turn = getLHO(state.turn)

      // Logique de fin d'enchères
      const bids = state.bidding.map((b) => b.bid.toUpperCase())
      const nonPasses = bids.filter((b) => b !== 'P' && b !== 'PASS')
      const last3 = bids.slice(-3)
      const last4 = bids.slice(-4)

      const auctionOver =
        (nonPasses.length > 0 &&
          last3.length === 3 &&
          last3.every((b) => b === 'P' || b === 'PASS')) ||
        (nonPasses.length === 0 &&
          last4.length === 4 &&
          last4.every((b) => b === 'P' || b === 'PASS'))

      if (auctionOver) {
        state.phase = 'play'
        if (nonPasses.length > 0) {
          const lastRealBid = state.bidding
            .filter(
              (b) =>
                b.bid.toUpperCase() !== 'P' && b.bid.toUpperCase() !== 'PASS',
            )
            .pop()
          state.contract = lastRealBid.bid
          const match = state.contract.match(/(\d)(N|S|H|D|C)/i)
          const denom = match ? match[2].toUpperCase() : 'N'
          state.trump = denom === 'N' ? null : denom

          const team = ['N', 'S'].includes(lastRealBid.player)
            ? ['N', 'S']
            : ['E', 'W']
          const firstOfTeam = state.bidding.find(
            (b) =>
              team.includes(b.player) && b.bid.toUpperCase().includes(denom),
          )
          state.declarer = firstOfTeam ? firstOfTeam.player : lastRealBid.player
          state.turn = getLHO(state.declarer)
        } else {
          state.contract = 'Pass'
        }
      }
    })

  // Premier état (début du jeu de la carte)
  states.push(clone(state))

  // --- TRAITEMENT DU JEU DE LA CARTE ---
  parsed.tokens.forEach((t) => {
    if (t.type !== 'play' && t.type !== 'comment') {
      return
    }

    if (t.type === 'comment') {
      states[states.length - 1].displayComment = formatSymbols(t.value)
    } else {
      states.push(...simulateStep(states[states.length - 1], t))
    }
  })

  return states
}

/**
 * Simule une seule carte jouée.
 */
function simulateStep(prevState, t) {
  const states = []
  const newState = clone(prevState)
  newState.lastAction = { type: 'play', player: newState.turn, card: t.value }
  newState.trickWinner = null

  // Retrait de la carte
  const hand = newState.hands[newState.turn]
  const cardIdx = hand
    ? hand.findIndex((c) => c.suit === t.value.suit && c.rank === t.value.rank)
    : -1
  if (cardIdx !== -1) {
    hand.splice(cardIdx, 1)
  }

  newState.currentTrick.push({ player: newState.turn, card: t.value })

  if (newState.currentTrick.length === 4) {
    // Calcul du gagnant du pli
    const leadSuit = newState.currentTrick[0].card.suit
    let winner = newState.currentTrick[0].player
    let bestVal = cardValue(newState.currentTrick[0].card.rank)
    let trumped = newState.trump && leadSuit === newState.trump

    for (let k = 1; k < 4; k++) {
      const c = newState.currentTrick[k].card
      const p = newState.currentTrick[k].player
      const val = cardValue(c.rank)

      if (newState.trump && c.suit === newState.trump) {
        if (!trumped || val > bestVal) {
          trumped = true
          bestVal = val
          winner = p
        }
      } else if (!trumped && c.suit === leadSuit) {
        if (val > bestVal) {
          bestVal = val
          winner = p
        }
      }
    }

    newState.tricksWon[['N', 'S'].includes(winner) ? 'NS' : 'EW']++
    newState.trickWinner = winner
    newState.turn = winner
    states.push(clone(newState))

    // État avec table vide
    const cleared = clone(newState)
    cleared.currentTrick = []
    cleared.lastAction = null
    cleared.trickWinner = null
    states.push(cleared)
  } else {
    newState.turn = getLHO(newState.turn)
    states.push(newState)
  }

  return states
}
