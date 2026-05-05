<?php include 'includes/header.php'; ?>

<section>
    <header>
        <h1>Mon Compte</h1>
        <p>Heureux de vous revoir, <strong><?= htmlspecialchars(
                                                $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom'],
                                            ) ?></strong> !</p>
    </header>
    <hr>
    <article>
        <header>
            <strong>Modifier mes informations personnelles</strong>
        </header>
        <form action="account" method="post">
            <div class="grid">
                <div>
                    <label for="nom">Nom</label>
                    <input required type="text" name="nom" id="nom" value="<?= htmlspecialchars(
                                                                                $_SESSION['user_nom'] ?? '',
                                                                            ) ?>">
                </div>
                <div>
                    <label for="prenom">Prénom</label>
                    <input required type="text" name="prenom" id="prenom" value="<?= htmlspecialchars(
                                                                                        $_SESSION['user_prenom'] ?? '',
                                                                                    ) ?>">
                </div>
            </div>

            <label for="email">Adresse email</label>
            <input required type="email" name="email" id="email"
                value="<?= htmlspecialchars($_SESSION['user_mail'] ?? '') ?>">


            <label for="old_password">Mot de passe actuel (requis pour valider les changements)</label>
            <input required type="password" name="old_password" id="old_password" placeholder="Saisissez votre mot de passe actuel">
            <hr>
            <p><small><i>Laissez les champs suivants vides si vous ne souhaitez pas changer votre mot de passe.</i></small></p>

            <div class="grid">
                <div>
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" pattern=".{6,}" title="6 caractères minimum">
                </div>
                <div>
                    <label for="password_confirmation">Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le nouveau mot de passe">
                </div>
            </div>

            <label>
                <input type="checkbox" class="password-toggle">
                Afficher les mots de passe
            </label>
            <br>
            <button type="submit">Enregistrer les modifications</button>
        </form>
    </article>

    <hr>

    <div class="grid">
        <!-- Infos Abonnement -->
        <article>
            <header>
                <strong>Gestion des abonnements</strong>
            </header>
            <p>Les abonnements sont mensuels et dépendent du niveau choisi.</p>
            <p><small>Il est possible de se désabonner à tout instant. Pour passer à une catégorie supérieure, désabonnez-vous puis choisissez le nouveau niveau.</small></p>
            <!--
            <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=<?= getenv(
                                                                                        'PAYPAL_UNSUBSCRIBE_ALIAS',
                                                                                    ) ?>">
                <img src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_unsubscribe_LG.gif" alt="Se désabonner">
                <br>Gérer mon désabonnement
            </a>
            -->
        </article>

        <!-- État Actuel -->
        <article>
            <header>
                <strong>Statut de votre compte</strong>
            </header>
            <p>Votre rang actuel : <br>
                <kbd><?= strtoupper(
                            $_SESSION['user_rang'] ?? 'INACTIF',
                        ) ?></kbd>
            </p>
            <p>Membre depuis le : <br>
                <strong><?= htmlspecialchars(
                            $_SESSION['user_date'] ?? 'Inconnue',
                        ) ?></strong>
            </p>
        </article>
    </div>
    <!--
    <hr>

    <header>
        <h2>Choisir un niveau d'accès</h2>
        <p>Accédez à des contenus pédagogiques plus avancés.</p>
    </header>
    
    <div class="grid">

    Niveau Peaufiner 
    <article>
        <header>
            <hgroup>
                <h3>Peaufiner</h3>
                <p>Pour approfondir votre technique</p>
            </hgroup>
            <p><mark>3,00€ / mois</mark></p>
        </header>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="<?= getenv(
                                                                    'PAYPAL_BUTTON_ID_PEAUFINER',
                                                                ) ?>">
            <input type="hidden" name="currency_code" value="EUR">
            <input type="hidden" name="on0" value="Peaufiner">
            <input type="hidden" name="os0" value="Accès">
            <button type="submit" class="primary">S'abonner</button>
        </form>
    </article>

    <article>
        <header>
            <hgroup>
                <h3>Confirmer</h3>
                <p>Le niveau expert</p>
            </hgroup>
            <p><mark>4,00€ / mois</mark></p>
        </header>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="<?= getenv(
                                                                    'PAYPAL_BUTTON_ID_CONFIRMER',
                                                                ) ?>">
            <input type="hidden" name="currency_code" value="EUR">
            <input type="hidden" name="on0" value="Confirmer">
            <input type="hidden" name="os0" value="Accès">
            <button type="submit" class="primary">S'abonner</button>
        </form>
    </article>
    </div>
    -->
</section>

<?php include 'includes/footer.php'; ?>