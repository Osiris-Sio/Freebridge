<?php

// Vérification de sécurité (Admin seulement)
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 'true') {
  $_SESSION['messages']['errors'][] = "Accès refusé : vous n'avez pas les droits d'administrateur.";
  header('Location: home');
  exit();
}

// Traitement du changement de niveau (Rang)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_rang') {

  // Vérification CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    $_SESSION['messages']['errors'][] = "Erreur de validation de session. Veuillez reessayer.";
    header('Location: gestion');
    exit();
  }

  $user_id = $_POST['user_id'] ?? null;
  $new_rang = $_POST['new_rang'] ?? null;
  $old_rang = $_POST['old_rang'] ?? null;

  if ($user_id && $new_rang) {
    if ($new_rang === $old_rang) {
      $_SESSION['messages']['confirm'][] = "Aucun changement détecté pour cet utilisateur.";
    } else {
      try {
        if (!$conn) {
          throw new Exception("Erreur de connexion à la base de données.");
        }
        $sql = "UPDATE user SET user_rang = :rang WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':rang' => $new_rang, ':id' => $user_id]);
        $_SESSION['messages']['confirm'][] = "Le rang de l'utilisateur a été mis à jour avec succès.";
      } catch (Exception $e) {
        $_SESSION['messages']['errors'][] = "Erreur lors de la mise à jour du rang.";
      }
    }
  }
  header('Location: gestion');
  exit();
}

// Récupération des filtres
$search = $_GET['search'] ?? '';
$filter_rang = $_GET['filter_rang'] ?? '';

// Construction de la requête de récupération des utilisateurs
$sql = "SELECT user_id, user_nom, user_prenom, user_mail, user_rang, user_date, is_admin FROM user WHERE 1=1";
$params = [];

if (!empty($search)) {
  $sql .= " AND (user_nom LIKE :search OR user_prenom LIKE :search OR user_mail LIKE :search)";
  $params[':search'] = "%$search%";
}

if (!empty($filter_rang)) {
  $sql .= " AND user_rang = :filter_rang";
  $params[':filter_rang'] = $filter_rang;
}

$sql .= " ORDER BY user_date DESC";

try {
  if (!$conn) {
    throw new Exception("Erreur de connexion à la base de données.");
  }
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  $_SESSION['messages']['errors'][] = "Erreur lors de la récupération des utilisateurs.";
}

// Liste des rangs disponibles pour le filtre et le changement
$available_rangs = ['debutant', 'progresser', 'peaufiner', 'confirmer'];

// Chargement de la vue
require_once 'app/gestion/views/gestion_view.php';
