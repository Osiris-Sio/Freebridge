// Variables globales pour la gestion des commentaires textuels
window.currentTextCommentIndex = 0;
window.currentTextComments = [];

// Affiche les commentaires d'enchères dans la div de droite
// Dans comment-handler.js
window.displayAuctionComments = function (auctionComments) {
  console.log('Trying to display auction comments');
  console.log('Type of auctionComments:', typeof auctionComments);
  console.log('auctionComments:', auctionComments);

  // Si auctionComments est undefined ou null, on sort
  if (!auctionComments) {
    console.log('No auction comments to display');
    return;
  }

  const leftDiv = document.querySelector('.comment-right');
  if (!leftDiv) {
    console.error('Could not find .comment-right div');
    return;
  }

  leftDiv.innerHTML = ''; // reset

  // Vérifions si c'est un tableau
  if (Array.isArray(auctionComments)) {
    auctionComments.forEach((comment) => {
      const p = document.createElement('p');
      p.textContent = comment;
      leftDiv.appendChild(p);
    });
  } else {
    console.error('auctionComments is not an array:', auctionComments);
  }
};

// Affiche les commentaires et le contrat pour le board actuel
window.afficherCommentairesEtContrat = function () {
  console.log('afficherCommentairesEtContrat called');
  const board = g_hands.boards[g_lastBindex];

  console.log('Current board:', board);
  console.log('g_lastBindex:', g_lastBindex);

  if (!board) {
    console.error('No board found');
    return;
  }

  // Vérifier si AlertComments existe
  if (board.AlertComments) {
    console.log('AlertComments found:', board.AlertComments);
  } else {
    console.log('No AlertComments in board');
  }

  // Affiche les commentaires d'enchères
  window.displayAuctionComments(board.AlertComments);

  // Affiche le contrat
  const titleText = document.getElementById('titleText');
  const contratDiv = document.createElement('div');
  contratDiv.innerHTML = '<h3>Contrat : ' + board.Contract + ' par ' + board.Declarer + '</h3>';
  contratDiv.style.textAlign = 'center';
  contratDiv.style.marginTop = '20px';

  titleText.parentNode.insertBefore(contratDiv, titleText.nextSibling);
};

// Affiche le prochain commentaire textuel dans la séquence
window.afficherProchainCommentaireTextuel = function () {
  const commentRight = document.querySelector('.comment-left');

  // Nettoyer le commentaire précédent
  commentRight.innerHTML = '';

  // Sécurité : on vérifie que les commentaires existent
  if (
    !window.currentTextComments ||
    window.currentTextCommentIndex >= window.currentTextComments.length
  )
    return;

  // Créer et afficher le nouveau commentaire
  const p = document.createElement('p');
  p.textContent = window.currentTextComments[window.currentTextCommentIndex];
  commentRight.appendChild(p);

  window.currentTextCommentIndex++;
};
