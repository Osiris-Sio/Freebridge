/**
 * Gestion du bouton "Retour en haut de page"
 */

document.addEventListener('DOMContentLoaded', () => {
  const scrollTopBtn = document.getElementById('scroll-top-btn')

  if (scrollTopBtn) {
    // Afficher/masquer le bouton en fonction du défilement
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) {
        scrollTopBtn.classList.add('visible')
      } else {
        scrollTopBtn.classList.remove('visible')
      }
    })

    // Action de retour en haut au clic
    scrollTopBtn.addEventListener('click', (e) => {
      e.preventDefault() // Empêche le comportement par défaut du lien
      window.scrollTo({
        top: 0,
        behavior: 'smooth', // effet de défilement doux
      })
    })
  }
})
