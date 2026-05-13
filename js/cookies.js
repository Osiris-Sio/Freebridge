const CookieConsent = {
  storageKey: 'freebridge_cookie_consent',

  init() {
    const consent = localStorage.getItem(this.storageKey)
    if (!consent) {
      document.getElementById('cookie-banner').classList.add('active')
    } else {
      this.applyConsent(JSON.parse(consent))
    }
  },

  acceptAll() {
    const consent = {
      essential: true,
      analytics: true,
      personalization: true,
      timestamp: new Date().getTime(),
    }
    this.saveAndApply(consent)
  },

  refuseAll() {
    const consent = {
      essential: true,
      analytics: false,
      personalization: false,
      timestamp: new Date().getTime(),
    }
    this.saveAndApply(consent)
  },

  saveSettings() {
    const consent = {
      essential: true,
      analytics: document.getElementById('cookie-analytics').checked,
      personalization: document.getElementById('cookie-personalization')
        .checked,
      timestamp: new Date().getTime(),
    }
    this.saveAndApply(consent)
    this.hideSettings()
  },

  saveAndApply(consent) {
    localStorage.setItem(this.storageKey, JSON.stringify(consent))
    document.getElementById('cookie-banner').classList.remove('active')
    this.applyConsent(consent)

    // Envoie un événement pour que d'autres scripts puissent écouter
    window.dispatchEvent(
      new CustomEvent('cookieConsentChanged', { detail: consent }),
    )
  },

  applyConsent(consent) {
    // Logique pour activer/désactiver les scripts en fonction du consentement
    if (consent.analytics) {
      this.loadGoatCounter('BGlorie')
    }

    if (!consent.personalization) {
      // Si refusé, on nettoie les préférences de personnalisation
      localStorage.removeItem('theme')
      // Optionnel : remettre le thème par défaut ou système
      // document.documentElement.setAttribute('data-theme', 'light');
    }
  },

  loadGoatCounter(code) {
    if (document.getElementById('goatcounter-script')) {
      return
    }

    const script = document.createElement('script')
    script.id = 'goatcounter-script'
    script.async = true
    script.src = '//gc.zgo.at/count.js'
    script.dataset.goatcounter = `https://${code}.goatcounter.com/count`
    document.head.appendChild(script)
  },

  showSettings() {
    const consent = JSON.parse(
      localStorage.getItem(this.storageKey) ||
        '{"analytics":false,"personalization":false}',
    )
    document.getElementById('cookie-analytics').checked = consent.analytics
    document.getElementById('cookie-personalization').checked =
      consent.personalization
    document.getElementById('cookie-settings-modal').classList.add('active')
  },

  hideSettings() {
    document.getElementById('cookie-settings-modal').classList.remove('active')
  },

  resetConsent() {
    localStorage.removeItem(this.storageKey)
    this.init()
  },
}

document.addEventListener('DOMContentLoaded', () => {
  CookieConsent.init()
})
