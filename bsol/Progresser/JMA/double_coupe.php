<?php
include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="css/level-pages.css">

<button type="button" onclick="window.location.href='bsol/Progresser/progresser.php'">
    ← Retour au niveau progresser
</button>

<article>
    <header>
        <h1>23 - La Double-Coupe</h1>
    </header>

    <details class="level-folder">
        <summary>1 - Le mécanisme (34 donnes)</summary>
        <div class="lesson-list">
            <?php
            $mecanisme = [
              'GQk9jSxw',
              'f7E96d5R',
              'eSRqV89p',
              'guSZVGa5',
              'VgXqk2WH',
              'ZGsEUmCL',
              'MTWRXysL',
              'fkYJ2rVD',
              'td38uhG4',
              '2BNQDP7J',
              'rSLcKFbn',
              'VpS8s2FP',
              'D6fgSHux',
              'B5ApCqTP',
              'rJb4MK37',
              'DyRBhptC',
              'kLnfw9ts',
              'jrM4gNAn',
              '5SGTrfB9',
              'rQFPy9Mm',
              'P824T65w',
              'MsBT8rF9',
              'XeRpqiFW',
              'QnutAL9r',
              'WC7zuLJR',
              '4JpaNZXH',
              'e3btEFXK',
              'bZfrAGnK',
              'ShKjYfW7',
              'L3TSiGpa',
              'DxXBTgHb',
              'nPAdrV83',
              'fNgXmCHn',
              'K9y6mUnj',
            ];
            foreach ($mecanisme as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/1_-_Le_mecanisme/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>2 - Commencer par la couleur la plus longue (17 donnes)</summary>
        <div class="lesson-list">
            <?php
            $longue = [
              'mrwMSLGT',
              '3kDXjWAma',
              'dWCxyrXU',
              '2Vdaywfr',
              'pSd7j6zq',
              'qjsCVtFi',
              'Ct4rNpUG',
              'nQ5mLWxj',
              'ESgirqPj',
              'ics3h2Rt',
              'QsdXqHe2',
              'PaveAw2p',
              'LD3BP79z',
              'LD3BP79z',
              'zdUWSgc9',
              'F5AZg4Tx',
              'F5AZg4Tx', // Source stops numbering at 16 but title says 17
            ];
            foreach ($longue as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/2_-_Commencer_par_la_couleur_la_plus_longue/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>3 - Encaisser les levées maîtresses d'abord (7 donnes)</summary>
        <div class="lesson-list">
            <?php
            $maitresses = [
              'DnC4bmHB',
              'cXVhybBm',
              'AwtQZhcb',
              'ZhaeK5gY',
              'EaZ3nkGv',
              'MibL4FAz',
              '9xSGuD2r',
            ];
            foreach ($maitresses as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/3_-_Encaisser_les_levees_maitresses_d'abord/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>4 - Assurer en coupant maître (6 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/4_-_Assurer_la_double_coupe_en_coupant_maitre/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>5 - Impasse ou affranchissement préalable (8 donnes)</summary>
        <div class="lesson-list">
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $i; ?></span>
                    <div class="lesson-actions">
                        <a href="" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/5_-_Impasse_ou_affranchissement_prealable/Donne_<?php echo $i; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>6 - Préférer la coupe coté court (1 donne)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/6_-_Preferer_la_coupe_cote_court/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>

    <details class="level-folder">
        <summary>7 - Abandon de la double coupe (1 donne)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/7_-_Abandon_de_la_double_coupe/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>

    <details class="level-folder">
        <summary>8 - Défausse et double coupe (2 donnes)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/8_-_Defausse_et_double_coupe/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/23_-_La_double_coupe/8_-_Defausse_et_double_coupe/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>
</article>

<?php include '../../../includes/footer.php'; ?>
