<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>Connexion</h1>
    </header>

    <p>Nouveau sur Freebridge ? <a href="register">Créez votre compte ici</a>.</p>

    <form action="login" method="post">
        <!-- Vérification CSRF -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

        <label for="login">Adresse mail :</label>
        <input required type="email" name="login" id="login" placeholder="votre@email.com" value="<?= htmlspecialchars(
                                                                                                        $login_value ?? '',
                                                                                                    ) ?>">

        <label for="password">Mot de passe :</label>
        <input required type="password" name="password" id="password" placeholder="Mot de passe">

        <a href="lostpassword" id="linkregister">Mot de passe oublié ?</a>

        <label>
            <input type="checkbox" class="password-toggle">
            Afficher le mot de passe
        </label>

        <br>

        <div class="grid-two-columns">
            <button type="button" class="secondary" onclick="window.location.href='home'">
                ← Retour à l'accueil
            </button>
            <button type="submit">
                Connexion
            </button>
        </div>
    </form>
</article>

<?php include 'includes/footer.php'; ?>