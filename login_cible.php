<?php
include 'includes/header.php';

$login = strtolower($_POST['login'] ?? '');
$mdp = sha1($_POST['password'] ?? '');

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
} else {
  $_SESSION['messages']['errors'][] =
    "L'adresse mail ou le mot de passe est incorrect.";
  header('Location: login.php');
}
exit();
?>
