<?php
$serveur = "localhost";
$base = 'sitefreebridge';
$utilisateur = 'sitefreebridge';
$motDePasse = '***REMOVED***';

try {
  $dns = "mysql:host=$serveur;dbname=$base";
  $conn = new PDO( $dns, $utilisateur, $motDePasse );
}
catch ( Exception $e ) {
  echo "Connexion MySQL impossible : ", $e->getMessage();
  die();
}


/*$serveur = "localhost";
$base = 'id8770898_freebridge';
$utilisateur = 'id8770898_defachellesma';
$motDePasse = '***REMOVED***';

try {
  $dns = "mysql:host=$serveur;dbname=$base";
  $conn = new PDO( $dns, $utilisateur, $motDePasse );
}
catch ( Exception $e ) {
  echo "Connexion MySQL impossible : ", $e->getMessage();
  die();
}

$serveur = "localhost";
$base = 'freebridge';
$utilisateur = 'root';
$motDePasse = 'root';

try {
    $dns = "mysql:host=$serveur;dbname=$base";
    $conn = new PDO( $dns, $utilisateur, $motDePasse );
}
catch ( Exception $e ) {
    echo "Connexion MySQL impossible : ", $e->getMessage();
    die();
}*/
?>
