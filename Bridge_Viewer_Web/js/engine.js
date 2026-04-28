/**
 * Fichier : engine.js
 * Rôle : Moteur de simulation du jeu. Génère l'historique complet des états du jeu (un état par action).
 */

/**
 * Simule la partie entière à partir des données extraites du fichier.
 * @param {Object} parsed - Les données extraites (initialHands, tokens, etc.)
 * @returns {Array} Tableau contenant tous les états successifs de la partie (pour permettre le retour en arrière)
 */
function simulateGame(parsed) {
  const states = []

  // État initial de la partie
  const state = {
    hands: JSON.parse(JSON.stringify(parsed.initialHands)),
    bidding: [],
    currentTrick: [],
    tricksWon: { NS: 0, EW: 0 },
    turn: parsed.dealer, // À qui le tour de parler/jouer
    phase: 'bidding', // 'bidding' (enchères) ou 'play' (jeu de la carte)
    contract: parsed.contract,
    declarer: parsed.declarer,
    trump: null, // Atout (S, H, D, C ou null pour SA)
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

  // Sauvegarder l'état initial
  states.push(JSON.parse(JSON.stringify(state)))

  let activeCommentText = ''
  let lastCommentedStateIndex = -1

  // Parcours de toutes les actions (commentaires, enchères, cartes jouées)
  for (let i = 0; i < parsed.tokens.length; i++) {
    let t = parsed.tokens[i]
    // Créer un nouvel état basé sur le précédent
    const newState = JSON.parse(JSON.stringify(states[states.length - 1]))
    newState.lastAction = null
    newState.trickWinner = null

    if (t.type === 'comment') {
      // Gestion de la persistance des commentaires (colle les commentaires consécutifs)
      if (lastCommentedStateIndex === states.length - 1) {
        activeCommentText += '<br><br>' + t.value
      } else {
        activeCommentText = t.value
        lastCommentedStateIndex = states.length - 1
      }
      states[states.length - 1].displayComment = activeCommentText
      continue // Ne pas créer d'état supplémentaire juste pour un commentaire
    } else if (t.type === 'bid') {
      if (newState.phase === 'bidding') {
        newState.bidding.push({ player: newState.turn, bid: t.value })
        newState.lastAction = {
          type: 'bid',
          player: newState.turn,
          bid: t.value,
        }

        // Passer au joueur suivant
        newState.turn = getLHO(newState.turn)

        // --- Vérification de la fin des enchères ---
        const nonPasses = newState.bidding.filter(
          (b) => b.bid.toUpperCase() !== 'P' && b.bid.toUpperCase() !== 'PASS',
        )
        const last3 = newState.bidding.slice(-3)
        const last3Pass =
          last3.length === 3 &&
          last3.every(
            (b) =>
              b.bid.toUpperCase() === 'P' || b.bid.toUpperCase() === 'PASS',
          )
        const last4 = newState.bidding.slice(-4)
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

        if (auctionOver) {
          newState.phase = 'play' // Passage au jeu de la carte
          if (nonPasses.length > 0) {
            const lastBid = nonPasses[nonPasses.length - 1]
            newState.contract = lastBid.bid
            const match = newState.contract.match(/(\d)(N|S|H|D|C)/i)
            if (match) {
              newState.trump =
                match[2].toUpperCase() === 'N' ? null : match[2].toUpperCase()
            }

            // Déduction du déclarant (le premier de l'équipe à avoir nommé la couleur du contrat final)
            const denom = match ? match[2].toUpperCase() : null
            const team = ['N', 'S'].includes(lastBid.player)
              ? ['N', 'S']
              : ['E', 'W']
            const teamBids = nonPasses.filter(
              (b) =>
                team.includes(b.player) &&
                b.bid.toUpperCase().includes(denom || 'N'),
            )

            if (teamBids.length > 0) {
              newState.declarer = teamBids[0].player
            } else {
              newState.declarer = lastBid.player
            }
          } else {
            newState.contract = 'Pass'
          }

          // Le joueur qui entame est celui à la gauche du déclarant
          if (newState.declarer) {
            newState.turn = getLHO(newState.declarer)
          }
        }
      }
      states.push(newState)
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
