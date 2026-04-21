<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!doctype html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="utf-8">
    <title>Freebridge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?= BASE_URL ?>"> <!-- La solution magique pour vos liens -->
    <link rel="icon" type="image/ico" href="favicon.ico">

    <link rel="stylesheet" href="css/pico.css">
    <link rel="stylesheet" href="css/logo.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/toast.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script src="js/theme.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/toast.js"></script>
    <script src="js/password-toggle.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/level-pages.js" defer></script>
    <script src="js/scroll-to-top.js" defer></script>
    <script>
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>

<body>

    <header>
        <nav class="container">
            <ul>
                <li>
                    <a href="home" class="header-logo-container">
                        <div class="header-logo-image">
                            <img src="assets/img/logo.png" alt="Logo Freebridge">
                        </div>
                    </a>
                </li>
            </ul>

            <!-- Bouton Hamburger mobile -->
            <ul>
                <li>
                    <button id="hamburger-toggle" class="hamburger" aria-label="Menu Principal" type="button">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </li>
            </ul>

            <!-- Menu de navigation -->
            <ul id="nav-menu" class="nav-menu-mobile">
                <li><a href="home">Accueil</a></li>

                <?php if (isset($_SESSION['user_nom'])) { ?>
                    <li><a href="avdj">À vous de jouer</a></li>
                    <li><a href="account" title="Mon Compte"><i class="fas fa-user-circle"></i> <?= htmlspecialchars(
                                                                                                    $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom'],
                                                                                                ) ?></a></li>
                    <li><a href="logout" role="button">Déconnexion</a></li>
                <?php } else { ?>
                    <li><a href="login" role="button">Connexion</a></li>
                <?php } ?>
                <li class="nav-theme-item">
                    <a href="#" id="theme-toggle" class="secondary theme-toggle-btn" aria-label="Changer de thème" title="Changer de thème"></a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="nav-overlay" class="nav-overlay"></div>

    <!-- Bouton Retour en haut de page -->
    <a href="#" id="scroll-top-btn" title="Retour en haut de page" aria-label="Retour en haut de page">
        <i class="fas fa-arrow-up"></i>
    </a>

    <main class="container">