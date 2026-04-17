<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>Inscription</h1>
    </header>
    <form action="register" method="post">
        <label for="nom">Nom :</label>
        <input required type="text" name="nom" id="nom" placeholder="Exemple : Martin" value="<?php echo htmlspecialchars($form_data['nom'] ?? ''); ?>">

        <label for="prenom">Prénom :</label>
        <input required type="text" name="prenom" id="prenom" placeholder="Exemple : Jacques" value="<?php echo htmlspecialchars($form_data['prenom'] ?? ''); ?>">

        <label for="login">Adresse mail :</label>
        <input required type="email" name="login" id="login" placeholder="Exemple : jacques.martin@email.com" value="<?php echo htmlspecialchars($form_data['login'] ?? ''); ?>">

        <label for="password">Mot de passe :</label>
        <input required type="password" name="password" id="password" placeholder="Mot de passe">

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
            <button type="button" onclick="history.back()">
                ← Retour
            </button>
            <button type="submit">
                Créer mon compte
            </button>
        </div>
    </form>
</article>

<?php include 'includes/footer.php'; ?>