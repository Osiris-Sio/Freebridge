<?php

// Si l'utilisateur est déjà connecté, on le redirige
if (isset($_SESSION['user_id'])) {
  header('Location: home');
  exit();
}

// Récupération des données stockées en session si elles existent (après une erreur)
$form_data = $_SESSION['inputs']['register'] ?? [];
unset($_SESSION['inputs']['register']);

// On vérifie si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Vérification CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    $_SESSION['messages']['errors'][] = "Erreur de validation de session. Veuillez reessayer.";
    header('Location: register');
    exit();
  }

  $nom = $_POST['nom'] ?? '';
  $prenom = $_POST['prenom'] ?? '';
  $mail = $_POST['login'] ?? '';
  $password = $_POST['password'] ?? '';
  $password_confirm = $_POST['password_confirm'] ?? '';
  $date = date('d/m/Y');

  // Stockage temporaire en session pour persistance après redirection
  $_SESSION['inputs']['register'] = [
    'nom' => $nom,
    'prenom' => $prenom,
    'login' => $mail,
  ];

  try {
    // Si la connexion a échoué (déjà géré dans pdo.php), on ne fait rien
    if (!$conn) {
      header('Location: register');
      exit();
    }

    // Vérification des champs
    if (empty($nom) || empty($prenom) || empty($mail) || empty($password)) {
      $_SESSION['messages']['errors'][] =
        'Veuillez remplir tous les champs obligatoires.';
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['messages']['errors'][] = "L'adresse mail n'est pas valide.";
    } elseif ($password !== $password_confirm) {
      $_SESSION['messages']['errors'][] =
        'Les mots de passe ne correspondent pas.';
    } elseif (strlen($password) < 6) {
      $_SESSION['messages']['errors'][] =
        'Le mot de passe doit contenir au moins 6 caractères.';
    } else {
      // Vérifier si l'utilisateur existe déjà
      $sql = 'SELECT COUNT(*) FROM user WHERE user_mail = :mail';
      $stmt = $conn->prepare($sql);
      $stmt->execute([':mail' => $mail]);
      $exists = $stmt->fetchColumn();

      if ($exists == 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user` (`user_nom`, `user_prenom`, `user_rang`, `user_mail`, `user_password`, `user_date`) 
                VALUES (:nom, :prenom, 'debutant', :mail, :hashed_password, :date)";
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute([
          ':nom' => $nom,
          ':prenom' => $prenom,
          ':mail' => $mail,
          ':hashed_password' => $hashed_password,
          ':date' => $date,
        ]);

        if ($success) {
          unset($_SESSION['inputs']['register']);
          $_SESSION['messages']['confirm'][] =
            'Votre compte a bien été créé ! Vous pouvez maintenant vous connecter.';
          header('Location: login');
          exit();
        } else {
          $_SESSION['messages']['errors'][] =
            'Une erreur est survenue lors de la création de votre compte.';
        }
      } else {
        $_SESSION['messages']['errors'][] =
          'Un compte existe déjà avec cette adresse mail.';
      }
    }
  } catch (Throwable $th) {
    $_SESSION['messages']['errors'][] = "Une erreur systeme est survenue lors de la creation de votre compte. Veuillez reessayer plus tard.";
  }

  // Redirection vers la page d'inscription pour éviter le renvoi du formulaire
  header('Location: register');
  exit();
}

// Chargement de la vue
require 'app/register/views/register_view.php';
