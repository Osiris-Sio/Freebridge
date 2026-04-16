<?php

$login_value = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = strtolower($_POST['login'] ?? '');
    $login_value = $login;

    if (!empty($login)) {
        // Vérifier si l'utilisateur existe
        $sql = "SELECT COUNT(*) FROM user WHERE user_mail = :mail";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':mail' => $login]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            // Génération d'un mot de passe aléatoire
            function generate_random_password($length = 8)
            {
                $chars = 'azertyuiopqsdfghjklmwxcvbn123456789';
                $password = '';
                for ($i = 0; $i < $length; $i++) {
                    $password .= $chars[mt_rand(0, strlen($chars) - 1)];
                }
                return $password;
            }

            $new_pass = generate_random_password();
            $hashed_pass = sha1($new_pass);

            // Mise à jour en base
            $sql = "UPDATE user SET user_password = :pass WHERE user_mail = :mail";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':pass' => $hashed_pass,
                ':mail' => $login
            ]);

            // Envoi de l'email
            $to = $login;
            $subject = 'Nouveau mot de passe FreeBridge';
            $message = 'Votre nouveau mot de passe est le suivant : ' . $new_pass;
            $no_reply = getenv('NO_REPLY_EMAIL') ?: 'no-reply@freebridge.fr';
            $headers = "From: $no_reply\r\n" .
                "Reply-To: $no_reply\r\n" .
                "X-Mailer: PHP/" . phpversion();

            // Envoi de l'email
            if (@mail($to, $subject, $message, $headers)) {
                $_SESSION['messages']['confirm'][] = "Votre nouveau mot de passe a bien été envoyé à l'adresse : " . htmlspecialchars($login);
                header('Location: login');
                exit();
            } else {
                // En local, comme l'email échoue souvent, on affiche le mot de passe pour ne pas bloquer l'utilisateur
                $_SESSION['messages']['errors'][] = "L'envoi de l'email a échoué. Voici votre nouveau mot de passe pour vos tests : <strong>" . $new_pass . "</strong>";
            }
        } else {
            $_SESSION['messages']['errors'][] = "Aucun compte n'est associé à cette adresse mail.";
        }
    } else {
        $_SESSION['messages']['errors'][] = "Veuillez saisir votre adresse mail.";
    }
}

// Chargement de la vue
require 'app/lostpassword/views/lostpassword_view.php';
