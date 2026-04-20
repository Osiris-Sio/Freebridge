<?php
include '../../../includes/header.php';
?>
<link rel="stylesheet" href="css/level-pages.css">

<button type="button" onclick="window.location.href='bsol/Progresser/progresser.php'">
    ← Retour au niveau progresser
</button>

<article>
    <header>
        <h1>24 - Affranchissement d'une couleur du Mort</h1>
    </header>

    <details class="level-folder">
        <summary>1 - Affranchissement d'honneurs (59 donnes)</summary>
        <div class="lesson-list">
            <?php
            $honneurs = [
                "F7TPuMSc",
                "Vvck3hXE",
                "hnwMsyVK",
                "GsETvXUp",
                "7CW8bt9E",
                "HrN4CJzD",
                "zYPdVyZm",
                "3BWbK8ie",
                "JhBbFwpS",
                "nqPAZFiy",
                "xY7bJQFA",
                "Js3ykUde",
                "D5QYVdjv",
                "jBfb5Dkc",
                "82ZmgrEx",
                "KvkWDCUE",
                "J539tvbx",
                "uN2RJgfF",
                "wn8zUJvi",
                "Pdjxyahm",
                "CGBZJLki",
                "QBcSKDrj",
                "jQdrunBT",
                "MuwPqAtg",
                "KuhXgPWF",
                "9QRi53kY",
                "9QRi53kY",
                "PsLuMf8m",
                "Adag2JbE",
                "CJgBnkQM",
                "4F7w2uNe",
                "rHzMUgPs",
                "cFqTeHjJ",
                "YmAf5ecz",
                "nzMRBQPm",
                "bdTF2JeV",
                "6NYfcpJK",
                "CKzetavc",
                "37EBAw5x",
                "rDd9cVKM",
                "cmBYkULv",
                "xV75szXi",
                "4xjgAQsS",
                "EtzjL965",
                "56WdpYNX",
                "kWVNzvXh",
                "cpzS7Lve",
                "cXS3kKGZ",
                "behLNrix",
                "4GMHP7UZ",
                "J539tvbx",
                "GcMDPhZY",
                "cgqNPEBp",
                "wercYKQE",
                "BmvxwEZP",
                "n3G9weAU",
                "MaKGjm6Q",
                "2BLkDSNY",
                "Y9Z6F4St"
            ];
            foreach ($honneurs as $index => $dds):
                $file_num = $index + 1;
                if ($file_num == 56) $file_num = 55; // mapping source
                if ($file_num == 57) $file_num = 56; // mapping source
            ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/24_-_Affranchissement_d'une_couleur_du_Mort/1_-_Affranchissement_d'honneurs/Donne_<?php echo $file_num; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>2 - Par la coupe d'une longue du mort (50 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 50; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/24_-_Affranchissement_d'une_couleur_du_Mort/2_-_Affranchissement_d'une_longue_du_mort_par_la_coupe/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>3 - Par la coupe d'un honneur (10 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/24_-_Affranchissement_d'une_couleur_du_Mort/3_-_Affranchissement_d'un_honneur_par_la_coupe/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>4 - Par un coup à blanc (22 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 22; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/24_-_Affranchissement_d'une_couleur_du_Mort/4_-_Affranchissement_par_un_coup_a_blanc/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>5 - Par l'impasse ou l'expasse (18 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 18; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/24_-_Affranchissement_d'une_couleur_du_Mort/5_-_Affranchissement_par_l'impasse_ou_l'expasse/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>
</article>

<?php include '../../../includes/footer.php'; ?>