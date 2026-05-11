/**
 * Fichier : main.js
 * Rôle : Point d'entrée de l'application. Gère les événements d'interface (boutons, upload de fichier) et l'état global.
 */

// Variables globales de l'application
window.gameStates = []
window.currentStateIndex = 0

document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.getElementById('file-input')
  const langToggle = document.getElementById('lang-fr-cards')

  if (langToggle) {
    langToggle.checked = window.useFrenchCards
  }

  // --- CHARGEMENT DES FICHIERS ---

  // Fonction partagée pour traiter le contenu d'un fichier (PBN ou LIN)
  function processFile(content, fileName) {
    let parsed
    try {
      if (fileName.toLowerCase().endsWith('.pbn')) {
        parsed = parsePBN(content)
      } else if (fileName.toLowerCase().endsWith('.lin')) {
        parsed = parseLIN(content)
      } else {
        alert('Format non supporté. Veuillez charger un fichier .pbn ou .lin.')
        return
      }

      // Lancement de la simulation du moteur de jeu
      window.gameStates = simulateGame(parsed)
      window.currentStateIndex = 0

      // Rafraîchir l'interface avec la première étape
      updateUI()
    } catch (err) {
      console.error(err)
      alert('Erreur lors de la lecture du fichier : ' + err.message)
    }
  }

  // --- CHARGEMENT VIA UPLOAD (file input) ---

  fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0]
    if (!file) {
      return
    }

    const reader = new FileReader()
    reader.onload = (evt) => {
      const content = evt.target.result
      if (content.includes('\uFFFD')) {
        const readerIso = new FileReader()
        readerIso.onload = (eIso) => {
          processFile(eIso.target.result, file.name)
        }
        readerIso.readAsText(file, 'ISO-8859-1')
      } else {
        processFile(content, file.name)
      }
    }
    reader.readAsText(file, 'UTF-8')
  })

  // --- CHARGEMENT VIA URL (?file=...) ---

  const urlParams = new URLSearchParams(window.location.search)
  const fileUrl = urlParams.get('file')

  if (fileUrl) {
    const fileName = fileUrl.split('/').pop().split('?')[0]

    const finalUrl = fileUrl

    fetch(finalUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error('Erreur réseau')
        }
        return response.arrayBuffer()
      })
      .then((buffer) => {
        let content = new TextDecoder('utf-8').decode(buffer)
        if (content.includes('\uFFFD')) {
          content = new TextDecoder('iso-8859-1').decode(buffer)
        }
        processFile(content, fileName)
      })
      .catch((err) => {
        console.error('Erreur chargement URL:', err)
      })
  }

  // --- BOUTONS DE CONTRÔLE DE LA PARTIE ---

  const btnStart = document.getElementById('btn-start')
  const btnPrevTrick = document.getElementById('btn-prev-trick')
  const btnPrev = document.getElementById('btn-prev')
  const btnNext = document.getElementById('btn-next')
  const btnNextTrick = document.getElementById('btn-next-trick')
  const btnEnd = document.getElementById('btn-end')

  // Retour au tout début de la partie
  btnStart.addEventListener('click', () => {
    window.currentStateIndex = 0
    updateUI()
  })

  // Aller à la toute fin de la partie
  btnEnd.addEventListener('click', () => {
    window.currentStateIndex = window.gameStates.length - 1
    updateUI()
  })

  // Avancer d'une seule étape (une annonce ou une carte jouée)
  btnNext.addEventListener('click', () => {
    if (window.currentStateIndex < window.gameStates.length - 1) {
      window.currentStateIndex++
      updateUI()
    }
  })

  // Reculer d'une seule étape
  btnPrev.addEventListener('click', () => {
    if (window.currentStateIndex > 0) {
      window.currentStateIndex--
      updateUI()
    }
  })

  // Navigation par pli (cherche la prochaine/précédente table avec 4 cartes)
  const jumpTrick = (dir) => {
    let i = window.currentStateIndex + dir
    while (i > 0 && i < window.gameStates.length - 1) {
      if (window.gameStates[i].currentTrick.length === 4) break
      i += dir
    }
    window.currentStateIndex = i
    updateUI()
  }

  btnNextTrick.addEventListener('click', () => jumpTrick(1))
  btnPrevTrick.addEventListener('click', () => jumpTrick(-1))

  // --- NAVIGATION CLAVIER ---
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') btnNext.click()
    if (e.key === 'ArrowLeft') btnPrev.click()
  })

  // --- OPTION LANGUE DES CARTES ---
  if (langToggle) {
    langToggle.addEventListener('change', (e) => {
      window.useFrenchCards = e.target.checked
      localStorage.setItem('useFrenchCards', window.useFrenchCards)
      updateUI()
    })
  }
})
