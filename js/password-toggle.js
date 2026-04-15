/**
 * Permet de basculer la visibilité du mot de passe
 */
document.addEventListener('change', function (e) {
  if (e.target && e.target.classList.contains('password-toggle')) {
    // Trouve les champs mot de passe liés (dans le même formulaire ou via data-target)
    const form = e.target.closest('form')
    const passwordFields = form.querySelectorAll(
      'input[type="password"], input[data-is-password="true"]',
    )

    passwordFields.forEach((field) => {
      if (e.target.checked) {
        field.type = 'text'
        field.setAttribute('data-is-password', 'true') // Garde une trace pour la bascule inverse
      } else {
        field.type = 'password'
      }
    })
  }
})
