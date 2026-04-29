<?php
include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="css/level-pages.css">

<button type="button" class="secondary" onclick="window.location.href='bsol/Progresser/progresser.php'">
    ← Retour au niveau progresser
</button>

<article>
    <header>
        <h1>16 - Choix de la couleur à affranchir (39 donnes)</h1>
    </header>

    <details class="level-folder">
        <summary>Donnes 1 à 39</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 39; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player?dds=DEyF3PGb" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="bsol/ddummy.php?file=bsol/Progresser/JMSA/16_-_Choix_de_la_couleur_a_affranchir/Donne_<?php echo $i; ?>.lin" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>
</article>

<?php include '../../../includes/footer.php'; ?>
