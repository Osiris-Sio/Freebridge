<?php
include 'includes/header.php';
$login = strtolower($_POST['login']);
$mdp = sha1($_POST['password']);
$sql = "SELECT COUNT(*) FROM user WHERE user_mail ='".$login."' AND user_password ='".$mdp."'";
$result = $conn->prepare($sql);
$result->execute();
$number_of_rows = $result->fetchColumn();
if ($number_of_rows>0) {
    $sql = "SELECT * FROM user WHERE user_mail ='".$login."' AND user_password ='".$mdp."'";
    $result = $conn->query($sql);
    while($rows = $result->fetch()) {
        $loginbdd = $rows["user_mail"];
        $nombdd = $rows["user_nom"];
        $rangbdd = $rows["user_rang"];
        $idbdd = $rows["user_id"];
        $prenombdd = $rows['user_prenom'];
        $mailbdd = $rows['user_mail'];
    }
    $_SESSION['user_nom']= $nombdd;
    $_SESSION['user_rang']= $rangbdd;
    $_SESSION['user_id']= $idbdd;
    $_SESSION['user_prenom'] = $prenombdd;
    $_SESSION['user_mail']=$mailbdd;
    echo '<script>document.location.href="index.php"</script>';
} else {
    echo "<center><h4 style='margin-top:20%; color: rgb(63,81,181)'>Le mot de passe ou l'adresse mail que vous avez rentré est incorrect</h4></center>";
    echo '<script>setTimeout(function() {
  document.location.href="login.php"
}, 3000)</script>';
}
include 'includes/footer.php';
?>
