<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="css/home.css">


<article>

    <header>
        <h1>Bienvenue sur Freebridge !</h1>
    </header>

    <div>
        <p>
            Initiateur scolaire, Moniteur, Maître-assistant agréé par la FFB, nous nous sommes investis dans l'enseignement du bridge depuis une dizaine d'années et nous avons développé une méthode originale de saisie et de lecture des donnes.
        </p>
        <p>
            Nous avons depuis numérisé un grand nombre de donnes, qui offrent un intérêt pédagogique que nous sommes heureux de vous faire partager.
        </p>
        <p>
            Vous pourrez obtenir un accès gratuit aux donnes et aux cours au niveau Débuter. Pour cela, il suffit de <a href="register">créer un compte</a> et de <a href="login">se connecter</a>.
        </p>
        <p>
            Cet accès gratuit au niveau Débuter et au niveau Progresser* vous permettra en outre de progresser avec des diaporamas sur le bridge.
        </p>
        <p>
            L'accès aux niveaux supérieurs sera mis en place dans le courant de l'année et nécessite un abonnement mensuel ou annuel d'un montant réduit pour un accès à des diaporamas plus techniques et à un nombre de donnes plus important pour les niveaux Peaufiner et Confirmer.
        </p>
        <p>Pour nous contacter, vous pouvez utiliser <a href="contact">ce formulaire de contact</a></p>
        <small><i>* Le niveau Progresser vous est attribué gratuitement après avoir terminé les cours du niveau débutant et avoir contacté le responsable du site pour en valider votre niveau, sous contrôle de la licence FFB.</i></small>
    </div>

    <br>

    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="assets/img/slider1.jpg">
        </div>
        <div class="mySlides fade">
            <img src="assets/img/slider2.jpg">
        </div>
        <div class="mySlides fade">
            <img src="assets/img/slider3.jpg">
        </div>
        <div class="mySlides fade">
            <img src="assets/img/slider4.jpg">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

</article>

<hr>

<article>
    <h2>Exemple de vidéo de solution</h2>
    <video controls src="assets/videos/Video1.mp4"></video>
</article>

<script src="js/home.js"></script>


<?php include 'includes/footer.php'; ?>