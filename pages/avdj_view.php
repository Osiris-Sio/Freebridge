<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>À vous de jouer !</h1>
    </header>

    <div class="grid grid-avdj">
        <?php if ($_SESSION['user_rang'] == 'debutant'): ?>
            <article>
                <a href="bsol/Debuter/debutant.php">
                    <img src="assets/img/slider1.jpg" alt="Débutant">
                    <footer>Niveau Débutant</footer>
                </a>
            </article>
        <?php elseif ($_SESSION['user_rang'] == 'progresser'): ?>
            <article>
                <a href="bsol/Debuter/debutant.php">
                    <img src="assets/img/slider1.jpg" alt="Débutant">
                    <footer>Niveau Débutant</footer>
                </a>
            </article>
            <article>
                <a href="bsol/Progresser/progresser.php">
                    <img src="assets/img/slider2.jpg" alt="Progresser">
                    <footer>Niveau Progresser</footer>
                </a>
            </article>
        <?php elseif ($_SESSION['user_rang'] == 'peaufiner'): ?>
            <article>
                <a href="bsol/Debuter/debutant.php">
                    <img src="assets/img/slider1.jpg" alt="Débutant">
                    <footer>Niveau Débutant</footer>
                </a>
            </article>
            <article>
                <a href="bsol/Progresser/progresser.php">
                    <img src="assets/img/slider2.jpg" alt="Progresser">
                    <footer>Niveau Progresser</footer>
                </a>
            </article>
            <article>
                <a href="bsol/Peaufiner/peaufiner.php">
                    <img src="assets/img/slider3.jpg" alt="Peaufiner">
                    <footer>Niveau Peaufiner</footer>
                </a>
            </article>
        <?php elseif ($_SESSION['user_rang'] == 'confirmer'): ?>
            <article>
                <a href="bsol/Debuter/debutant.php">
                    <img src="assets/img/slider1.jpg" alt="Débutant">
                    <footer>Niveau Débutant</footer>
                </a>
            </article>
            <article>
                <a href="bsol/Progresser/progresser.php">
                    <img src="assets/img/slider2.jpg" alt="Progresser">
                    <footer>Niveau Progresser</footer>
                </a>
            </article>
            <article>
                <a href="bsol/Peaufiner/peaufiner.php">
                    <img src="assets/img/slider3.jpg" alt="Peaufiner">
                    <footer>Niveau Peaufiner</footer>
                </a>
            </article>
            <article>
                <a href="bsol/Confirmer/confirmer.php">
                    <img src="assets/img/slider4.jpg" alt="Confirmer">
                    <footer>Niveau Confirmer</footer>
                </a>
            </article>
        <?php endif; ?>
    </div>
</article>

<article>
    <header>
        <h1>Test BSOL</h1>
    </header>

    <a href="bsol/ddummy.php">Direction BSOL</a>
    <br>
    <a href="http://localhost/freebridge-github/bsol/ddummy.php?file=bsol/Progresser/JMSA/10_-_le_laisser-passer/0_-_avec_un_seul_arret/Donne_2.lin">Test lecture fichier par URL</a>
</article>

<article>
    <header>
        <h1>Test Bridge Viewer Web (BVW)</h1>
    </header>

    <a href="bvw">Direction BVW</a>
    <br>
    <a href="bvw?file=bsol/Progresser/JMSA/10_-_le_laisser-passer/0_-_avec_un_seul_arret/Donne_2.lin">Test lecture fichier par URL</a>
</article>

<?php include 'includes/footer.php'; ?>
