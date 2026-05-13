<?php

/**
 * Contrôleur du formulaire de contact
 * Utilise désormais formsubmit.co directement dans la vue
 */

$form_data = [];

// Si l'utilisateur est connecté, on pré-remplit ses informations
if (isset($_SESSION['user_id'])) {
  $form_data = [
    'nom' => $_SESSION['user_nom'] ?? '',
    'prenom' => $_SESSION['user_prenom'] ?? '',
    'mail' => $_SESSION['user_mail'] ?? '',
  ];
}

// Chargement de la vue
require 'app/contact/views/contact_view.php';
