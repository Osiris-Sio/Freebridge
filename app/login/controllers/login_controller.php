<?php

// Si l'utilisateur est déjà connecté, on le redirige
if (isset($_SESSION['user_id'])) {
  header('Location: home');
  exit();
}

$login_value = '';

// Traitement du formulaire de connexion (anciennement login_cible.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = strtolower($_POST['login'] ?? '');
  $mdp = sha1($_POST['password'] ?? '');
  $login_value = $login;

  if (!empty($login) && !empty($mdp)) {
    $sql =
      'SELECT * FROM user WHERE user_mail = :mail AND user_password = :password';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ':mail' => $login,
      ':password' => $mdp,
    ]);

    $user = $stmt->fetch();

    if ($user) {
      $_SESSION['user_nom'] = $user['user_nom'];
      $_SESSION['user_rang'] = $user['user_rang'];
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['user_prenom'] = $user['user_prenom'];
      $_SESSION['user_mail'] = $user['user_mail'];
      $_SESSION['user_date'] = $user['user_date'];

      $_SESSION['messages']['confirm'][] =
        'Connexion réussie. Ravi de vous revoir !';
      header('Location: index.php');
      exit();
    } else {
      $_SESSION['messages']['errors'][] =
        "L'adresse mail ou le mot de passe est incorrect.";
    }
  } else {
    $_SESSION['messages']['errors'][] = 'Veuillez remplir tous les champs.';
  }
}

// Chargement de la vue
require 'app/login/views/login_view.php';
