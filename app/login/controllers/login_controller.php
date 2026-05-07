<?php

// Si l'utilisateur est déjà connecté, on le redirige
if (isset($_SESSION['user_id'])) {
  header('Location: home');
  exit();
}

// Récupération de la donnée stockée en session si elle existe (après une erreur)
$login_value = $_SESSION['inputs']['login'] ?? '';
unset($_SESSION['inputs']['login']);

// Traitement du formulaire de connexion (anciennement login_cible.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = strtolower(trim($_POST['login'] ?? ''));
  $password = $_POST['password'] ?? '';

  // Stockage temporaire en session pour persistance après redirection
  $_SESSION['inputs']['login'] = $login;

  try {
    if (!$conn) {
      header('Location: login');
      exit();
    }

    if (!empty($login) && !empty($password)) {
      // On récupère l'utilisateur par son email uniquement
      $sql = 'SELECT * FROM user WHERE user_mail = :mail';
      $stmt = $conn->prepare($sql);
      $stmt->execute([':mail' => $login]);
      $user = $stmt->fetch();

      if ($user && verify_password_and_migrate($password, $user['user_password'], $user['user_id'], $conn)) {
        // Succès : on vide les inputs stockés
        unset($_SESSION['inputs']['login']);
        session_regenerate_id(true);

        $_SESSION['user_nom'] = $user['user_nom'];
        $_SESSION['user_rang'] = $user['user_rang'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_prenom'] = $user['user_prenom'];
        $_SESSION['user_mail'] = $user['user_mail'];
        $_SESSION['user_date'] = $user['user_date'];
        $_SESSION['is_admin'] = ($user['is_admin'] == 1) ? 'true' : 'false';

        $_SESSION['messages']['confirm'][] = 'Connexion réussie. Ravi de vous revoir ' . $_SESSION['user_prenom'] . '!';
        header('Location: avdj');
        exit();
      } else {
        $_SESSION['messages']['errors'][] = "L'adresse mail ou le mot de passe est incorrect.";
      }
    } else {
      $_SESSION['messages']['errors'][] = 'Veuillez remplir tous les champs.';
    }
  } catch (PDOException $e) {
    $_SESSION['messages']['errors'][] = $e->getMessage();
  }

  // Redirection vers la page de login pour éviter le renvoi du formulaire (ERR_CACHE_MISS)
  header('Location: login');
  exit();
}

// Chargement de la vue
require 'app/login/views/login_view.php';
