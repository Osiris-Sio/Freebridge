<?php
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$message = $_POST['demande'];

$to = 'bernard.glorie.62@orange.fr';
$subject = 'Demande ' . $nom . ' ' . $prenom . ' via le formulaire de freebridge';
$body = 'la demande faite est la suivante :<br> ' . $message;
$body .= "<br><br> avec l'adresse mail suivante : " . $mail;
$headers = "From: \"$nom $prenom\"<$mail>\n";
$headers .= "Reply-To: bernard.glorie62@orange.fr\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to, $subject, $body, $headers);
header('location: index.php');
