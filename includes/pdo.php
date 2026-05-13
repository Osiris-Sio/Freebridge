<?php

/**
 * Configuration PDO avec chargement des variables d'environnement
 */

function loadEnv($path)
{
  if (!file_exists($path)) {
    return false;
  }
  $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    $line = trim($line);
    if (empty($line) || strpos($line, '#') === 0) {
      continue;
    }
    if (strpos($line, '=') !== false) {
      [$name, $value] = explode('=', $line, 2);
      $name = trim($name);
      $value = trim(trim($value), '"\'');
      putenv("$name=$value");
      $_ENV[$name] = $value;
      $_SERVER[$name] = $value;
    }
  }
  return true;
}

// Chemin du fichier .env à la racine
$envPath = dirname(__DIR__) . '/.env';
if (!loadEnv($envPath)) {
  error_log('Fichier .env introuvable au chemin : ' . $envPath);
}

// Récupération des données du .env
$serveur = getenv('DB_HOST') ?: 'localhost';
$base = getenv('DB_NAME');
$utilisateur = getenv('DB_USER');
$motDePasse = getenv('DB_PASS');

$conn = null;
try {
  $dns = "mysql:host=$serveur;dbname=$base";
  $conn = new PDO($dns, $utilisateur, $motDePasse);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->exec('set names utf8');
} catch (Exception $e) {
  error_log('Erreur de connexion MySQL : ' . $e->getMessage());

  // On ajoute le message dans votre système de Toasts (seulement s'il n'y est pas déjà)
  if (!isset($_SESSION['messages']['errors'])) {
    $_SESSION['messages']['errors'] = [];
  }
  $msg =
    "Une erreur est survenue lors de la connexion à la base de données. L'accès peut être restreint.";
  if (!in_array($msg, $_SESSION['messages']['errors'])) {
    $_SESSION['messages']['errors'][] = $msg;
  }
}
