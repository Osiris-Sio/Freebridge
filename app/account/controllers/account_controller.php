<?php

/**
 * Contrôleur de gestion du compte utilisateur
 */

// Si l'utilisateur n'est pas connecté, on le redirige
if (!isset($_SESSION['user_id'])) {
  header('Location: login');
  exit();
}

// Traitement de la modification des informations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Vérification CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    $_SESSION['messages']['errors'][] = "Erreur de validation de session. Veuillez reessayer.";
    header('Location: account');
    exit();
  }

  $nom = trim($_POST['nom'] ?? '');
  $prenom = trim($_POST['prenom'] ?? '');
  $email = trim($_POST['email'] ?? '');

  $old_password = $_POST['old_password'] ?? '';
  $new_password = $_POST['password'] ?? '';
  $password_confirm = $_POST['password_confirmation'] ?? '';

  try {
    if (!$conn) {
      header('Location: account');
      exit();
    }

    // Validation des champs :
    if (empty($old_password)) {
      $_SESSION['messages']['errors'][] =
        'Votre mot de passe actuel est requis pour valider les modifications.';
    } elseif (empty($nom) || empty($prenom) || empty($email)) {
      $_SESSION['messages']['errors'][] =
        "Le nom, le prénom et l'email sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['messages']['errors'][] = "L'adresse email n'est pas valide.";
    } else {
      // Vérification du mot de passe actuel :
      $sql = 'SELECT user_password FROM user WHERE user_id = :id';
      $stmt = $conn->prepare($sql);
      $stmt->execute([':id' => $_SESSION['user_id']]);
      $user = $stmt->fetch();

      if (!verify_password_and_migrate($old_password, $user['user_password'], $_SESSION['user_id'], $conn)) {
        $_SESSION['messages']['errors'][] =
          'Le mot de passe actuel est incorrect.';
      } else {
        // Vérification de l'unicité de l'email
        $sql =
          'SELECT COUNT(*) FROM user WHERE user_mail = :mail AND user_id != :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':mail' => $email, ':id' => $_SESSION['user_id']]);

        if ($stmt->fetchColumn() > 0) {
          $_SESSION['messages']['errors'][] =
            'Cette adresse email est déjà utilisée par un autre compte.';
        } else {
          // Mise à jour des informations de base :
          $sql =
            'UPDATE user SET user_nom = :nom, user_prenom = :prenom, user_mail = :mail WHERE user_id = :id';
          $stmt = $conn->prepare($sql);
          $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':mail' => $email,
            ':id' => $_SESSION['user_id'],
          ]);

          // Mise à jour de la session pour que les changements soient visibles immédiatement
          $_SESSION['user_nom'] = $nom;
          $_SESSION['user_prenom'] = $prenom;
          $_SESSION['user_mail'] = $email;

          $_SESSION['messages']['confirm'][] =
            'Vos informations personnelles ont été mises à jour.';

          // Mise à jour du mot de passe (si renseigné)
          if (!empty($new_password)) {
            if (strlen($new_password) < 6) {
              $_SESSION['messages']['errors'][] =
                'Le nouveau mot de passe doit contenir au moins 6 caractères.';
            } elseif ($new_password !== $password_confirm) {
              $_SESSION['messages']['errors'][] =
                'Les nouveaux mots de passe ne correspondent pas.';
            } else {
              $sql =
                'UPDATE user SET user_password = :pass WHERE user_id = :id';
              $stmt = $conn->prepare($sql);
              $stmt->execute([
                ':pass' => password_hash($new_password, PASSWORD_DEFAULT),
                ':id' => $_SESSION['user_id'],
              ]);
              $_SESSION['messages']['confirm'][] =
                'Votre mot de passe a également été modifié.';
            }
          }
        }
      }
    }
  } catch (Throwable $e) {
    $_SESSION['messages']['errors'][] =
      'Erreur lors de la mise à jour.';
  }

  // Redirection
  header('Location: account');
  exit();
}

// Logique de mise à jour du rang (Paiement PayPal)
if (isset($_SESSION['prix'])) {
  $date = date('d/m/Y');
  $new_rang = '';

  if ($_SESSION['prix'] == 10) {
    $new_rang = 'progresser';
  } elseif ($_SESSION['prix'] == 20) {
    $new_rang = 'peaufiner';
  } elseif ($_SESSION['prix'] == 30) {
    $new_rang = 'confirmer';
  }

  if (!empty($new_rang) && isset($conn)) {
    try {
      $sql =
        'UPDATE user SET user_rang = :rang, user_date = :date WHERE user_id = :id';
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':rang' => $new_rang,
        ':date' => $date,
        ':id' => $_SESSION['user_id'],
      ]);
      $_SESSION['user_rang'] = $new_rang;
      $_SESSION['user_date'] = $date;
      $_SESSION['messages']['confirm'][] =
        'Abonnement mis à jour ! Nouveau rang : ' . strtoupper($new_rang);
    } catch (Throwable $e) {
      $_SESSION['messages']['errors'][] = 'Erreur lors de la mise à jour du rang.';
    }
  }
  unset($_SESSION['prix']);
}

// Chargement de la vue
require 'app/account/views/account_view.php';
