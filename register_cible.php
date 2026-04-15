<?php
include 'includes/header.php';
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['login'];
$date = date('d/m/Y');
$password = sha1($_POST['password']);
$sql = "SELECT COUNT(*) FROM user WHERE user_mail ='" . $mail . "'";
$result = $conn->prepare($sql);
$result->execute();
$number_of_rows = $result->fetchColumn();
if ($number_of_rows == 0) {

  $sql = $conn->prepare(
    "INSERT INTO user(user_nom,user_prenom,user_rang,user_mail,user_password, user_date) VALUES ('" .
      $nom .
      "','" .
      $prenom .
      "','debutant','" .
      $mail .
      "','" .
      $password .
      "','" .
      $date .
      "')",
  );
  $sql->execute();
  ?>
	<main class="mdl-layout__content">
    		<div class="page-content">
        		<section style="margin: 5% 20%; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding: 1%; background-color: white">
            			<div class="page-content colorgreen" style="color: black; text-align: center">
                			Votre compte à bien été créé. Vous allez être redirigé vers la page de connexion
                                </div>
        		</section>
    		</div>
	</main>
	<?php echo '<script>setTimeout(function() { document.location.href="login.php"}, 3000)</script>';
} else {
   ?>
	<main class="mdl-layout__content">
    		<div class="page-content">
        		<section style="margin: 5% 20%; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding: 1%; background-color: white">
            			<div class="page-content colorgreen" style="color: black; text-align: center">
                			Un compte existe d&eacute;j&agrave; avec cet adresse mail
                                </div>
        		</section>
    		</div>
	</main>
	<?php echo '<script>setTimeout(function() { document.location.href="register.php"}, 3000)</script>';
}

include 'includes/footer.php';
