<?php
include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="css/level-pages.css">

<button type="button" onclick="window.location.href='bsol/Progresser/progresser.php'">
    ← Retour au niveau progresser
</button>

<article>
    <header>
        <h1>21 - Faire tomber les atouts adverses</h1>
    </header>

    <details class="level-folder">
        <summary>1 - Faire tomber les atouts adverses sans danger</summary>
        <div class="lesson-list">
            <p><strong>1.1 - Battre atout (14 donnes)</strong></p>
            <?php
            $bat_atout = [
              'rXz96uhw',
              '8SFBNUQc',
              'Tk3Pxvh7',
              'GVM8UNgF',
              'viw7fszD',
              '7zsN6Hme',
              'eswDvLNu',
              'vq7LUBub',
              'kGHTBVq2',
              'nbWkMYC4',
              'ANtQdg9P',
              'EKJaeQUC',
              'W7NZ5hcx',
              'GqriRapW',
            ];
            foreach ($bat_atout as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/1_-_Faire_tomber_les_atouts_adverses_sans_danger/1_-_Battre_atout/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>

            <p><strong>1.2 - Faire tomber le dernier atout maître (1 donne)</strong></p>
            <div class="lesson-item">
                <span>Donne 1</span>
                <div class="lesson-actions">
                    <a href="https://bridge-training.com/player/index.php?dds=qFBQ8JRh" target="_blank" role="button" class="outline">Jouer</a>
                    <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/1_-_Faire_tomber_les_atouts_adverses_sans_danger/2_-_Faire_tomber_le_dernier_atout_maitre/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                </div>
            </div>

            <p><strong>1.3 - Impasse à l'atout d'abord (5 donnes)</strong></p>
            <?php
            $impasse_atout = [
              'Jdhxv7WV',
              'YUpwBXz7',
              'JHe5hWBT',
              'HY4viKuL',
              '3y5zFNHb',
            ];
            foreach ($impasse_atout as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/1_-_Faire_tomber_les_atouts_adverses_sans_danger/3_-_Impasse_a_l'atout_d'abord/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>2 - Retrait partiel des atouts</summary>
        <div class="lesson-list">
            <p><strong>2.1 - 2 tours d'atout et coupe(s) main courte (30 donnes)</strong></p>
            <?php
            $tours2 = [
              'bqKNEugt',
              'WXrCHynt',
              '6fLjcxUq',
              'QXAdNMWJ',
              'J42dZKTt',
              'QtWAGfTj',
              'tbsdfMuB',
              'isLNGduz',
              'GxAcpv5u',
              'QHuMBp9t',
              '4KzgPENV',
              'V8kGDrs6',
              'fNPFAHev',
              'GK5RZVcU',
              'rehAgVin',
              'JE2evduq',
              'HQpYG7c9',
              'acBujnx9',
              'CHgEAUDW',
              'CbsXMfhG',
              'UpSXTVtc',
              'rSxadQJD',
              'BYtzpTGZ',
              'ftyexKNb',
              'pXreCs6g',
              'SE4GHCJv',
              'yHQWArsP',
              '6JZ75SNF',
              'sh39dvJx',
              '72CxBTJq',
            ];
            foreach ($tours2 as $index => $dds):
              $file_name =
                $index == 25
                  ? 'Donne_26².lin'
                  : 'Donne_' . ($index + 1) . '.lin'; ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/1_-_2_tours_d'atout_seulement_et_coupe(s)_de_la_main_courte/<?php echo $file_name; ?>" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php
            endforeach;
            ?>

            <p><strong>2.2 - Utiliser les honneurs d'atout du Mort (2 donnes)</strong></p>
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=xkfDGFe2" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/2_-_Utiliser_les_honneurs_d'atout_du_Mort/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=H27gBXaf" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/2_-_Utiliser_les_honneurs_d'atout_du_Mort/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>

            <p><strong>2.3 - Un tour d'atout seulement (7 donnes)</strong></p>
            <?php
            $tour1 = [
              'znads6Qu',
              'RsnwJUxL',
              'GQn8qWZ7',
              'E4sD2T65',
              'ZV4rmfYu',
              'GNhRZWJk',
              'iGTh9rDN',
            ];
            foreach ($tour1 as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/3_-_Un_tour_d'atout_seulement/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>

            <p><strong>2.4 - Les tours de débarras (17 donnes)</strong></p>
            <?php
            $debarras = [
              '7y9Jtc5e',
              'vNYw3nBm',
              'dBvKp7mj',
              'cfrmWxD7',
              'En4YgfTH',
              'p5XV6Cc4',
              'RFD3SNfK',
              'RzFWJ6nc',
              'dgWxb6Yq',
              'BYtzpTGZ',
              'unHE9TzC',
              'B75pcwTQ',
              'JbQdXEqf',
              'cnYdzaRC',
              'kxjqhgn9',
              'cfrmWxD7',
              'MeHybh3A',
            ];
            foreach ($debarras as $index => $dds):

              $actual_num = $index < 15 ? $index + 1 : $index + 2; // Source skips 16
              $folder =
                $actual_num == 3
                  ? '4_-_Les_tours_de_debarras777'
                  : '4_-_Les_tours_de_debarras';
              ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $actual_num; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/<?php echo $folder; ?>/Donne_<?php echo $actual_num; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php
            endforeach;
            ?>

            <p><strong>2.5 - Le dernier atout coupe dans le vide (2 donnes)</strong></p>
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=ysZjQdC4" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/5_-_Manoeuvrer_pour_que_le_dernier_atout_coupe_dans_le_vide/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=fEiPJCZL" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/5_-_Manoeuvrer_pour_que_le_dernier_atout_coupe_dans_le_vide/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>

            <p><strong>2.6 - 2 tours d'atout et coupe d'un atout maître (11 donnes)</strong></p>
            <?php
            $tours2_maitre = [
              'vEdJfKeY',
              'JSxiM5WZ',
              'xHgX6r7u',
              'zYsR2WJj',
              'KCh4pRF8',
              'dQtPAWJf',
              'BAHneKkf',
              'VMdBwp7L',
              'zmBp7JtR',
              'JcKb98FL',
              'kSsAvH2z',
            ];
            foreach ($tours2_maitre as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/2_-_Retrait_partiel_des_atouts/6_-_2_tours_d'atout_et_coupe_d'un_atout_maitre_au_Mort/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>3 - Coup à blanc à l'atout</summary>
        <div class="lesson-list">
            <p><strong>3.1 - Avec ARxxx en face de xxx (2 donnes)</strong></p>
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=RcmwHr4A" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/1_-_Avec_ARxxx_en_face_de_xxx/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=HSAZNv8t" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/1_-_Avec_ARxxx_en_face_de_xxx/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>

            <p><strong>3.2 - Avec ARxxxx en face de xx (2 donnes)</strong></p>
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=6WcnrhLu" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/2_-_Avec_ARxxxx_en_face_de_xx/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=UuqtEgLv" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/2_-_Avec_ARxxxx_en_face_de_xx/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>

            <p><strong>3.3 - Avec Axxx en face de Rxxx (1 donne)</strong></p>
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=qfeXx4D5" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/3_-_Avec_Axxx_en_face_de_Rxxx/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>

            <p><strong>3.4 - Avec Axxx en face de xxxx (6 donnes)</strong></p>
            <?php
            $axxx = [
              'kGHTBVq2',
              '8eYmLSxs',
              'c8dkAB7H',
              'eH8TmMwz',
              'Buh4qN8x',
              'V8bYJrjG',
            ];
            foreach ($axxx as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/4_-_Avec_Axxx_en_face_de_xxxx/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>

            <p><strong>3.5 - Avec Axxxxx en face de xxx (5 donnes)</strong></p>
            <?php
            $axxxxx = [
              'mnzkGsbw',
              'VACJNFc9',
              'P9MLK7fr',
              'qXPc5NeV',
              'pvywbDLd',
            ];
            foreach ($axxxxx as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/5_-_Avec_Axxxxx_en_face_de_xxx/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>

            <p><strong>3.6 - Malgré la tierce majeure (5 donnes)</strong></p>
            <?php
            $tierce = [
              'CjcTp8mX',
              'egT4vqBG',
              'pMm8y4Pg',
              'AxqFdUC7',
              'Qvpsa5Uq',
            ];
            foreach ($tierce as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/6_-_Malgre_la_tierce_majeure_a_l'atout/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>

            <p><strong>3.7 - Autres (5 donnes)</strong></p>
            <?php
            $autres = [
              'bm98N7Ct',
              'cDsEjWu4',
              'WFTter4k',
              'nNpjZJrX',
              'isFPJQW9',
            ];
            foreach ($autres as $index => $dds): ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/21_-_Faire_tomber_les_atouts_adverses/3_-_Coup_a_blanc_a_l'atout/7_-_Autres/Donne_<?php echo $index +
                          1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>
    </details>
</article>

<?php include '../../../includes/footer.php'; ?>
