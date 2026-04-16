<?php include 'includes/header.php'; ?>

<article>
    <button type="button" class="secondary outline" onclick="history.back()">
        ⭠ Retour
    </button>
    <h1>Formulaire de contact</h1>

    <form action="<?= BASE_URL ?>formulaire" method="post">
        <label for="nom">Nom :</label>
        <input required type="text" name="nom" id="nom" placeholder="Exemple : Martin" value="<?php echo htmlspecialchars($form_data['nom'] ?? $_SESSION['user_nom'] ?? ''); ?>">

        <label for="prenom">Prénom :</label>
        <input required type="text" name="prenom" id="prenom" placeholder="Exemple : Jacques" value="<?php echo htmlspecialchars($form_data['prenom'] ?? $_SESSION['user_prenom'] ?? ''); ?>">

        <label for="mail">Adresse mail :</label>
        <input required type="email" name="mail" id="mail" placeholder="Exemple : jacques.martin@email.com" value="<?php echo htmlspecialchars($form_data['mail'] ?? $_SESSION['user_mail'] ?? ''); ?>">

        <label for="demande">Votre demande :</label>
        <textarea required name="demande" id="demande" placeholder="Saisissez votre demande..." rows="5"><?php echo htmlspecialchars($form_data['demande'] ?? ''); ?></textarea>

        <button type="submit">
            Envoyer
        </button>
    </form>
</article>

<?php include 'includes/footer.php'; ?>
