<?php
include '../../includes/header.php';
?>
<link rel="stylesheet" href="css/level-pages.css">

<button type="button" onclick="window.location.href='avdj'">
    ← Retour
</button>

<article>
    <header>

        <h1>Niveau débutant</h1>
    </header>

    <div>
        <img src="assets/img/slider1.jpg" alt="Débuter avec Lancelot">
    </div>

    <!-- JEU A SANS-ATOUT -->
    <details class="level-folder">
        <summary>Jeu à Sans-Atout</summary>
        <div class="lesson-list">
            <a href="https://docs.google.com/presentation/d/1hqoOSCKKrf-6sv0sOgFS-1t5soidBGe0fIg240ivKlk/edit?slide=id.p1#slide=id.p1" class="lesson-item" target="_blank">
                <i class="fas fa-chalkboard-teacher"></i> Cours : Les cartes maîtresses du Déclarant
            </a>
            <a href="bsol/Debuter/JMSA/realiser.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 1 - Réaliser ses levées
            </a>
            <a href="bsol/Debuter/JMSA/honneurs.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 2 - L'affranchissement des honneurs
            </a>
            <a href="bsol/Debuter/JMSA/longueurs.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 3 - Les levées de longueur
            </a>
            <a href="bsol/Debuter/JMSA/communications.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 4 - Les couleurs bloquées
            </a>
            <a href="bsol/Debuter/JMSA/impasses.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 5 - Les premières impasses
            </a>
        </div>
    </details>

    <!-- JEU A L'ATOUT -->
    <details class="level-folder">
        <summary>Jeu à l'Atout</summary>
        <div class="lesson-list">
            <a href="bsol/Debuter/JMA/controle.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 10 - Le pouvoir de contrôle et de coupe
            </a>
            <a href="bsol/Debuter/JMA/atout.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 11 - Jouer à l'atout
            </a>
            <a href="bsol/Debuter/JMA/immediates.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 12 - Réalisation des levées quasi-immédiates
            </a>
            <a href="bsol/Debuter/JMA/coupes.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 13 - Coupe(s) immédiate(s) de la main courte
            </a>
            <a href="bsol/Debuter/JMA/battre.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 14 - Battre atout et coupe(s) de la main courte
            </a>
            <a href="bsol/Debuter/JMA/defausse.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 15 - La défausse des perdantes
            </a>
            <a href="bsol/Debuter/JMA/impasses.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 16 - Les premières impasses
            </a>
        </div>
    </details>

    <!-- DEFENSE A SANS-ATOUT -->
    <details class="level-folder">
        <summary>Défense à Sans-Atout</summary>
        <div class="lesson-list">
            <a href="https://docs.google.com/presentation/d/13HchITDEMj3fB8Su-xTVViYsS1mEK_3G7bENKNv2ASo/edit?slide=id.p1#slide=id.p1" class="lesson-item" target="_blank">
                <i class="fas fa-chalkboard-teacher"></i> Cours : Débuter à la carte
            </a>
            <a href="https://docs.google.com/presentation/d/11FEGEkSTUCQhzGrtBpCFHHTKFzlNhQVm5KUyvREcw6Q/edit?slide=id.p1#slide=id.p1" class="lesson-item" target="_blank">
                <i class="fas fa-chalkboard-teacher"></i> Cours : L'entame à Sans-Atout
            </a>
            <a href="bsol/Debuter/DSA/prendre.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 1 - Prendre ses levées en flanc
            </a>
            <a href="bsol/Debuter/DSA/honneurs.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 2 - Affranchissement de levées d'honneurs
            </a>
            <a href="bsol/Debuter/DSA/longueur.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 3 - Affranchissement de levées de longueur
            </a>
        </div>
    </details>

    <!-- DEFENSE A L'ATOUT -->
    <details class="level-folder">
        <summary>Défense à l'Atout</summary>
        <div class="lesson-list">
            <a href="https://docs.google.com/presentation/d/1sI5fc-yBQyTfOm-hsSXYKWldBLVF4enHhiwo54k7zDE/edit?slide=id.p1#slide=id.p1" class="lesson-item" target="_blank">
                <i class="fas fa-chalkboard-teacher"></i> Cours : L'entame à l'atout
            </a>
            <a href="bsol/Debuter/DA/realiser.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 31 - Réaliser ses levées en urgence
            </a>
            <a href="bsol/Debuter/DA/battre.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 32 - Battre atout (main courte)
            </a>
            <a href="bsol/Debuter/DA/couper.php" class="lesson-item">
                <i class="fas fa-play-circle"></i> 33 - Coupes en défense
            </a>
        </div>
    </details>
</article>

<?php include '../../includes/footer.php'; ?>