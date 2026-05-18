/**
 * Point d'entrée de l'application.
 * Gère les événements d'interface et l'état global.
 */

/* global updateUI, parsePBN, parseLIN, simulateGame, initDDS, checkBotTurn */

// Variables globales de l'application
window.gameStates = []
window.gameComments = []
window.currentStateIndex = 0
window.gameMode = 'solve' // 'solve' ou 'play'
window.ddsWorker = null
window.pendingPlay = false

document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.getElementById('file-input')
  const langToggle = document.getElementById('lang-fr-cards')
  const ewToggle = document.getElementById('toggle-ew-visibility')

  // --- INITIALISATION DES OPTIONS ---
  if (langToggle) {
    langToggle.checked = window.useFrenchCards
  }

  if (ewToggle) {
    ewToggle.addEventListener('change', () => updateUI())
  }

  // --- GESTION DU CHARGEMENT DES FICHIERS ---

  /**
   * Traite le contenu d'un fichier (PBN ou LIN) et lance l'application.
   */
  function processFile(content, fileName) {
    try {
      const parsed = fileName.toLowerCase().endsWith('.pbn')
        ? parsePBN(content)
        : parseLIN(content)
      window.currentParsedData = parsed

      // Demande du mode à l'utilisateur si non spécifié dans l'URL
      const urlParams = new URLSearchParams(window.location.search)
      const mode = urlParams.get('mode')

      // Si pas de mode défini, on demande à l'utilisateur
      if (!mode) {
        askUserMode(parsed)
      } else {
        startApplication(mode, parsed)
      }
    } catch {
      // do nothing
    }
  }

  /**
   * Affiche le dialogue de choix de mode.
   */
  function askUserMode(parsed) {
    const dialog = document.getElementById('mode-dialog')
    if (dialog) {
      dialog.showModal()
      document.getElementById('choose-solve').onclick = () => {
        dialog.close()
        startApplication('solve', parsed)
      }
      document.getElementById('choose-play').onclick = () => {
        dialog.close()
        startApplication('play', parsed)
      }
    } else {
      startApplication('solve', parsed)
    }
  }

  /**
   * Initialise l'état de jeu et lance le rendu.
   */
  function startApplication(mode, parsed) {
    window.gameMode = mode
    document.getElementById('mode-badge').textContent =
      mode === 'play' ? '[MODE JEU]' : '[MODE VISIONNEUR]'

    if (mode === 'play') {
      // En mode jeu, on simule les enchères et on extrait le premier bloc de commentaires (jusqu'à son 'pg') pour donner le contexte sans spoiler la solution.
      let initialTokens = []
      const firstCommentIdx = parsed.tokens.findIndex(
        (t) => t.type === 'comment',
      )
      if (firstCommentIdx !== -1) {
        // s'il y a un commentaire, on l'extrait
        let endIdx = firstCommentIdx
        while (
          endIdx < parsed.tokens.length &&
          parsed.tokens[endIdx].type !== 'page'
        ) {
          endIdx++
        }
        initialTokens = parsed.tokens
          .slice(0, endIdx)
          .filter((t) => t.type !== 'play')
      }

      const biddingOnly = {
        ...parsed,
        tokens: initialTokens,
      }
      const sim = simulateGame(biddingOnly)
      window.gameStates = sim.states
      window.gameComments = sim.comments
      initDDS() // Bot DDS (bot_engine.js)
    } else {
      const sim = simulateGame(parsed)
      window.gameStates = sim.states
      window.gameComments = sim.comments
    }

    if (mode === 'play') {
      window.currentStateIndex = window.gameStates.length - 1
      updateUI()
      checkBotTurn()
    } else {
      window.currentStateIndex = 0
      updateUI()
    }
  }

  // Écouteur pour l'upload de fichier local
  if (fileInput) {
    fileInput.addEventListener('change', (e) => {
      const file = e.target.files[0]
      if (!file) {
        return
      }
      const reader = new FileReader()
      reader.onload = (evt) => {
        const content = evt.target.result
        // Détection d'encodage (LIN utilise souvent ISO-8859-1)
        if (content.includes('\uFFFD')) {
          const readerIso = new FileReader()
          readerIso.onload = (eIso) =>
            processFile(eIso.target.result, file.name)
          readerIso.readAsText(file, 'ISO-8859-1')
        } else {
          processFile(content, file.name)
        }
      }
      reader.readAsText(file, 'UTF-8')
    })
  }

  // Chargement automatique via URL (?file=...)
  const fileUrl = new URLSearchParams(window.location.search).get('file')
  if (fileUrl) {
    fetch(fileUrl)
      .then((res) => res.arrayBuffer())
      .then((buffer) => {
        let content = new TextDecoder('utf-8').decode(buffer)
        if (content.includes('\uFFFD')) {
          content = new TextDecoder('iso-8859-1').decode(buffer)
        }
        processFile(content, fileUrl.split('/').pop().split('?')[0])
      })
  }

  // --- CONTRÔLES DE NAVIGATION ---

  const actions = {
    'btn-start': () => (window.currentStateIndex = 0),
    'btn-end': () => (window.currentStateIndex = window.gameStates.length - 1),
    'btn-next': () => {
      if (window.currentStateIndex < window.gameStates.length - 1) {
        window.currentStateIndex++
      }
    },
    'btn-prev': () => {
      if (window.currentStateIndex > 0) {
        window.currentStateIndex--
      }
    },
    'btn-next-trick': () => jumpTrick(1),
    'btn-prev-trick': () => jumpTrick(-1),
  }

  Object.entries(actions).forEach(([id, func]) => {
    document.getElementById(id).addEventListener('click', () => {
      func()
      updateUI()
    })
  })

  function jumpTrick(dir) {
    let i = window.currentStateIndex + dir
    while (i > 0 && i < window.gameStates.length - 1) {
      if (window.gameStates[i].currentTrick.length === 4) {
        break
      }
      i += dir
    }
    window.currentStateIndex = i
  }

  // Navigation clavier
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') {
      document.getElementById('btn-next').click()
    }
    if (e.key === 'ArrowLeft') {
      document.getElementById('btn-prev').click()
    }
  })

  // Bouton pour changer de mode
  const btnChangeMode = document.getElementById('btn-change-mode')
  if (btnChangeMode) {
    btnChangeMode.addEventListener('click', () => {
      if (!window.currentParsedData) {
        // pas de fichier chargé
        return
      }
      if (
        confirm(
          'La partie va être recommencée.\nÊtes-vous sûr de vouloir changer de mode ?',
        )
      ) {
        askUserMode(window.currentParsedData)
      }
    })
  }

  // Toggle langue des cartes
  if (langToggle) {
    langToggle.addEventListener('change', (e) => {
      window.useFrenchCards = e.target.checked
      updateUI()
    })
  }
})
