/**
 * Gestion des dossiers de leçons (Accordion)
 * Ferme les autres dossiers quand l'un d'eux est ouvert.
 */

document.addEventListener('DOMContentLoaded', () => {
  const folders = document.querySelectorAll('details.level-folder')

  // Pour chaque dossier
  folders.forEach((selectedFolder) => {
    selectedFolder.addEventListener('toggle', () => {
      // Si on vient d'ouvrir ce dossier
      if (selectedFolder.open) {
        // On ferme tous les autres dossiers
        folders.forEach((otherFolder) => {
          if (otherFolder !== selectedFolder) {
            otherFolder.open = false
          }
        })
      }
    })
  })
})
