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

<hr>

<article style="text-align: center;">

    <?php include __DIR__ . '/../Bridge_Viewer_Web/logo-bvw.svg'; ?>
    <p>Jouez et visionnez vos donnes (PBN / LIN)</p>
    <button type="button" id="btn-change-mode" onclick="window.location.href='bvw'">
        Aller sur <strong>Bridge Viewer Web</strong>
    </button>

</article>

<?php include 'includes/footer.php'; ?>