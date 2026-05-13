<?php

/**
 * Contrôleur de récupération de mot de passe
 */

// Si l'utilisateur est déjà connecté, on le redirige
if (isset($_SESSION['user_id'])) {
  header('Location: home');
  exit();
}

// Fonction pour générer un mot de passe aléatoire simple
function generate_random_password($length = 8)
{
  return substr(
    str_shuffle(
      '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ),
    0,
    $length,
  );
}

// Récupération de la donnée stockée en session si elle existe
$login_value = $_SESSION['inputs']['lostpassword'] ?? '';
unset($_SESSION['inputs']['lostpassword']);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = strtolower(trim($_POST['login'] ?? ''));

  // Stockage temporaire pour persistance
  $_SESSION['inputs']['lostpassword'] = $login;

  try {
    if (!$conn) {
      header('Location: lostpassword');
      exit();
    }

    if (!empty($login)) {
      // Vérification si l'utilisateur existe
      $sql = 'SELECT user_id FROM user WHERE user_mail = :mail';
      $stmt = $conn->prepare($sql);
      $stmt->execute([':mail' => $login]);
      $user = $stmt->fetch();

      if ($user) {
        $new_pass = generate_random_password();
        $hashed_pass = sha1($new_pass);

        // Mise à jour en base de données
        $sql = 'UPDATE user SET user_password = :pass WHERE user_mail = :mail';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
          ':pass' => $hashed_pass,
          ':mail' => $login,
        ]);

        // Préparation de l'email
        $to = $login;
        $subject =
          '=?UTF-8?B?' .
          base64_encode('Réinitialisation de votre mot de passe Freebridge') .
          '?=';

        // Corps du mail en HTML pour un rendu plus propre
        $message = "
        <html>
        <head><title>Nouveau mot de passe Freebridge</title></head>
        <body>
          <h2>Bonjour,</h2>
          <p>Vous avez demandé la réinitialisation de votre mot de passe sur <strong>Freebridge</strong>.</p>
          <p>Votre nouveau mot de passe est : <strong style='font-size: 1.2em; color: #2c3e50;'>$new_pass</strong></p>
          <p>Nous vous conseillons de le modifier dès votre prochaine connexion sur votre compte Freebridge.</p>
          <br>
          <p>À bientôt sur Freebridge !</p>
        </body>
        </html>
        ";

        // En-têtes pour envoyer du HTML et éviter les problèmes d'accents
        $no_reply = "[EMAIL_ADDRESS]";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers .= "From: Freebridge <$no_reply>" . "\r\n";
        $headers .= "Reply-To: $no_reply" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        // Tentative d'envoi
        if (@mail($to, $subject, $message, $headers)) {
          $_SESSION['messages']['confirm'][] =
            "Un nouveau mot de passe a été envoyé à l'adresse : " .
            htmlspecialchars($login);
          header('Location: login');
          exit();
        } else {
          // Mode secours (Local/Développement) : si mail() échoue, on affiche le mdp pour ne pas bloquer les tests
          $_SESSION['messages']['errors'][] = "L'envoi de l'email a échoué (normal en local). <br>Voici votre nouveau mot de passe pour vos tests : <strong>$new_pass</strong>";
        }
      } else {
        $_SESSION['messages']['errors'][] =
          "Aucun compte n'est associé à cette adresse mail.";
      }
    } else {
      $_SESSION['messages']['errors'][] =
        'Veuillez saisir votre adresse email.';
    }
  } catch (Throwable $e) {
    $_SESSION['messages']['errors'][] = 'Erreur système, veuillez réessayer plus tard.';
  }

  // Redirection
  header('Location: lostpassword');
  exit();
}

// Chargement de la vue
require 'app/lostpassword/views/lostpassword_view.php';
