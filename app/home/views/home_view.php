<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="css/home.css">


<article>

    <header>
        <h1>Qui sommes-nous ?</h1>
    </header>

    <div>
        <p>
            Initiateur scolaire, Moniteur, Maître-assistant agréé par la FFB, nous nous sommes investis dans l'enseignement du bridge depuis une dizaine d'années et nous avons développé une méthode originale de saisie et de lecture des donnes.
        </p>
        <p>
            Nous avons depuis numérisé un grand nombre de donnes, qui offrent un intérêt pédagogique que nous sommes heureux de vous faire partager.
        </p>
        <p>
            Vous pourrez jouer 4 donnes de niveau débutant par semaine, mais l'accès aux solutions (sous forme de vidéos) nécessite de créer un compte et de se connecter.
        </p>
        <p>
            Cet accès gratuit au niveau débutant vous permettra en outre de progresser avec des diaporamas sur le jeu de la carte.
        </p>
        <p>
            L'accès aux niveaux supérieurs sera mis en place dans le courant de l'année et nécessite un abonnement mensuel ou annuel d'un montant réduit pour un accès à des diaporamas plus techniques et à un nombre de donnes plus important.
        </p>
        <p>Pour nous contacter par mail : <a href="mailto:bernard.glorie.62@orange.fr">bernard.glorie.62@orange.fr</a></p>
    </div>


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
