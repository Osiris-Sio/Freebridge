<?php include 'includes/header.php'; ?>

<article>

    <button type="button" onclick="history.back()">
        ⭠ Retour
    </button>

    <h1>Inscription</h1>

    <form action="register_cible.php" method="post">
        <div>

            <label for="nom">Nom :</label>
            <input required type="text" name="nom" placeholder="Exemple : Martin">

            <label for="prenom">Prénom :</label>
            <input required type="text" name="prenom" placeholder="Exemple : Jacques">

            <label for="mail">Adresse mail :</label>
            <input required type="text" name="mail" placeholder="Exemple : jacques.martin@email.com">

            <label for="password">Mot de passe :</label>
            <input required type="password" name="password" placeholder="Mot de passe">

            <label for="password_confirm">Confirmer le mot de passe :</label>
            <input required type="password" name="password_confirm" placeholder="Confirmer le mot de passe">

            <label>
                <input type="checkbox" class="password-toggle">
                Afficher le mot de passe
            </label>

            <label for="checkbox-1">
                <input required type="checkbox" id="checkbox-1" class="mdl-checkbox__input">
                <span> *En cochant cette case, vous acceptez que Freebridge enregistrer les informations saisis ci-dessus. Voir notre<a href="confidentialite.php"> politique de confidentialité</a>
                </span>
            </label>

            <br>

            <button type="submit">
                S'inscrire
            </button>
    </form>

</article>

<?php include 'includes/footer.php'; ?>
