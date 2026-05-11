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

function cardValue(rank) {
  const values = { A: 14, K: 13, Q: 12, J: 11, T: 10, '10': 10 }
  return values[rank] || parseInt(rank) || 0
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

function getDisplayRank(rank) {
  const frMap = { A: 'A', K: 'R', Q: 'D', J: 'V', T: '10', '10': '10' }
  return window.useFrenchCards ? (frMap[rank] || rank) : (rank === 'T' ? '10' : rank)
}

window.useFrenchCards = localStorage.getItem('useFrenchCards') === 'true'

/**
 * Transforme les symboles (@S, @H...) et les enchères (1S, 2H...) en emojis de couleurs.
 * @param {string} text - Le texte brut (commentaire ou enchère)
 * @returns {string} Le texte avec les symboles remplacés
 */
function formatSymbols(text) {
  if (!text) return ''

  // 1. Si c'est une enchère courte (ex: 1S, 4H, 3NT, Pass, Dbl)
  let formatted = text.toUpperCase().trim()
  
  // Cas spéciaux : Pass, Dbl, Rdbl
  if (formatted === 'P' || formatted === 'PASS') return 'Pass'
  if (formatted === 'D' || formatted === 'DBL' || formatted === 'X') return 'X'
  if (formatted === 'R' || formatted === 'REDBL' || formatted === 'XX') return 'XX'

  // Enchères avec couleur (ex: 1S)
  if (/^[1-7](S|H|D|C|N|NT)$/.test(formatted)) {
    return formatted
      .replace(/S/, '♠️')
      .replace(/H/, '♥️')
      .replace(/D/, '♦️')
      .replace(/C/, '♣️')
      .replace(/NT|N/, 'SA')
  }

  // 2. Gestion des symboles avec @ (pour les commentaires)
  return text
    .replace(/@S/gi, '♠️')
    .replace(/@H/gi, '♥️')
    .replace(/@D/gi, '♦️')
    .replace(/@C/gi, '♣️')
}
