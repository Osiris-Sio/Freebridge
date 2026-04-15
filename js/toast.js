/**
 * Gestionnaire interactif pour les notifications (Toasts)
 */

// Fermeture manuelle au clic sur la croix
document.addEventListener('click', function (e) {
  if (e.target && e.target.classList.contains('closebtn')) {
    const article = e.target.closest('article')
    if (article) {
      closeToast(article)
    }
  }
})

// Fermeture automatique après 7 secondes
document.addEventListener('DOMContentLoaded', function () {
  const toasts = document.querySelectorAll('article.toast')
  toasts.forEach((toast) => {
    setTimeout(() => {
      closeToast(toast)
    }, 7000)
  })
})

/**
 * Fonction pour animer et supprimer un toast
 */
function closeToast(article) {
  if (!article || !article.parentNode) return

  article.style.opacity = '0'
  article.style.transform = 'translateX(100px)'

  setTimeout(() => {
    if (article.parentNode) {
      article.remove()
    }
  }, 300)
}
