<?php

$form_data = [];

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $message = $_POST['demande'] ?? '';

    // On stocke les données du formulaire
    $form_data = ['nom' => $nom, 'prenom' => $prenom, 'mail' => $mail, 'demande' => $message];

    // Vérification des champs
    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($message)) {
        // Envoi de l'email
        $to = getenv('CONTACT_EMAIL_BERNARD') ?: 'bernard.glorie.62@orange.fr';
        $subject = 'Demande ' . $nom . ' ' . $prenom . ' via le formulaire de freebridge';

        $body = "La demande faite est la suivante :<br><br>" . nl2br(htmlspecialchars($message));
        $body .= "<br><br>Avec l'adresse mail suivante : " . htmlspecialchars($mail);

        $headers = "From: " . mb_encode_header_object("$nom $prenom", $mail) . "\r\n";
        $headers .= "Reply-To: $mail\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (@mail($to, $subject, $body, $headers)) {
            $_SESSION['messages']['confirm'][] = "Votre message a bien été envoyé. Nous vous répondrons prochainement.";
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['messages']['errors'][] = "Une erreur est survenue lors de l'envoi du message.";
        }
    } else {
        $_SESSION['messages']['errors'][] = "Veuillez remplir tous les champs.";
    }
}

// Fonction utilitaire pour encoder les headers si nécessaire
function mb_encode_header_object($name, $email)
{
    return '"' . addslashes($name) . '" <' . $email . '>';
}

// Chargement de la vue
require 'app/formulaire/views/formulaire_view.php';
