/**
 * Fonctions utilitaires globales pour le Bridge.
 */

/* exported PLAYERS, SUITS, sortHand, getLHO, getDisplayRank, formatSymbols, cardValue */

const PLAYERS = ['N', 'E', 'S', 'W']

const SUITS = {
  S: { icon: './bsol/pics/spade.gif', color: 'black', text: '♠' },
  H: { icon: './bsol/pics/heart.gif', color: 'red', text: '♥' },
  D: { icon: './bsol/pics/diamond.gif', color: 'red', text: '♦' },
  C: { icon: './bsol/pics/club.gif', color: 'black', text: '♣' },
}

const suitOrder = { S: 0, H: 1, D: 2, C: 3 }

/**
 * Valeur numérique d'un rang de carte.
 */
function cardValue(rank) {
  const values = { A: 14, K: 13, Q: 12, J: 11, T: 10, 10: 10 }
  return values[rank] || parseInt(rank) || 0
}

/**
 * Trie une main par couleur puis par valeur décroissante.
 */
function sortHand(hand) {
  return [...hand].sort(
    (a, b) =>
      suitOrder[a.suit] - suitOrder[b.suit] ||
      cardValue(b.rank) - cardValue(a.rank),
  )
}

/**
 * Joueur suivant dans le sens des aiguilles d'une montre.
 */
function getLHO(p) {
  return PLAYERS[(PLAYERS.indexOf(p) + 1) % 4]
}

/**
 * Traduction des rangs (ex: Q -> D en français).
 */
function getDisplayRank(rank) {
  if (!window.useFrenchCards) {
    return rank === 'T' ? '10' : rank
  }
  const frMap = { A: 'A', K: 'R', Q: 'D', J: 'V', T: '10', 10: '10' }
  return frMap[rank] || rank
}

window.useFrenchCards = localStorage.getItem('useFrenchCards') === 'true'

/**
 * Formate les enchères et commentaires avec des emojis de couleurs.
 */
function formatSymbols(text) {
  if (!text) {
    return ''
  }
  const formatted = text.toUpperCase().trim()

  if (formatted === 'P' || formatted === 'PASS') {
    return 'Pass'
  }
  if (formatted === 'D' || formatted === 'DBL' || formatted === 'X') {
    return 'X'
  }
  if (formatted === 'R' || formatted === 'REDBL' || formatted === 'XX') {
    return 'XX'
  }

  const replacements = { S: '♠️', H: '♥️', D: '♦️', C: '♣️', NT: 'SA', N: 'SA' }

  if (/^[1-7](S|H|D|C|N|NT)$/.test(formatted)) {
    return formatted.replace(/S|H|D|C|NT|N/g, (match) => replacements[match])
  }

  return text.replace(/@([SHDC])/gi, (_, s) => replacements[s.toUpperCase()])
}
