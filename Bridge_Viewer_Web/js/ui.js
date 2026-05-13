// Gestion de la mise à jour de l'interface utilisateur.
/* global getDisplayRank, SUITS, formatSymbols, PLAYERS, sortHand, playInteractiveCard */
/* exported updateUI */

/**
 * Crée un élément HTML représentant une carte (style BSOL).
 */
function createBsolCard(content, colorClass, isSuitIcon = false) {
  const div = document.createElement('div')
  div.className = `bsol-card ${colorClass}`
  if (isSuitIcon) {
    const img = document.createElement('img')
    img.src = content.icon
    img.alt = content.text
    img.className = 'bsol-suit-icon'
    div.appendChild(img)
  } else {
    div.textContent = getDisplayRank(content)
  }
  return div
}

/**
 * Crée un élément HTML représentant une carte sur le tapis (pli courant).
 */
function createTrickCardElement(card) {
  if (!card || !card.suit) {
    return document.createElement('div')
  }
  const suitData = SUITS[card.suit]
  const div = document.createElement('div')
  div.className = `bsol-trick-card ${suitData.color}`

  const rankSpan = document.createElement('span')
  rankSpan.textContent = getDisplayRank(card.rank)

  const img = document.createElement('img')
  img.src = suitData.icon
  img.alt = suitData.text

  div.appendChild(rankSpan)
  div.appendChild(img)
  return div
}

/**
 * Met à jour toute l'interface graphique.
 */
function updateUI() {
  if (!window.gameStates || window.gameStates.length === 0) {
    return
  }
  const state = window.gameStates[window.currentStateIndex]

  // --- Panneau de gauche : Informations de la donne ---
  document.getElementById('info-contract').innerHTML =
    formatSymbols(state.contract) || '-'
  document.getElementById('info-declarer').textContent = state.declarer || '-'

  const vulEl = document.getElementById('info-vul')
  const vulText = state.vul || '-'
  vulEl.textContent = vulText
  vulEl.style.color =
    vulText.toLowerCase() === 'none' || vulText === '-' ? '#4caf50' : '#f44336'

  document.getElementById('info-dealer').textContent = state.dealer || '-'
  document.getElementById('info-tricks-ns').textContent = state.tricksWon.NS
  document.getElementById('info-tricks-ew').textContent = state.tricksWon.EW
  document.getElementById('info-trick-winner').textContent =
    state.trickWinner || '-'

  // --- Panneau de droite : Commentaires ---
  const commentsBox = document.getElementById('comments-box')
  commentsBox.innerHTML = state.displayComment
    ? `<p>${state.displayComment}</p>`
    : '<p><i>Aucun commentaire</i></p>'

  // --- Panneau de droite : Enchères ---
  updateBiddingTable(state)

  // --- Zone centrale : Mains des joueurs ---
  updateHands(state)

  // --- Zone centrale : Tapis de jeu (pli courant) ---
  const centerTrickDiv = document.getElementById('center-trick')
  centerTrickDiv.innerHTML = ''
  state.currentTrick.forEach((play) => {
    const cardEl = createTrickCardElement(play.card)
    cardEl.classList.add('trick-card', play.player)
    centerTrickDiv.appendChild(cardEl)
  })

  // --- Compteur d'étape et contrôles ---
  document.getElementById('step-counter-text').textContent =
    `${window.currentStateIndex} / ${window.gameStates.length - 1}`
  updateControlsState()
}

/**
 * Mise à jour de la table des enchères.
 */
function updateBiddingTable(state) {
  const biddingTbody = document.getElementById('bidding-tbody')
  biddingTbody.innerHTML = ''
  if (state.bidding.length === 0) {
    return
  }

  let row = document.createElement('tr')
  const startIndex = PLAYERS.indexOf(state.dealer)

  // Cellules vides avant le premier parleur
  for (let i = 0; i < startIndex; i++) {
    row.appendChild(document.createElement('td'))
  }

  let colIdx = startIndex
  for (const bid of state.bidding) {
    if (colIdx === 4) {
      biddingTbody.appendChild(row)
      row = document.createElement('tr')
      colIdx = 0
    }
    const td = document.createElement('td')
    td.innerHTML = formatSymbols(bid.bid)
    row.appendChild(td)
    colIdx++
  }

  // Compléter la dernière ligne
  while (colIdx > 0 && colIdx < 4) {
    row.appendChild(document.createElement('td'))
    colIdx++
  }
  if (row.children.length > 0) {
    biddingTbody.appendChild(row)
  }

  const container = biddingTbody.parentElement.parentElement
  container.scrollTop = container.scrollHeight
}

/**
 * Mise à jour de l'affichage des mains des joueurs.
 */
function updateHands(state) {
  const showEW =
    document.getElementById('toggle-ew-visibility')?.checked ?? true
  const isLatest = window.currentStateIndex === window.gameStates.length - 1

  PLAYERS.forEach((p) => {
    const handDiv = document.getElementById(`hand-${p}`)
    if (!handDiv) {
      return
    }
    handDiv.innerHTML = ''

    if ((p === 'E' || p === 'W') && !showEW) {
      const placeholder = document.createElement('div')
      placeholder.className = 'hidden-hand-placeholder'
      placeholder.innerHTML = '&nbsp ? &nbsp'
      handDiv.appendChild(placeholder)
    } else if (state.hands[p]) {
      const suits = ['S', 'H', 'D', 'C']
      suits.forEach((suit) => {
        const cardsOfSuit = state.hands[p].filter((c) => c.suit === suit)
        if (cardsOfSuit.length > 0) {
          const rowDiv = document.createElement('div')
          rowDiv.className = 'suit-row'
          rowDiv.appendChild(
            createBsolCard(SUITS[suit], SUITS[suit].color, true),
          )

          sortHand(cardsOfSuit).forEach((c) => {
            const cardEl = createBsolCard(c.rank, SUITS[suit].color, false)

            // Logic de jeu interactive (seulement pour N/S au dernier état)
            if (
              window.gameMode === 'play' &&
              isLatest &&
              (state.turn === 'S' || state.turn === 'N') &&
              p === state.turn
            ) {
              const leadSuit = state.currentTrick[0]?.card.suit
              const hasLeadSuit = state.hands[p].some(
                (card) => card.suit === leadSuit,
              )
              const canPlay = !leadSuit || !hasLeadSuit || suit === leadSuit

              if (canPlay) {
                cardEl.classList.add('playable')
                cardEl.onclick = () =>
                  playInteractiveCard({ suit, rank: c.rank })
              } else {
                cardEl.classList.add('unplayable')
                cardEl.title = 'Vous devez fournir à la couleur'
              }
            }
            rowDiv.appendChild(cardEl)
          })
          handDiv.appendChild(rowDiv)
        }
      })
    }

    // Highlight du joueur actif
    const label = document.querySelector(`.label-${p}`)
    if (label) {
      label.classList.toggle('active-turn', state.turn === p)
    }
  })
}

/**
 * Gestion de l'état des boutons de navigation.
 */
function updateControlsState() {
  const isStart = window.currentStateIndex === 0
  const isEnd = window.currentStateIndex === window.gameStates.length - 1

  document.getElementById('btn-start').disabled = isStart
  document.getElementById('btn-prev').disabled = isStart
  document.getElementById('btn-prev-trick').disabled = isStart

  document.getElementById('btn-next').disabled = isEnd
  document.getElementById('btn-next-trick').disabled = isEnd
  document.getElementById('btn-end').disabled = isEnd
}
