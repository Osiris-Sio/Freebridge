<?php

/**
 * Contrôleur pour la suppression du compte utilisateur
 */

// Vérification de sécurité : l'utilisateur doit être connecté
if (!isset($_SESSION['user_id'])) {
    $_SESSION['messages']['errors'][] = "Vous devez être connecté pour supprimer votre compte.";
    header('Location: login');
    exit();
}

// Traitement de la suppression (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $user_id = $_SESSION['user_id'];
    $password = $_POST['password'] ?? '';

    try {
        if (!$conn) {
            throw new Exception("Erreur de connexion à la base de données.");
        }

        // Vérification du mot de passe
        $sql = "SELECT user_password FROM user WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $user_id]);
        $user = $stmt->fetch();

        if (!$user || !verify_password_and_migrate($password, $user['user_password'], $user_id, $conn)) {
            $_SESSION['messages']['errors'][] = "Le mot de passe saisi est incorrect. Suppression annulée.";
            header('Location: delete_account');
            exit();
        }

        // Suppression de l'utilisateur
        $sql = "DELETE FROM user WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $user_id]);

        // Déconnexion et destruction de la session
        session_destroy();
        session_start();
        $_SESSION['messages']['confirm'][] = "Votre compte a été supprimé avec succès. Nous sommes désolés de vous voir partir.";

        header('Location: home');
        exit();
    } catch (Exception $e) {
        $_SESSION['messages']['errors'][] = "Une erreur est survenue lors de la suppression de votre compte. Veuillez contacter un administrateur si le problème persiste.";
        header('Location: account');
        exit();
    }
}

require_once 'app/account/views/delete_account_view.php';
