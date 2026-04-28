<?php
// router.php - Le cerveau de votre routage

// On récupère l'URL demandée et on nettoie
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Auto-détection du dossier racine si le projet n'est pas à la racine du domaine
$script_name = dirname($_SERVER['SCRIPT_NAME']);
$base_path =
  $script_name === DIRECTORY_SEPARATOR || $script_name === '.'
    ? '/'
    : $script_name . '/';
define('BASE_URL', $base_path);

$path = str_replace($base_path, '', $request_uri);
$path = trim($path, '/');

// Si le chemin est vide, on va sur l'accueil
if ($path === '' || $path === 'index.php') {
  $path = 'home';
}

// --- CAS SPÉCIAL : Fichiers BSOL (Sécurité centralisée et par niveau) ---
if (strpos($path, 'bsol/') === 0) {
  // Sécurité de base (être connecté)
  if (!isset($_SESSION['user_id'])) {
    $_SESSION['messages']['errors'][] =
      'Accès réservé : vous devez être connecté.';
    header('Location: ' . BASE_URL . 'login');
    exit();
  }

  // Sécurité par niveau (Rang de l'utilisateur)
  $user_rang = $_SESSION['user_rang'] ?? 'debutant';

  // Définition des accès
  $can_access = true;
  $required_level = '';

  if (
    strpos($path, 'bsol/Progresser/') !== false &&
    !in_array($user_rang, ['progresser', 'peaufiner', 'confirmer'])
  ) {
    $can_access = false;
    $required_level = 'Progresser';
  } elseif (
    strpos($path, 'bsol/Peaufiner/') !== false &&
    !in_array($user_rang, ['peaufiner', 'confirmer'])
  ) {
    $can_access = false;
    $required_level = 'Peaufiner';
  } elseif (
    strpos($path, 'bsol/Confirmer/') !== false &&
    $user_rang !== 'confirmer'
  ) {
    // Cas particulier : Peaufiner a accès à certains sous-dossiers de Confirmer
    if (
      $user_rang === 'peaufiner' &&
      (strpos($path, 'confirmerProgresser') !== false ||
        strpos($path, 'confirmerPeaufiner') !== false)
    ) {
      $can_access = true;
    } else {
      $can_access = false;
      $required_level = 'Confirmer';
    }
  }

  if (!$can_access) {
    $_SESSION['messages'][
      'errors'
    ][] = "Désolé, votre rang ($user_rang) ne vous permet pas encore d'accéder au niveau $required_level.";
    header('Location: ' . BASE_URL . 'avdj');
    exit();
  }

  // On cherche le fichier physique
  $file_path = $path;
  if (substr($file_path, -4) !== '.php') {
    $file_path .= '.php';
  }

  if (file_exists($file_path)) {
    chdir(dirname($file_path));
    include basename($file_path);
    exit();
  }
}

// On enlève l'extension .php si elle est présente pour le reste du routage
$path = str_replace('.php', '', $path);

// --- Liste des pages PRIVÉES ---
$private_pages = ['account', 'avdj', 'cours', 'correction', 'rubrique'];

if (in_array($path, $private_pages) && !isset($_SESSION['user_id'])) {
  $_SESSION['messages']['errors'][] =
    'Vous devez être connecté pour accéder à cette page.';
  header('Location: ' . BASE_URL . 'login');
  exit();
}

// Table de correspondance (Mapping) des pages importantes (Dans le dossier /app)
$routes = [
  'home' => 'app/home/controllers/home_controller.php',
  'login' => 'app/login/controllers/login_controller.php',
  'register' => 'app/register/controllers/register_controller.php',
  'account' => 'app/account/controllers/account_controller.php',
  'lostpassword' => 'app/lostpassword/controllers/lostpassword_controller.php',
  'contact' => 'app/contact/controllers/contact_controller.php',
  'logout' => 'app/logout/controllers/logout_controller.php',
];

$static_pages = [
  'confidentialite' => 'pages/confidentialite_view.php',
  'mentionslegales' => 'pages/mentionslegales_view.php',
  'glossaire' => 'pages/glossaire_view.php',
  'philosophie' => 'pages/philosophie_view.php',
  'avdj' => 'pages/avdj_view.php',
  'rubrique' => 'pages/rubrique_view.php',
  'cours' => 'pages/cours_view.php',
  'correction' => 'pages/correction_view.php',
  'bvw' => 'Bridge_Viewer_Web/bvw.php',
];

if (array_key_exists($path, $routes)) {
  require_once 'includes/pdo.php';
  require_once $routes[$path];
} elseif (array_key_exists($path, $static_pages)) {
  require_once 'includes/pdo.php';
  require_once $static_pages[$path];
} else {
  http_response_code(404);
  require_once 'includes/pdo.php';
  include 'includes/header.php';
  echo '<article><h1>Erreur 404</h1><p>Désolé, cette page n\'existe pas.</p><a href="home">Retour à l\'accueil</a></article>';
  include 'includes/footer.php';
}
