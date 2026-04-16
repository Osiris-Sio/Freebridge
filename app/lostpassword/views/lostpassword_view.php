<?php include 'includes/header.php'; ?>

<article>
    <h1>Récupération du mot de passe</h1>

    <form action="lostpassword" method="post">
        <p style="color: red;">Attention : NE FONCTIONNE PAS !!!</p>
        <label for="login">Votre adresse mail :</label>
        <input required type="email" name="login" id="login" placeholder="votre@email.com" value="<?php echo htmlspecialchars($login_value ?? ''); ?>">

        <br>

        <button type="submit">
            Envoyer un nouveau mot de passe
        </button>
    </form>
</article>

<?php include 'includes/footer.php'; ?>