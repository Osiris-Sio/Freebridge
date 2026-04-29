<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>Récupération du mot de passe</h1>
    </header>

    <form action="lostpassword" method="post">

        <p>Saisissez votre adresse mail pour recevoir un nouveau mot de passe temporaire.</p>

        <label for="login">Votre adresse mail :</label>
        <input required type="email" name="login" id="login" placeholder="votre@email.com" value="<?= htmlspecialchars(
          $login_value ?? '',
        ) ?>">

        <br>

        <div class="grid-two-columns">
            <button type="button" class="secondary" onclick="window.location.href='login'">
                ← Retour à la connexion
            </button>
            <button type="submit">
                Générer un nouveau mot de passe
            </button>
        </div>
    </form>
</article>

<?php include 'includes/footer.php'; ?>
