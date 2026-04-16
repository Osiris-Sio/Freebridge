<?php

// Si l'utilisateur n'est pas connecté, on le redirige
if (!isset($_SESSION['user_id'])) {
    header('Location: login');
    exit();
}

// Logique de mise à jour du rang (exécutée si l'URL ou la session contient des infos post-paiement)
if (isset($_SESSION['prix'])) {
    $date = date('d/m/Y');
    $new_rang = '';

    if ($_SESSION['prix'] == 2) {
        $new_rang = 'progresser';
    } elseif ($_SESSION['prix'] == 3) {
        $new_rang = 'peaufiner';
    } elseif ($_SESSION['prix'] == 4) {
        $new_rang = 'confirmer';
    }

    // Si le rang est vide, on ne fait rien
    if (!empty($new_rang)) {
        $sql = "UPDATE user SET user_rang = :rang, user_date = :date WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':rang' => $new_rang,
            ':date' => $date,
            ':id'   => $_SESSION['user_id']
        ]);

        // On met à jour la session pour refléter le changement immédiatement
        $_SESSION['user_rang'] = $new_rang;
        $_SESSION['user_date'] = $date;

        unset($_SESSION['prix']); // On nettoie pour éviter les répétitions
    }
}

require 'app/compte/views/compte_view.php';
