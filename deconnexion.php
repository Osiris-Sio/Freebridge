<html>
<?php
session_start();
session_destroy();

$_SESSION['messages']['confirm'][] = 'Vous avez été déconnecté avec succès.';
header('location:index.php');
?>

</html>