<?php include 'includes/header.php'; ?>

<article>
  <header>
    <h1>Formulaire de contact</h1>
  </header>

  <form
    action="https://formsubmit.co/louis.amedro@outlook.fr"
    method="POST"
    class="form-contact">
    <!-- Supprimer le captcha et rediriger vers une page de remerciement -->
    <input type="hidden" name="_captcha" value="true" />
    <input type="text" name="_honey" style="display: none" />

    <div class="grid">
      <div>
        <label for="nom">Nom :</label>
        <input required type="text" name="nom" id="nom" placeholder="Exemple : Martin"
          value="<?= htmlspecialchars($form_data['nom'] ?? '') ?>">
      </div>
      <div>
        <label for="prenom">Prénom :</label>
        <input required type="text" name="prenom" id="prenom" placeholder="Exemple : Jacques"
          value="<?= htmlspecialchars($form_data['prenom'] ?? '') ?>">
      </div>
    </div>

    <label for="mail">Adresse mail :</label>
    <input required type="email" name="mail" id="mail" placeholder="Exemple : jacques.martin@email.com"
      value="<?= htmlspecialchars($form_data['mail'] ?? '') ?>">

    <label for="demande">Votre demande :</label>
    <textarea required name="demande" id="demande" placeholder="Saisissez votre demande..." rows="5"></textarea>

    <div class="grid-two-columns">
      <button type="button" class="secondary" onclick="window.location.href='home'">
        ← Retour à l'accueil
      </button>
      <button type="submit">
        Envoyer le message
      </button>
    </div>
  </form>
</article>

<?php include 'includes/footer.php'; ?>
