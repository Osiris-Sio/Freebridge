<div id="cookie-banner">
    <article>
        <header>
            <strong><i class="fas fa-cookie-bite"></i> Respect de votre vie privée</strong>
        </header>
        <p>Nous utilisons des cookies pour améliorer votre expérience et analyser le trafic.</p>
        <footer>
            <div class="grid">
                <button class="secondary outline" onclick="CookieConsent.showSettings()">Personnaliser</button>
                <button class="secondary" onclick="CookieConsent.refuseAll()">Tout Refuser</button>
                <button onclick="CookieConsent.acceptAll()">Tout Accepter</button>
            </div>
        </footer>
    </article>
</div>

<div id="cookie-settings-modal">
    <article>
        <header>
            <a href="#close" aria-label="Close" class="close" onclick="CookieConsent.hideSettings()"></a>
            <strong>Paramètres des Cookies</strong>
        </header>

        <div class="cookie-option">
            <div>
                <strong>Essentiels</strong><br>
                <small>Session, sécurité et thème.</small>
            </div>
            <input type="checkbox" role="switch" checked disabled>
        </div>

        <div class="cookie-option">
            <div>
                <strong>Analytiques</strong><br>
                <small>Analyse de l'utilisation du site (GoatCounter).</small>
            </div>
            <input type="checkbox" id="cookie-analytics" role="switch">
        </div>

        <div class="cookie-option">
            <div>
                <strong>Personnalisation</strong><br>
                <small>Retient votre choix de thème (Clair/Sombre).</small>
            </div>
            <input type="checkbox" id="cookie-personalization" role="switch">
        </div>

        <footer>
            <div class="grid">
                <button class="secondary outline" onclick="CookieConsent.hideSettings()">Annuler</button>
                <button onclick="CookieConsent.saveSettings()">Enregistrer</button>
            </div>
        </footer>
    </article>
</div>