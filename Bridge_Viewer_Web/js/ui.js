/**
 * Fichier : ui.js
 * Rôle : Gère la mise à jour de l'interface utilisateur (DOM, création des cartes, affichage des informations).
 */

/**
 * Crée un élément HTML représentant une carte textuelle ou un symbole pour les zones de main (style BSOL).
 * @param {string|Object} content - Le rang de la carte ou un objet SUITS contenant l'icône
 * @param {string} colorClass - La classe CSS pour la couleur ('red' ou 'black')
 * @param {boolean} isSuitIcon - Indique si on crée l'icône de la couleur ou la carte elle-même
 * @returns {HTMLElement} L'élément div de la carte
 */
function createBsolCard(content, colorClass, isSuitIcon = false) {
  const div = document.createElement('div')
  div.className = `bsol-card ${colorClass}`
  if (isSuitIcon) {
    // On crée l'icône de la couleur
    const img = document.createElement('img')
    img.src = content.icon
    img.alt = content.text
    img.className = 'bsol-suit-icon'
    div.appendChild(img)
  } else {
    div.textContent = content
  }
  return div
}

/**
 * Crée un élément HTML représentant une carte jouée sur le tapis de jeu (pli courant).
 * @param {Object} card - Objet représentant la carte {suit: 'H', rank: 'A'}
 * @returns {HTMLElement} L'élément div de la carte
 */
function createTrickCardElement(card) {
  const div = document.createElement('div')
  const suitData = SUITS[card.suit]
  div.className = `bsol-trick-card ${suitData.color}`

  const rankSpan = document.createElement('span')
  rankSpan.textContent = card.rank

  const img = document.createElement('img')
  img.src = suitData.icon
  img.alt = suitData.text

  div.appendChild(rankSpan)
  div.appendChild(img)
  return div
}

/**
 * Met à jour toute l'interface graphique en fonction de l'état actuel de la partie.
 */
function updateUI() {
  if (!window.gameStates || window.gameStates.length === 0) {
    return
  }
  const state = window.gameStates[window.currentStateIndex]

  // --- Panneau de gauche : Informations de la donne ---
  document.getElementById('info-contract').textContent = state.contract || '-'
  document.getElementById('info-declarer').textContent = state.declarer || '-'

  const vulEl = document.getElementById('info-vul')
  const vulText = state.vul || '-'
  vulEl.textContent = vulText
  // Ajout de couleurs pour la vulnérabilité
  if (vulText.toLowerCase() === 'none' || vulText === '-') {
    vulEl.style.color = '#4caf50' // Vert (Non-vulnérable)
  } else {
    vulEl.style.color = '#f44336' // Rouge (Vulnérable: NS, EW, All, etc.)
  }

  document.getElementById('info-dealer').textContent = state.dealer || '-'
  document.getElementById('info-tricks-ns').textContent = state.tricksWon.NS
  document.getElementById('info-tricks-ew').textContent = state.tricksWon.EW
  document.getElementById('info-trick-winner').textContent =
    state.trickWinner || '-'

  // --- Panneau de droite : Commentaires ---
  const commentsBox = document.getElementById('comments-box')
  if (state.displayComment) {
    commentsBox.innerHTML = '<p>' + state.displayComment + '</p>'
  } else {
    commentsBox.innerHTML = '<p><i>Aucun commentaire</i></p>'
  }

  // --- Panneau de droite : Enchères ---
  const biddingTbody = document.getElementById('bidding-tbody')
  biddingTbody.innerHTML = ''
  if (state.bidding.length > 0) {
    let row = document.createElement('tr')
    const startIndex = PLAYERS.indexOf(state.dealer) // La grille commence avec le donneur

    // Remplir les cellules vides avant le premier parleur
    for (let i = 0; i < startIndex; i++) {
      const td = document.createElement('td')
      row.appendChild(td)
    }

    let colIdx = startIndex
    for (const bid of state.bidding) {
      if (colIdx === 4) {
        biddingTbody.appendChild(row)
        row = document.createElement('tr')
        colIdx = 0
      }
      const td = document.createElement('td')
      td.textContent = bid.bid
      row.appendChild(td)
      colIdx++
    }

    // Compléter la dernière ligne avec des cases vides
    if (row.children.length > 0) {
      while (colIdx < 4) {
        const td = document.createElement('td')
        row.appendChild(td)
        colIdx++
      }
      biddingTbody.appendChild(row)
    }

    // Scroll automatique vers le bas de la zone des enchères
    const biddingContainer = biddingTbody.parentElement.parentElement
    biddingContainer.scrollTop = biddingContainer.scrollHeight
  }

  // --- Zone centrale : Mains des joueurs ---
  const handsDivs = {
    N: document.getElementById('hand-N'),
    E: document.getElementById('hand-E'),
    S: document.getElementById('hand-S'),
    W: document.getElementById('hand-W'),
  }

  PLAYERS.forEach((p) => {
    handsDivs[p].innerHTML = ''
    if (state.hands[p]) {
      const suits = ['S', 'H', 'D', 'C']
      suits.forEach((suit) => {
        let cardsOfSuit = state.hands[p].filter((c) => c.suit === suit)
        if (cardsOfSuit.length > 0) {
          cardsOfSuit = sortHand(cardsOfSuit)

          const rowDiv = document.createElement('div')
          rowDiv.className = 'suit-row'

          // Icône de la couleur (Pique, Cœur...)
          rowDiv.appendChild(
            createBsolCard(SUITS[suit], SUITS[suit].color, true),
          )

          // Cartes
          cardsOfSuit.forEach((c) => {
            rowDiv.appendChild(createBsolCard(c.rank, SUITS[suit].color, false))
          })

          handsDivs[p].appendChild(rowDiv)
        }
      })
    }
  })

  // --- Zone centrale : Tapis de jeu (cartes posées) ---
  const centerTrickDiv = document.getElementById('center-trick')
  centerTrickDiv.innerHTML = ''
  state.currentTrick.forEach((play) => {
    const cardEl = createTrickCardElement(play.card)
    cardEl.classList.add('trick-card')
    cardEl.classList.add(play.player) // Classe indiquant la position (N, S, E, W)
    centerTrickDiv.appendChild(cardEl)
  })

  // --- Mise à jour du compteur d'étape ---
  document.getElementById('step-counter-text').textContent =
    `${window.currentStateIndex} / ${window.gameStates.length - 1}`

  // Activer ou désactiver les boutons en fonction de l'étape
  updateControlsState()
}

/**
 * Active ou désactive les boutons de contrôle de la navigation.
 */
function updateControlsState() {
  const btnStart = document.getElementById('btn-start')
  const btnPrevTrick = document.getElementById('btn-prev-trick')
  const btnPrev = document.getElementById('btn-prev')
  const btnNext = document.getElementById('btn-next')
  const btnNextTrick = document.getElementById('btn-next-trick')
  const btnEnd = document.getElementById('btn-end')

  const isStart = window.currentStateIndex === 0
  btnStart.disabled = isStart
  btnPrev.disabled = isStart
  btnPrevTrick.disabled = isStart

  const maxIdx = window.gameStates.length - 1
  const isEnd = window.currentStateIndex === maxIdx
  btnNext.disabled = isEnd
  btnNextTrick.disabled = isEnd
  btnEnd.disabled = isEnd
}
