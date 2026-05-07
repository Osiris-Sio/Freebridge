<?php

/**
 * Vérifie un mot de passe et migre le hachage si nécessaire (SHA1 -> password_hash)
 * 
 * @param string $password_plain : Le mot de passe saisi par l'utilisateur (en clair)
 * @param string $db_hash : Le hachage stocké en base de données
 * @param int|string $user_id : L'ID de l'utilisateur pour une éventuelle mise à jour
 * @param PDO $conn : La connexion à la base de données
 * @return bool : True si le mot de passe est valide, False sinon
 */
function verify_password_and_migrate($password_plain, $db_hash, $user_id, $conn)
{
    // Vérification standard avec password_hash
    if (password_verify($password_plain, $db_hash)) {
        return true;
    }

    // Vérification héritée avec SHA1 (Migration transparente)
    // On vérifie si le hachage en base ressemble à un SHA1 (40 caractères hexadécimaux)
    if (strlen($db_hash) === 40 && $db_hash === sha1($password_plain)) {
        // Le mot de passe est correct, on le migre immédiatement vers le nouveau format
        $new_hash = password_hash($password_plain, PASSWORD_DEFAULT);

        try {
            $sql = "UPDATE user SET user_password = :pass WHERE user_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':pass' => $new_hash, ':id' => $user_id]);
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur de mise à jour, on laisse quand même passer l'utilisateur
            // mais il restera en SHA1 jusqu'à sa prochaine tentative réussie.
            return true;
        }
    }

    return false;
}
