<?php
include 'includes/header.php';

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

// Logique de mise à jour du rang (héritée de l'ancienne version)
if (isset($_SESSION['prix'])) {
  $date = date('d/m/Y');
  $new_rang = '';

  if ($_SESSION['prix'] == 2) {
    $new_rang = 'progresser';
  } elseif ($_SESSION['prix'] == 3) {
    $new_rang = 'peaufiner';
  } elseif ($_SESSION['prix'] == 4) {
    $new_rang = 'confirmer';
  }

  if (!empty($new_rang)) {
    $sql =
      'UPDATE user SET user_rang = :rang, user_date = :date WHERE user_id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ':rang' => $new_rang,
      ':date' => $date,
      ':id' => $_SESSION['user_id'],
    ]);
  }
}
?>

<section>
  <header>
    <h1>Mon Compte</h1>
    <p>Heureux de vous revoir, <strong><?php echo htmlspecialchars(
      $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom'],
    ); ?></strong> !</p>
  </header>

  <div class="grid">
    <!-- Infos Abonnement -->
    <article>
      <header>
        <strong>Gestion des abonnements</strong>
      </header>
      <p>Les abonnements sont mensuels et dépendent du niveau choisi.</p>
      <p><small>Il est possible de se désabonner à tout instant. Pour passer à une catégorie supérieure, désabonnez-vous puis choisissez le nouveau niveau.</small></p>

      <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=<?php echo getenv(
        'PAYPAL_UNSUBSCRIBE_ALIAS',
      ); ?>" class="outline contrast" style="display: block; text-align: center;">
        <img src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_unsubscribe_LG.gif" alt="Se désabonner">
        <br>Gérer mon désabonnement
      </a>
    </article>

    <!-- État Actuel -->
    <article>
      <header>
        <strong>Statut actuel</strong>
      </header>
      <div>
        <p>Votre rang : <br>
          <kbd><?php echo strtoupper(
            $_SESSION['user_rang'] ?? 'INACTIF',
          ); ?></kbd>
        </p>
        <p>Inscrit depuis le : <?php echo $_SESSION['user_date'] ??
          'Inconnue'; ?></p>
      </div>
    </article>
  </div>

  <hr>

  <h2>Choisir un niveau d'accès</h2>

  <div class="grid">
    <!-- Niveau Progresser -->
    <article>
      <header>
        <h3>Progresser</h3>
        <p><mark>2,00€ / mois</mark></p>
      </header>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="<?php echo getenv(
          'PAYPAL_BUTTON_ID_PROGRESSER',
        ); ?>">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="on0" value="Progresser">
        <input type="hidden" name="os0" value="Accès">
        <button type="submit" class="primary">S'abonner</button>
      </form>
    </article>

    <!-- Niveau Peaufiner -->
    <article>
      <header>
        <h3>Peaufiner</h3>
        <p><mark>3,00€ / mois</mark></p>
      </header>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="<?php echo getenv(
          'PAYPAL_BUTTON_ID_PEAUFINER',
        ); ?>">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="on0" value="Peaufiner">
        <input type="hidden" name="os0" value="Accès">
        <button type="submit" class="primary">S'abonner</button>
      </form>
    </article>

    <!-- Niveau Confirmer -->
    <article>
      <header>
        <h3>Confirmer</h3>
        <p><mark>4,00€ / mois</mark></p>
      </header>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="<?php echo getenv(
          'PAYPAL_BUTTON_ID_CONFIRMER',
        ); ?>">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="on0" value="Confirmer">
        <input type="hidden" name="os0" value="Accès">
        <button type="submit" class="primary">S'abonner</button>
      </form>
    </article>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
