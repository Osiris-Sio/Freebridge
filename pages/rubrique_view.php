<?php include 'includes/header.php';
$niveau = $_GET['lvl'] ?? 1;
?>

<article style="text-align: center;">
    <h1>Accès au niveau</h1>

    <div style="display: flex; justify-content: center; margin: 2rem 0;">
        <?php if ($niveau == 1): ?>
            <a href="debutant.php">
                <img src="assets/img/debuter.jpg" alt="Débuter" style="width:200px; border-radius: 8px; box-shadow: var(--pico-card-box-shadow);">
                <br><br><strong>Commencer le niveau Débutant</strong>
            </a>
        <?php elseif ($niveau == 2): ?>
            <a href="progresser.php">
                <img src="assets/img/progresser.jpg" alt="Progresser" style="width:200px; border-radius: 8px; box-shadow: var(--pico-card-box-shadow);">
                <br><br><strong>Commencer le niveau Progresser</strong>
            </a>
        <?php elseif ($niveau == 3): ?>
            <a href="peaufiner.php">
                <img src="assets/img/peaufiner.jpg" alt="Peaufiner" style="width:200px; border-radius: 8px; box-shadow: var(--pico-card-box-shadow);">
                <br><br><strong>Commencer le niveau Peaufiner</strong>
            </a>
        <?php elseif ($niveau == 4): ?>
            <a href="confirmer.php">
                <img src="assets/img/confirmer.jpg" alt="Confirmer" style="width:200px; border-radius: 8px; box-shadow: var(--pico-card-box-shadow);">
                <br><br><strong>Commencer le niveau Confirmer</strong>
            </a>
        <?php endif; ?>
    </div>

    <button type="button" class="secondary" class="secondary outline" onclick="history.back()">
        Retour
    </button>
</article>

<?php include 'includes/footer.php'; ?>
