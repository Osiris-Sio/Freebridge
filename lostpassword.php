<?php include 'includes/header.php'; ?>

<article>
    <button type="button" onclick="history.back()">
        ⭠ Retour
    </button>
    <h1>Récupération du mot de passe</h1>

    <form action="lostpassword_cible.php" method="post">
        <label for="login">Votre adresse mail :</label>
        <input required type="email" name="login" id="login" placeholder="votre@email.com">

        <br>

        <button type="submit">
            Envoyer un nouveau mot de passe
        </button>
    </form>
</article>

<?php include 'includes/footer.php'; ?>
