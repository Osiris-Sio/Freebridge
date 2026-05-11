/**
 * Fichier : engine.js
 * Rôle : Moteur de simulation. Calcule les scores et gère le déroulement du jeu.
 */

// Utilitaire simple pour copier un objet proprement
const clone = (obj) => JSON.parse(JSON.stringify(obj))
function simulateGame(parsed) {
  const states = []

  // Configuration initiale de la donne
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

  // Détermination de l'atout si le contrat est déjà fourni
  if (state.contract) {
    const match = state.contract.match(/(\d)(N|S|H|D|C)/i)
    if (match) {
      state.trump =
        match[2].toUpperCase() === 'N' ? null : match[2].toUpperCase()
    }
  }

  // --- TRAITEMENT DES ENCHÈRES ---
  // On parcourt les tokens pour traiter toutes les enchères d'un coup
  for (let i = 0; i < parsed.tokens.length; i++) {
    const t = parsed.tokens[i]
    if (t.type === 'bid') {
      if (state.phase === 'bidding') {
        state.bidding.push({ player: state.turn, bid: t.value })
        state.turn = getLHO(state.turn)

        // Vérification fin des enchères
        const nonPasses = state.bidding.filter(
          (b) => b.bid.toUpperCase() !== 'P' && b.bid.toUpperCase() !== 'PASS',
        )
        const last3 = state.bidding.slice(-3)
        const last3Pass =
          last3.length === 3 &&
          last3.every(
            (b) =>
              b.bid.toUpperCase() === 'P' || b.bid.toUpperCase() === 'PASS',
          )
        const last4 = state.bidding.slice(-4)
        const last4Pass =
          last4.length === 4 &&
          last4.every(
            (b) =>
              b.bid.toUpperCase() === 'P' || b.bid.toUpperCase() === 'PASS',
          )

        let auctionOver = false
        if (nonPasses.length > 0 && last3Pass) {
          auctionOver = true // 3 passes après au moins une vraie annonce
        } else if (nonPasses.length === 0 && last4Pass) {
          auctionOver = true // 4 passes d'entrée
        }

        // Si les enchères sont terminées, on passe en mode jeu de la carte
        if (auctionOver) {
          state.phase = 'play'
          if (nonPasses.length > 0) {
            const lastBid = nonPasses[nonPasses.length - 1]
            state.contract = lastBid.bid
            const match = state.contract.match(/(\d)(N|S|H|D|C)/i)
            if (match) {
              // Détermine l'atout
              state.trump =
                match[2].toUpperCase() === 'N' ? null : match[2].toUpperCase()
            }
            const denom = match ? match[2].toUpperCase() : null // Détermine l'atout en toute lettre
            const team = ['N', 'S'].includes(lastBid.player) // Détermine le déclarant
              ? ['N', 'S']
              : ['E', 'W']
            const teamBids = nonPasses.filter(
              (b) =>
                team.includes(b.player) &&
                b.bid.toUpperCase().includes(denom || 'N'),
            )

            // Si le déclarant n'est pas trouvé, on le met comme dernière personne qui a parlé
            if (teamBids.length > 0) {
              state.declarer = teamBids[0].player
            } else {
              state.declarer = lastBid.player
            }
          } else {
            state.contract = 'Pass'
          }

          // On détermine le premier joueur qui doit jouer
          if (state.declarer) {
            state.turn = getLHO(state.declarer)
          }
        }
      }
    } else if (t.type === 'comment' && state.phase === 'bidding') {
      // On capture les commentaires pendant les enchères pour l'état initial
      const formattedValue = formatSymbols(t.value)
      if (state.displayComment) {
        state.displayComment += '<br><br>' + formattedValue
      } else {
        state.displayComment = formattedValue
      }
    }
  }

  // Sauvegarder l'état initial (Enchères complétées)
  states.push(JSON.parse(JSON.stringify(state)))

  // --- TRAITEMENT DU JEU DE LA CARTE ---
  for (let i = 0; i < parsed.tokens.length; i++) {
    let t = parsed.tokens[i]
    if (t.type !== 'play' && t.type !== 'comment') continue
    if (
      t.type === 'comment' &&
      i < parsed.tokens.findIndex((tok) => tok.type === 'play')
    ) {
      // Déjà géré ou ignoré si avant le premier pli
      continue
    }

    // Créer un nouvel état basé sur le précédent
    const newState = JSON.parse(JSON.stringify(states[states.length - 1]))
    newState.lastAction = null
    newState.trickWinner = null

    if (t.type === 'comment') {
      const formattedValue = formatSymbols(t.value)
      // On met à jour le dernier état au lieu d'en créer un nouveau pour un commentaire seul
      states[states.length - 1].displayComment = formattedValue
      continue
    } else if (t.type === 'play') {
      // Retirer la carte de la main du joueur
      const hand = newState.hands[newState.turn]
      let cardIdx = hand
        ? hand.findIndex(
            (c) => c.suit === t.value.suit && c.rank === t.value.rank,
          )
        : -1

      // Logique des fichiers PBN non standards (Colonnes fixes)
      if (cardIdx === -1 && newState.currentTrick.length === 0) {
        const playTokenIndices = []
        for (
          let j = i;
          j < parsed.tokens.length && playTokenIndices.length < 4;
          j++
        ) {
          if (parsed.tokens[j].type === 'play') {
            playTokenIndices.push(j)
          }
        }

        if (playTokenIndices.length === 4) {
          // Déterminer les vrais propriétaires des 4 cartes
          const cards = playTokenIndices.map((idx) => parsed.tokens[idx].value)
          const owners = []
          for (const c of cards) {
            const owner = PLAYERS.find(
              (p) =>
                newState.hands[p] &&
                newState.hands[p].some(
                  (hc) => hc.suit === c.suit && hc.rank === c.rank,
                ),
            )
            owners.push(owner)
          }

          if (owners.every((o) => o) && new Set(owners).size === 4) {
            const expectedOrder = [
              newState.turn,
              getLHO(newState.turn),
              getLHO(getLHO(newState.turn)),
              getLHO(getLHO(getLHO(newState.turn))),
            ]

            const newCardValues = []
            for (const expectedPlayer of expectedOrder) {
              const idx = owners.indexOf(expectedPlayer)
              newCardValues.push(cards[idx])
            }
            for (let k = 0; k < 4; k++) {
              parsed.tokens[playTokenIndices[k]].value = newCardValues[k]
            }

            t = parsed.tokens[i]
            cardIdx = hand.findIndex(
              (c) => c.suit === t.value.suit && c.rank === t.value.rank,
            )
          }
        }
      }

      if (cardIdx !== -1) {
        hand.splice(cardIdx, 1)
      } else {
        console.warn(
          `Carte introuvable pour le joueur ${newState.turn}: ${t.value.suit}${t.value.rank}`,
        )
      }

      // Poser la carte sur la table (dans le pli courant)
      newState.currentTrick.push({ player: newState.turn, card: t.value })
      newState.lastAction = {
        type: 'play',
        player: newState.turn,
        card: t.value,
      }

      // Si le pli est complet (4 cartes)
      if (newState.currentTrick.length === 4) {
        const leadSuit = newState.currentTrick[0].card.suit
        let winner = newState.currentTrick[0].player
        let bestVal = cardValue(newState.currentTrick[0].card.rank)

        // Si l'entame était un atout, la couleur est déjà coupée
        let trumped =
          newState.trump && leadSuit === newState.trump ? true : false

        // Détermination du gagnant du pli
        for (let k = 1; k < 4; k++) {
          const c = newState.currentTrick[k].card
          const p = newState.currentTrick[k].player
          const val = cardValue(c.rank)

          if (newState.trump && c.suit === newState.trump) {
            // Coupe ou surcoupe
            if (!trumped || val > bestVal) {
              trumped = true
              bestVal = val
              winner = p
            }
          } else if (!trumped && c.suit === leadSuit) {
            // Fournit à la couleur demandée et gagne
            if (val > bestVal) {
              bestVal = val
              winner = p
            }
          }
        }

        // Mise à jour du score
        if (['N', 'S'].includes(winner)) {
          newState.tricksWon.NS++
        } else {
          newState.tricksWon.EW++
        }

        newState.trickWinner = winner
        newState.turn = winner // Le gagnant entame le pli suivant

        // Sauvegarde de l'état "Tableau avec 4 cartes jouées"
        states.push(JSON.parse(JSON.stringify(newState)))

        // Nettoyage de la table pour le pli suivant
        const clearedState = JSON.parse(JSON.stringify(newState))
        clearedState.currentTrick = []
        clearedState.lastAction = null
        clearedState.trickWinner = null

        // Sauvegarde de l'état "Tableau vide" (afin d'éviter que le prochain joueur ne pose sa carte sur l'ancien pli)
        states.push(clearedState)
      } else {
        // Le pli n'est pas fini, on passe au joueur suivant (à gauche)
        newState.turn = getLHO(newState.turn)
        states.push(newState)
      }
    }
  }

  return states
}
