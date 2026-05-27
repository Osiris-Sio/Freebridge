<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>Inscription</h1>
    </header>
    <form action="register" method="post">
        <!-- Vérification CSRF -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

        <div class="grid">
            <div>
                <label for="nom">Nom :</label>
                <input required type="text" name="nom" id="nom" placeholder="Exemple : Martin" value="<?= htmlspecialchars(
                                                                                                            $form_data['nom'] ?? '',
                                                                                                        ) ?>">
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input required type="text" name="prenom" id="prenom" placeholder="Exemple : Jacques" value="<?= htmlspecialchars(
                                                                                                                    $form_data['prenom'] ?? '',
                                                                                                                ) ?>">
            </div>
        </div>
        <label for="login">Adresse mail :</label>
        <input required type="email" name="login" id="login" placeholder="Exemple : jacques.martin@email.com" value="<?= htmlspecialchars(
                                                                                                                            $form_data['login'] ?? '',
                                                                                                                        ) ?>">


        <label for="password">Mot de passe : <i>Doit contenir au moins 6 caractères</i></label>
        <small style="color: red;">Attention, le mot de passe ne pourra pas être récupéré en cas d'oubli !</small>
        <input required type="password" name="password" id="password" placeholder="Mot de passe" pattern=".{6,}" title="Le mot de passe doit contenir au moins 6 caractères">

        <label for="password_confirm">Confirmez votre mot de passe :</label>
        <input required type="password" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe">

        <label>
            <input type="checkbox" class="password-toggle">
            Afficher le mot de passe
        </label>

        <label for="agree">
            <input required type="checkbox" id="agree" name="agree">
            <span> *En cochant cette case, vous acceptez que Freebridge enregistre les informations saisies ci-dessus. Voir notre <a href="confidentialite">politique de confidentialité</a></span>
        </label>

        <br>

        <div class="grid-two-columns">
            <button type="button" class="secondary" onclick="history.back()">
                ← Retour
            </button>
            <button type="submit">
                Créer mon compte
            </button>
        </div>
    </form>
</article>

<?php include 'includes/footer.php'; ?>