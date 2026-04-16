<?php include 'includes/header.php'; ?>

<article>
    <h1>Connexion</h1>

    <form action="login_cible.php" method="post">

        <label for="login">Adresse mail :</label>
        <input required type="email" name="login" placeholder="votre@email.com">

        <label for="password">Mot de passe :</label>
        <input required type="password" name="password" placeholder="Mot de passe">
        <a href="lostpassword.php" id="linkregister">Mot de passe oublié ?</a>
        <label>
            <input type="checkbox" class="password-toggle">
            Afficher le mot de passe
        </label>

        <br>

        <button type="submit">
            Connexion
        </button>

    </form>
    <footer>
        <p>Nouveau sur Freebridge ? <a href="register.php">Créez votre compte ici</a>.</p>
    </footer>
</article>

<?php include 'includes/footer.php'; ?>
