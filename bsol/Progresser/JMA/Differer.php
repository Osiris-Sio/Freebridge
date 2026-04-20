<?php
include '../../../includes/header.php';
?>
<link rel="stylesheet" href="css/level-pages.css">

<button type="button" onclick="window.location.href='bsol/Progresser/progresser.php'">
    ← Retour au niveau progresser
</button>

<article>
    <header>
        <h1>22 - Différer le retrait des atouts</h1>
    </header>

    <details class="level-folder">
        <summary>1 - Différer le retrait des atouts pour couper (10 donnes)</summary>
        <div class="lesson-list">
            <?php
            $diff_couper = [
                ["dds" => "x7AhGSej", "file" => "Donne_1.lin"],
                ["dds" => "KrznpR7h", "file" => "Donne_3.lin"],
                ["dds" => "PJNMYGSR", "file" => "Donne_3.lin"],
                ["dds" => "K3DvFa4C", "file" => "Donne_4.lin"],
                ["dds" => "Bi3uLq5N", "file" => "Donne_5.lin"],
                ["dds" => "ZLSisM5g", "file" => "Donne_6.lin"],
                ["dds" => "D3pmuUfR", "file" => "Donne_7.lin"],
                ["dds" => "xizRsa6f", "file" => "Donne_8.lin"],
                ["dds" => "85kvMwjz", "file" => "Donne_9.lin"],
                ["dds" => "DQcydbkf", "file" => "Donne_10.lin"]
            ];
            foreach ($diff_couper as $index => $data):
            ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $data['dds']; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/1_-_Differer_le_retrait_des_atouts_pour_couper/<?php echo $data['file']; ?>" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>2 - Ne donner qu'un tour d'atout seulement (8 donnes)</summary>
        <div class="lesson-list">
            <?php
            $tour1 = ["znads6Qu", "RsnwJUxL", "FgBG6iPn", "LY5CgsFV", "WtqnUrNR", "GNhRZWJk", "GQn8qWZ7", "iGTh9rDN"];
            foreach ($tour1 as $index => $dds):
            ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/2_-_Ne_donner_qu'un_tour_d'atout_seulement/Donne_<?php echo $index + 1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>3 - Différer suite à mauvaise répartition (3 donnes)</summary>
        <div class="lesson-list">
            <?php
            $mauvaise_rep = ["3M8swUSj", "ejzwLqP9", "RnrvzTqX"];
            foreach ($mauvaise_rep as $index => $dds):
            ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/3_-_Differer_le_retrait_des_atouts_avec_une_mauvaise_repartition/Donne_<?php echo $index + 1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>4 - Pour ouvrir la coupe au Mort</summary>
        <div class="lesson-list">
            <p><strong>4.1 - Coup à blanc avant 2 tours de débarras (4 donnes)</strong></p>
            <?php
            $blanc_debarras = ["rh2McZTz", "YKsR3Xxf", "u4ZeAXaq", "dgWxb6Yq"];
            foreach ($blanc_debarras as $index => $dds):
            ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/4_-_Differer_le_retrait_des_atouts_pour_ouvrir_la_coupe_au_mort/1_-_Coup_a_blanc_dans_une_couleur_avant_2_tours_de_debarras/Donne_<?php echo $index + 1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach; ?>

            <p><strong>4.2 - Autres techniques (11 donnes)</strong></p>
            <?php
            $autres_tech = ["f9NDdtxg", "P9YjJG5T", "PJNMYGSR", "x7AhGSej", "EHmJbdir", "K3DvFa4C", "crfsZUTE", "ZLSisM5g", "xizRsa6f", "D3pmuUfR", "85kvMwjz"];
            foreach ($autres_tech as $index => $dds):
            ?>
                <div class="lesson-item">
                    <span>Donne <?php echo $index + 1; ?></span>
                    <div class="lesson-actions">
                        <a href="https://bridge-training.com/player/index.php?dds=<?php echo $dds; ?>" target="_blank" role="button" class="outline">Jouer</a>
                        <a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/4_-_Differer_le_retrait_des_atouts_pour_ouvrir_la_coupe_au_mort/2_-_Autres_techniques/Donne_<?php echo $index + 1; ?>.lin" target="_blank" role="button" class="secondary outline">Solution</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </details>

    <details class="level-folder">
        <summary>5 - 3 coupes de la main courte et communications (2 donnes)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=6WUjfvcE" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/5_-_3_coupes_de_la_main_courte_et_communications/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=bz9AYVQ4" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/5_-_3_coupes_de_la_main_courte_et_communications/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>

    <details class="level-folder">
        <summary>6 - Ne pas chercher à faire une ou des impasses (2 donnes)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=7EMxfvrT" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/6_-_Ne_pas_chercher_a_faire_une_ou_des_impasses/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=bCDkPGMX" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/6_-_Ne_pas_chercher_a_faire_une_ou_des_impasses/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>

    <details class="level-folder">
        <summary>7 - Utiliser remontées du Mort avant honneurs atout (2 donnes)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=xkfDGFe2" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/7_-_Utiliser_les_honneurs_d'atout_du_Mort/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=H27gBXaf" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le_retrait_des_atouts/7_-_Utiliser_les_honneurs_d'atout_du_Mort/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>

    <details class="level-folder">
        <summary>8 - Pour compenser un mauvais placement (2 donnes)</summary>
        <div class="lesson-list">
            <div class="lesson-item"><span>Donne 1</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=DQcydbkf" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le-retrait_des_atouts_pour_couper_et_compenser_un_mauvais_placement/Donne_1.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
            <div class="lesson-item"><span>Donne 2</span>
                <div class="lesson-actions"><a href="https://bridge-training.com/player/index.php?dds=KrznpR7h" target="_blank" role="button" class="outline">Jouer</a><a href="https://freebridge.fr/ddummy.htm?file=https://freebridge.fr/bsol/Progresser/JMA/22_-_Differer_le-retrait_des_atouts_pour_couper_et_compenser_un_mauvais_placement/Donne_2.lin" target="_blank" role="button" class="secondary outline">Solution</a></div>
            </div>
        </div>
    </details>
</article>

<?php include '../../../includes/footer.php'; ?>