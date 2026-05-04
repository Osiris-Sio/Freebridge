/**
 * Fichier : utils.js
 * Rôle : Fonctions utilitaires globales pour le jeu de bridge (valeur des cartes, tri, etc.)
 */

// Ordre des joueurs autour de la table
const PLAYERS = ['N', 'E', 'S', 'W']

// Configuration graphique des enseignes (Pique, Cœur, Carreau, Trèfle)
const SUITS = {
  S: {
    icon: './bsol/pics/spade.gif',
    color: 'black',
    text: '♠',
  },
  H: { icon: './bsol/pics/heart.gif', color: 'red', text: '♥' },
  D: {
    icon: './bsol/pics/diamond.gif',
    color: 'red',
    text: '♦',
  },
  C: { icon: './bsol/pics/club.gif', color: 'black', text: '♣' },
}

// Ordre hiérarchique des couleurs
const suitOrder = { S: 0, H: 1, D: 2, C: 3 }

/**
 * Calcule la valeur numérique d'une carte pour déterminer le gagnant du pli.
 * @param {string} rank - Le rang de la carte (A, K, Q, J, 10... 2)
 * @returns {number} La valeur numérique
 */
function cardValue(rank) {
  if (rank === 'A') {
    return 14
  }
  if (rank === 'K') {
    return 13
  }
  if (rank === 'Q') {
    return 12
  }
  if (rank === 'J') {
    return 11
  }
  if (rank === '10' || rank === 'T') {
    return 10
  }
  return parseInt(rank)
}

/**
 * Trie une main de bridge (par couleur puis par valeur décroissante).
 * @param {Array} hand - La main à trier
 * @returns {Array} La main triée
 */
function sortHand(hand) {
  return [...hand].sort((a, b) => {
    if (suitOrder[a.suit] !== suitOrder[b.suit]) {
      return suitOrder[a.suit] - suitOrder[b.suit]
    }
    return cardValue(b.rank) - cardValue(a.rank)
  })
}

/**
 * Récupère le joueur situé à la gauche d'un autre joueur (Left Hand Opponent).
 * @param {string} p - Le joueur actuel ('N', 'E', 'S', 'W')
 * @returns {string} Le joueur à gauche
 */
function getLHO(p) {
  return PLAYERS[(PLAYERS.indexOf(p) + 1) % 4]
}

/**
 * Traduit le rang d'une carte selon la langue choisie.
 * @param {string} rank - Le rang en anglais (A, K, Q, J, T, 9...)
 * @returns {string} Le rang traduit
 */
function getDisplayRank(rank) {
  if (!window.useFrenchCards) {
    return rank === 'T' ? '10' : rank
  }

  const frMap = {
    A: 'A',
    K: 'R',
    Q: 'D',
    J: 'V',
    T: '10',
  }

  return frMap[rank] || rank
}

window.useFrenchCards = localStorage.getItem('useFrenchCards') === 'true'

/**
 * Transforme les symboles @S, @H, @D, @C en emojis de couleurs pour les commentaires.
 * @param {string} text - Le texte brut du commentaire
 * @returns {string} Le texte avec les symboles remplacés
 */
function formatComment(text) {
  if (!text) return ''
  return text
    .replace(/@S/g, '♠️')
    .replace(/@H/g, '♥️')
    .replace(/@D/g, '♦️')
    .replace(/@C/g, '♣️')
    .replace(/@s/g, '♠️')
    .replace(/@h/g, '♥️')
    .replace(/@d/g, '♦️')
    .replace(/@c/g, '♣️')
}
