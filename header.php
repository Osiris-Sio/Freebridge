<!doctype html>
<html lang="fr">
<head>
    <title>Freebridge</title>
    <link href="font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
              "palette": {
                "popup": {
                  "background": "#006400"
                },
                "button": {
                  "background": "#8b0000"
                }
              },
              "theme": "classic",
              "position": "bottom-left",
              "type": "opt-in",
              "content": {
                "message": "Ce cite utilise des cookies pour garantir la meilleure exp&eacute;rience sur notre site",
                "dismiss": "Refuser",
                "allow": "Accepter",
                "link": "En savoir plus",
                "href": "www.freebridge.com/confidentialite.php"
              }
        })});
    </script>
    <meta charset="UTF-8">
    <style>
        .cc-btn {
            background-color: #8B0000;
        }
        .mdl-layout__container {
            position: relative !important;
        }
        .material-icons {
            border: 1px solid black;
            color: black;
            background-color: white;
        }
    </style>
</head>
<body>
<?php
include 'pdo.php';
session_start();
?>

<div style="height: 27px; background-color: darkgreen; color: white; font-size: 25px; text-align: center">
    <a style="color: white; font-family: 'Gotham '" href="tel:+33637640638"><i class="fas fa-phone-volume" style="margin-right: 5%;"> 06 37 64 06 38</i></a><a style="color: white;font-family: 'Gotham'" href="mailto:bernard.glorie.62@orange.fr">bernard.glorie62@orange.fr</a>
</div>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header"  style="background-color: transparent !important;">
    <header class="mdl-layout__header"  style="background-color: transparent !important; border: none">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <!--
			<span class="mdl-layout-title" id="logospan" style="width: 24%"><img onclick="document.location.href='index.php'" id="logo" src="Images/logo.jpg"></span>
            -->
			
			<nav class="mdl-navigation mdl-layout--large-screen-only">
                
				<a class="mdl-navigation__link colorgreen" href="quisommesnous.php">Qui sommes nous ?</a>
				<a class="mdl-navigation__link colorgreen" href="cours.php">Test</a>
				                
                <!--
                On verifier si la variable de session rang existe :
                si elle n'existe pas on affiche connexion et inscription (pas connecté)
                sinon on affiche deconnexion (connecté)
                -->
                <?php if(!isset($_SESSION['user_nom'])) {?>
					<a class="mdl-navigation__link colorgreen" href="login.php"><button style="background-color: transparent; border: 1px solid darkgreen; font-size: 25px; border-radius:10px " class="colorgreen">Connexion</button> </a>
                    <!-- <a class="mdl-navigation__link colorgreen" href="register.php">Créer un compte</a> -->
                <?php } else {?>
				    <a class="mdl-navigation__link colorgreen" href="avdj.php">A vous de jouer</a> 
					<a class="mdl-navigation__link colorgreen" href="deconnexion.php"><button style="background-color: transparent; border: 1px solid darkgreen; font-size: 20px; border-radius:10px " class="colorgreen">Déconnexion</button> </a>
                    <a class="mdl-navigation__link colorgreen" href="compte.php">Mon compte</a>
                <?php } ?>
				</nav>
        </div>
	
<!--
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Freebridge</span>
        <nav class="mdl-navigation" style="color: darkgreen !important;">
            
			<a class="mdl-navigation__link" href="quisommesnous.php">Qui sommes nous ?</a>
            <a class="mdl-navigation__link" href="cours.php">Test</a>
				
           
            On verifier si la variable de session rang existe :
            si elle n'existe pas on affiche connexion et inscription (pas connecté)
            sinon on affiche deconnexion (connecté)
            <?php if(!isset($_SESSION['user_nom'])) {?>
                <a class="mdl-navigation__link" href="login.php">Connexion</a>
                <a class="mdl-navigation__link" href="register.php">Créer un compte</a>
            <?php } else {?>
				<a class="mdl-navigation__link" href="avdj.php">A vous de jouer</a>
				<a class="mdl-navigation__link" href="deconnexion.php">Déconnexion</a>
                <a class="mdl-navigation__link" href="compte.php">Mon compte</a>
            <?php } ?>
        </nav>
-->


		
    </div>

</main>
