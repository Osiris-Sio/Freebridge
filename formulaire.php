<?php include 'includes/header.php'; ?>

<article>

    <button type="button" onclick="history.back()">
        ⭠ Retour
    </button>
    <h1>Formulaire de contact</h1>

    <form action="formulaire_cible.php" method="post">

        <label for="nom">Nom :</label>
        <input <?php if (
          isset($_SESSION['user_nom'])
        ) { ?> value="<?php echo $_SESSION[
   'user_nom'
 ]; ?>" <?php } ?> required type="text" name="nom" placeholder="Exemple : Martin">

        <label for="prenom">Prénom :</label>
        <input <?php if (
          isset($_SESSION['user_prenom'])
        ) { ?> value="<?php echo $_SESSION[
   'user_prenom'
 ]; ?>" <?php } ?> required type="text" name="prenom" placeholder="Exemple : Jacques">


        <label for="mail">Adresse mail :</label>
        <input <?php if (
          isset($_SESSION['user_mail'])
        ) { ?> value="<?php echo $_SESSION[
   'user_mail'
 ]; ?>" <?php } ?> required type="email" name="mail" placeholder="Exemple : jacques.martin@email.com">


        <label for="demande">Votre demande :</label>
        <input required type="message" name="demande" placeholder="Saisissez votre demande...">

        <button type="submit">
            Envoyer
        </button>

    </form>

</article>




<?php include 'includes/footer.php'; ?>
