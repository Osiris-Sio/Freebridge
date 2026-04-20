<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>Récupération du mot de passe</h1>
    </header>

    <form action="lostpassword" method="post">
        <p style="color: red;">Attention : NE FONCTIONNE PAS !!!</p>
        <label for="login">Votre adresse mail :</label>
        <input required type="email" name="login" id="login" placeholder="votre@email.com" value="<?php echo htmlspecialchars(
          $login_value ?? '',
        ); ?>">

        <br>


        <div class="grid-two-columns">
            <button type="button" onclick="history.back()">
                ← Retour
            </button>
            <button type="submit">
                Envoyer
            </button>
        </div>
    </form>

</article>

<?php include 'includes/footer.php'; ?>
