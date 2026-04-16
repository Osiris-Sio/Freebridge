<?php
include 'includes/header.php';

$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$mail = $_POST['login'] ?? '';
$password = isset($_POST['password']) ? sha1($_POST['password']) : '';
$date = date('d/m/Y');

if (empty($mail) || empty($password)) {
  $_SESSION['messages']['errors'][] =
    'Veuillez remplir tous les champs obligatoires.';
  header('Location: register.php');
  exit();
}

// Vérifier si l'utilisateur existe déjà
$sql = 'SELECT COUNT(*) FROM user WHERE user_mail = :mail';
$stmt = $conn->prepare($sql);
$stmt->execute([':mail' => $mail]);
$exists = $stmt->fetchColumn();

if ($exists == 0) {
  // Création du compte
  $sql = "INSERT INTO user(user_nom, user_prenom, user_rang, user_mail, user_password, user_date) 
            VALUES (:nom, :prenom, 'debutant', :mail, :password, :date)";
  $stmt = $conn->prepare($sql);
  $success = $stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':mail' => $mail,
    ':password' => $password,
    ':date' => $date,
  ]);

  if ($success) {
    $_SESSION['messages']['confirm'][] =
      'Votre compte a bien été créé ! Vous pouvez maintenant vous connecter.';
    header('Location: login.php');
  } else {
    $_SESSION['messages']['errors'][] =
      'Une erreur est survenue lors de la création de votre compte.';
    header('Location: register.php');
  }
} else {
  $_SESSION['messages']['errors'][] =
    'Un compte existe déjà avec cette adresse mail.';
  header('Location: register.php');
}
exit();
?>
