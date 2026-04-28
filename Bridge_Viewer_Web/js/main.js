/**
 * Fichier : main.js
 * Rôle : Point d'entrée de l'application. Gère les événements d'interface (boutons, upload de fichier) et l'état global.
 */

// Variables globales de l'application
window.gameStates = [];
window.currentStateIndex = 0;

document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.getElementById('file-input');

  // --- CHARGEMENT DES FICHIERS ---

  // Fonction partagée pour traiter le contenu d'un fichier (PBN ou LIN)
  function processFile(content, fileName) {
    let parsed;
    try {
      if (fileName.toLowerCase().endsWith('.pbn')) {
        parsed = parsePBN(content);
      } else if (fileName.toLowerCase().endsWith('.lin')) {
        parsed = parseLIN(content);
      } else {
        alert('Format non supporté. Veuillez charger un fichier .pbn ou .lin.');
        return;
      }

      // Lancement de la simulation du moteur de jeu
      window.gameStates = simulateGame(parsed);
      window.currentStateIndex = 0;

      // Rafraîchir l'interface avec la première étape
      updateUI();
    } catch (err) {
      console.error(err);
      alert('Erreur lors de la lecture du fichier : ' + err.message);
    }
  }

  // --- CHARGEMENT VIA UPLOAD (file input) ---

  fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (evt) => {
      let content = evt.target.result;
      if (content.includes('\uFFFD')) {
        const readerIso = new FileReader();
        readerIso.onload = (eIso) => {
          processFile(eIso.target.result, file.name);
        };
        readerIso.readAsText(file, 'ISO-8859-1');
      } else {
        processFile(content, file.name);
      }
    };
    reader.readAsText(file, 'UTF-8');
  });

  // --- CHARGEMENT VIA URL (?file=...) ---

  const urlParams = new URLSearchParams(window.location.search);
  const fileUrl = urlParams.get('file');

  if (fileUrl) {
    const fileName = fileUrl.split('/').pop().split('?')[0];
    
    // Si c'est une URL distante (http...), on utilise le proxy, sinon on charge en relatif
    const isRemote = fileUrl.startsWith('http');
    const finalUrl = isRemote 
      ? "https://corsproxy.io/?" + encodeURIComponent(fileUrl)
      : fileUrl;
    
    fetch(finalUrl)
      .then((response) => {
        if (!response.ok) throw new Error('Erreur réseau');
        return response.arrayBuffer();
      })
      .then((buffer) => {
        let content = new TextDecoder('utf-8').decode(buffer);
        if (content.includes('\uFFFD')) {
          content = new TextDecoder('iso-8859-1').decode(buffer);
        }
        processFile(content, fileName);
      })
      .catch((err) => {
        console.error('Erreur chargement URL:', err);
      });
  }

  // --- BOUTONS DE CONTRÔLE DE LA PARTIE ---

  const btnStart = document.getElementById('btn-start');
  const btnPrevTrick = document.getElementById('btn-prev-trick');
  const btnPrev = document.getElementById('btn-prev');
  const btnNext = document.getElementById('btn-next');
  const btnNextTrick = document.getElementById('btn-next-trick');
  const btnEnd = document.getElementById('btn-end');

  // Retour au tout début de la partie
  btnStart.addEventListener('click', () => {
    window.currentStateIndex = 0;
    updateUI();
  });

  // Aller à la toute fin de la partie
  btnEnd.addEventListener('click', () => {
    window.currentStateIndex = window.gameStates.length - 1;
    updateUI();
  });

  // Avancer d'une seule étape (une annonce ou une carte jouée)
  btnNext.addEventListener('click', () => {
    if (window.currentStateIndex < window.gameStates.length - 1) {
      window.currentStateIndex++;
      updateUI();
    }
  });

  // Reculer d'une seule étape
  btnPrev.addEventListener('click', () => {
    if (window.currentStateIndex > 0) {
      window.currentStateIndex--;
      updateUI();
    }
  });

  // Avancer jusqu'au prochain pli complet (4 cartes posées)
  btnNextTrick.addEventListener('click', () => {
    if (window.currentStateIndex < window.gameStates.length - 1)
      window.currentStateIndex++;
    while (window.currentStateIndex < window.gameStates.length - 1) {
      let st = window.gameStates[window.currentStateIndex];
      // On s'arrête lorsqu'il y a exactement 4 cartes sur la table
      if (st.currentTrick.length === 4) {
        break;
      }
      window.currentStateIndex++;
    }
    updateUI();
  });

  // Reculer jusqu'au précédent pli complet
  btnPrevTrick.addEventListener('click', () => {
    if (window.currentStateIndex > 0) window.currentStateIndex--;
    while (window.currentStateIndex > 0) {
      let st = window.gameStates[window.currentStateIndex];
      if (st.currentTrick.length === 4 || window.currentStateIndex === 0) {
        break;
      }
      window.currentStateIndex--;
    }
    updateUI();
  });
});
