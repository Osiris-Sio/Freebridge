<?php
include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="css/level-pages.css">

<button type="button" onclick="window.location.href='bsol/Progresser/progresser.php'">
    ← Retour au niveau progresser
</button>

<article>
    <header>
        <h1>27 - Choix de la main de base</h1>
    </header>

    <details class="level-folder">
        <summary>1 - Avec un fit 4-4 (38 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 38; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/27_-_Choix_de_la_main_de_base/1_-_Avec_un_fit_4-4/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>2 - Le Mort comme main de base (20 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/27_-_Choix_de_la_main_de_base/2_-_Le_Mort_comme_main_de_base/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>3 - Notion de Mort inversé (2 donnes)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/27_-_Choix_de_la_main_de_base/3_-_Mort_inverse/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/27_-_Choix_de_la_main_de_base/3_-_Mort_inverse/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>
</article>

<?php include '../../../includes/footer.php'; ?>
