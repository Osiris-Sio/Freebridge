<?php
include 'header.php';
echo $_POST['login'];
$sql = "SELECT COUNT(*) FROM user WHERE user_mail ='".$_POST['login']."'";
$result = $conn->prepare($sql);
$result->execute();
$number_of_rows = $result->fetchColumn();
if ($number_of_rows<=0) {
     ?>
    <section style="box-shadow: -1px 2px 10px 3px rgba(255, 255, 255, 0.3);margin-left: 20%; text-align: center;margin-right: 20%; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; padding-bottom: 1%;margin-top: 5%; margin-bottom: 10%; background-color: rgba(255, 255, 255, 0.3)">
        <div class="page-content colorgreen" style="color: black; margin-left: 5%; margin-right: 5%; width: 90%">
            Aucun compte n'est associé à cette adresse mail
        </div>
    </section>
    <?php
    echo '<script>setTimeout(function() {
  document.location.href="login.php"
}, 3000)</script>';
} else {
    function chaine_aleatoire($nb_car, $chaine = 'azertyuiopqsdfghjklmwxcvbn123456789')
    {
        $nb_lettres = strlen($chaine) - 1;
        $generation = '';
        for($i=0; $i < $nb_car; $i++)
        {
            $pos = mt_rand(0, $nb_lettres);
            $car = $chaine[$pos];
            $generation .= $car;
        }
        return $generation;
    }
    $newpass = chaine_aleatoire(8);
    $sql = $conn->prepare("UPDATE user SET user_password='".sha1($newpass)."' WHERE user_mail = '".$_POST['login']."';");
    $sql->execute();
    $to      = $_POST['login'];
    $subject = 'Nouveau mot de passe FreeBridge';
    $message = 'Votre nouveau mot de passe est le suivant :'.$newpass;
    $headers = 'From: no-reply@freebridge.fr' . "\r\n" .
        'Reply-To: no-reply@freebridge.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    ?>
    <section style="box-shadow: -1px 2px 10px 3px rgba(255, 255, 255, 0.3);margin-left: 20%; text-align: center;margin-right: 20%; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; padding-bottom: 1%;margin-top: 5%; margin-bottom: 10%; background-color: rgba(255, 255, 255, 0.3)">
        <div class="page-content colorgreen" style="color: black; margin-left: 5%; margin-right: 5%; width: 90%">
            Votre mot de passe vous a bien été envoyé sur l'adresse mail : <?php echo $_POST['login']; ?>
        </div>
    </section>
    <?php
    echo '<script>setTimeout(function() {
  document.location.href="login.php"
}, 3000)</script>';
}
include 'footer.php';
?>