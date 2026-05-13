<?php

session_destroy(); // On détruit la session
session_start(); // On redémarre une session vide pour porter le message flash

$_SESSION['messages']['confirm'][] = 'Vous avez été déconnecté avec succès.';
header('Location: index.php');
exit();
