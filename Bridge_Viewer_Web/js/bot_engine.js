// Gestion de la logique de jeu interactive et du Bot DDS.
/* global simulateStep, updateUI, formatSymbols */
/* exported initDDS, checkBotTurn, playInteractiveCard */

/**
 * Initialisation du worker DDS (Double Dummy Solver).
 */
function initDDS() {
  if (window.ddsWorker) {
    return
  }

  // Création du worker pour les calculs asynchrones
  window.ddsWorker = new Worker('Bridge_Viewer_Web/js/calldds.js?v=5')

  window.ddsWorker.onmessage = function (e) {
    if (e.data === 'initialised') {
      window.ddsReady = true
      checkBotTurn()
    } else if (typeof e.data === 'object' && e.data.result) {
      const res = JSON.parse(e.data.result)
      const sess = res.sess || res

      // On ne traite que les réponses de type 'solve' (s) ou 'analyze' (a)
      if (e.data.context.request === 's' || e.data.context.request === 'a') {
        let cards = sess.cards || []

        // Conversion du format DDS "values" en liste de cartes plate si nécessaire
        if (cards.length > 0 && cards[0].values) {
          const flatCards = []
          cards[0].values.forEach((ranks, suit) => {
            ranks.forEach((rank) => flatCards.push({ suit, rank, score: 0 }))
          })
          cards = flatCards
        }

        if (cards.length > 0) {
          // Choix de la meilleure carte
          const best = cards.sort((a, b) => (b.score || 0) - (a.score || 0))[0]
          const suitStr = 'SHDC',
            rankStr = '23456789TJQKA'
          const card = { suit: suitStr[best.suit], rank: rankStr[best.rank] }
          if (card.rank === 'T') {
            card.rank = '10'
          }

          // Délai de simulation de réflexion
          setTimeout(() => {
            window.pendingPlay = false
            playInteractiveCard(card)
          }, 1000)
        } else {
          window.pendingPlay = false
        }
      }
    }
  }
}

/**
 * Vérifie si c'est au tour du Bot (Est ou Ouest) de jouer.
 */
function checkBotTurn() {
  const state = window.gameStates[window.gameStates.length - 1]

  if (window.gameMode !== 'play' || !window.ddsReady || window.pendingPlay) {
    return
  }

  if (state.phase === 'play' && (state.turn === 'E' || state.turn === 'W')) {
    window.pendingPlay = true

    const playedInTrick = state.currentTrick
      .map((c) => {
        const card = c.card || c
        const s = card.suit || ''
        const r = card.rank || ''
        return s + (r === '10' ? 'T' : r)
      })
      .join('')

    // On calcule le leader du pli
    const leader = (
      state.currentTrick.length > 0 ? state.currentTrick[0].player : state.turn
    ).toLowerCase()
    const pbn = handsToPBN(state.hands)

    // Appel au solveur
    window.ddsWorker.postMessage({
      context: { request: 's' },
      pbn: pbn,
      trumps: state.trump || 'N',
      leader: leader,
      cards: playedInTrick,
      sockref: 0,
    })
  } else {
    // Si ce n'est pas le tour du bot, on libère
    if (window.pendingPlay) {
      window.pendingPlay = false
    }
  }
}

/**
 * Exécute le jeu d'une carte.
 */
function playInteractiveCard(card) {
  // Si une carte est déjà en cours de jeu, on ignore
  if (window.pendingPlay) {
    return
  }
  window.pendingPlay = true

  // On récupère l'état actuel du jeu
  const state = window.gameStates[window.gameStates.length - 1]

  // On crée le token de jeu
  const playToken = { type: 'play', value: card }

  // On simule le coup
  const newStates = simulateStep(state, playToken)

  // Si on a de nouveaux états (fin de pli ou nouveau pli)
  if (newStates.length > 1) {
    // Fin de pli
    window.gameStates.push(newStates[0])
    window.currentStateIndex = window.gameStates.length - 1
    updateUI()

    // On attend 1.5 secondes avant de jouer la prochaine carte
    setTimeout(() => {
      window.gameStates.push(newStates[1])
      window.currentStateIndex = window.gameStates.length - 1
      updateUI()

      // On vérifie si la donne est terminée
      const lastState = newStates[1]
      if (
        lastState.hands.N.length === 0 &&
        lastState.hands.E.length === 0 &&
        lastState.hands.S.length === 0 &&
        lastState.hands.W.length === 0
      ) {
        checkGameResult(lastState) // Affiche le résultat final
        updateUI()
      }

      window.pendingPlay = false
      checkBotTurn() // Vérifie si c'est au tour du bot
    }, 1500)
  } else {
    // Pli en cours
    window.gameStates.push(newStates[0])
    window.currentStateIndex = window.gameStates.length - 1
    updateUI()

    setTimeout(() => {
      window.pendingPlay = false
      checkBotTurn()
    }, 500)
  }
}

/**
 * Calcule et affiche le résultat final.
 */
function checkGameResult(state) {
  // On récupère le niveau du contrat
  const contractLevel = parseInt(state.contract[0])
  if (isNaN(contractLevel)) {
    return
  }

  // On calcule le nombre de levées nécessaires
  const needed = 6 + contractLevel

  // On détermine l'équipe du déclarant
  const declarerTeam = ['N', 'S'].includes(state.declarer) ? 'NS' : 'EW'

  // On récupère le nombre de levées remportées par l'équipe
  const won = state.tricksWon[declarerTeam]

  // On affiche le résultat
  let msg = `<b>Partie terminée.</b> Le contrat était ${formatSymbols(state.contract)} par ${state.declarer}.<br>`
  msg +=
    won >= needed
      ? `<span style="color: green;">Contrat réussi ! (${won} levées)</span>`
      : `<span style="color: red;">Contrat chuté ! (${won} levées)</span>`
  state.displayComment = msg
  updateUI()
}

/**
 * Formatage PBN pour le solveur.
 */
function handsToPBN(hands) {
  const players = ['W', 'N', 'E', 'S']
  let pbn = 'W:'
  for (let i = 0; i < 4; i++) {
    const p = players[i]
    const hand = hands[p]
    const suits = ['S', 'H', 'D', 'C']
    suits.forEach((s, si) => {
      const cards = hand
        .filter((c) => c.suit === s)
        .map((c) => (c.rank === '10' ? 'T' : c.rank))
      pbn += cards.join('')
      if (si < 3) {
        pbn += '.'
      }
    })
    if (i < 3) {
      pbn += ' '
    }
  }
  return pbn
}
