<?php

// Si l'utilisateur est déjà connecté, on le redirige
if (isset($_SESSION['user_id'])) {
    header('Location: home');
    exit();
}

$form_data = [];

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $mail = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $date = date('d/m/Y');

    $form_data = ['nom' => $nom, 'prenom' => $prenom, 'login' => $mail];

    // Vérification des champs
    if (empty($nom) || empty($prenom) || empty($mail) || empty($password)) {
        $_SESSION['messages']['errors'][] = "Veuillez remplir tous les champs obligatoires.";
    } elseif ($password !== $password_confirm) {
        $_SESSION['messages']['errors'][] = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $sql = "SELECT COUNT(*) FROM user WHERE user_mail = :mail";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':mail' => $mail]);
        $exists = $stmt->fetchColumn();

        // Si l'utilisateur n'existe pas, on l'insère
        if ($exists == 0) {
            $hashed_password = sha1($password);
            $sql = "INSERT INTO user(user_nom, user_prenom, user_rang, user_mail, user_password, user_date) 
                    VALUES (:nom, :prenom, 'debutant', :mail, :hashed_password, :date)";
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute([
                ':nom'      => $nom,
                ':prenom'   => $prenom,
                ':mail'     => $mail,
                ':hashed_password' => $hashed_password,
                ':date'     => $date
            ]);

            // Si l'insertion réussit, on redirige vers la page de connexion
            if ($success) {
                $_SESSION['messages']['confirm'][] = "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter.";
                header('Location: login');
                exit();
            } else {
                $_SESSION['messages']['errors'][] = "Une erreur est survenue lors de la création de votre compte.";
            }
        } else {
            $_SESSION['messages']['errors'][] = "Un compte existe déjà avec cette adresse mail.";
        }
    }
}

// Chargement de la vue
require 'app/register/views/register_view.php';
