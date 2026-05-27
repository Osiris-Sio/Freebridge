<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>Suppression du compte</h1>
    </header>

    <p>Êtes-vous sûr de vouloir supprimer votre compte <strong>Freebridge</strong> ?</p>
    <p>Toutes vos données seront définitivement effacées de notre base de données.</p>

    <footer>
        <form method="post" action="delete_account">
            <!-- Vérification CSRF -->
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <label for="password">Veuillez saisir votre mot de passe pour confirmer :</label>
            <input type="password" id="password" name="password" required placeholder="Votre mot de passe actuel">

            <label>
                <input type="checkbox" class="password-toggle">
                Afficher le mot de passe
            </label>

            <br>

            <div class="grid">
                <button type="button" class="secondary" onclick="window.location.href='account'">
                    ← Retour au compte
                </button>
                <button type="submit" name="confirm_delete" style="background-color: red; border-color: red;">
                    Oui, supprimer mon compte
                </button>
            </div>
        </form>
    </footer>
</article>

<?php include 'includes/footer.php'; ?>