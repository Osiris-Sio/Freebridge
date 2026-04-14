<?php
include 'includes/header.php'; ?>
<main class="mdl-layout__content">
    <div class="page-content">
        <section style="margin: 5% 5%; width: 90%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; background-color:white">
            <div style="margin-top:2%;margin-bottom: 2%;font-size: 25px; text-align: center; order: 0" class="colorgreen">
                <h2 style="font-family: 'Gotham Bold'">A VOUS DE JOUER !</h2>
            </div>

			<!--
            <div class="level" style="display: flex; flex-direction: row; order: 1">
                <div class="lvl1" style="order:1;margin-right: auto;">
                    <img onclick="document.location.href='rubrique.php?lvl=1'" style="width: 100%" src="assets/img/debuter.jpg">
				</div>
                <div class="lvl1" style="order:2;margin-right: auto;">
                    <img onclick="document.location.href='rubrique.php?lvl=2'" style="width: 100%" src="assets/img/progresser.jpg">
                </div>
                <div class="lvl1" style="order:3;margin-right: auto;">
                    <img onclick="document.location.href='rubrique.php?lvl=3'" style="width: 100%" src="assets/img/peaufiner.jpg">
                </div>
                <div class="lvl1" style="order:4">
                    <img onclick="document.location.href='rubrique.php?lvl=4'" style="width: 100%" src="assets/img/confirmer.jpg">
                </div>
            </div>
			<div class="page-content colorgreen" style="color: black; text-align: center">
			-->



			 <div class="level" style="display: flex; flex-direction: row; order: 1">
         <?php if ($_SESSION['user_rang'] == 'debutant') { ?>
           <a href="bsol/Debuter/debutant.php"><img style="width:90%" src="assets/img/slider1.jpg"></a>
         <?php } elseif ($_SESSION['user_rang'] == 'progresser') { ?>
           <a href="bsol/Debuter/debutant.php"><img style="width:90%" src="assets/img/slider1.jpg"></a>
           <a href="bsol/Progresser/progresser.php"><img style="width:90%" src="assets/img/slider2.jpg"></a>
         <?php } elseif ($_SESSION['user_rang'] == 'peaufiner') { ?>
           <a href="bsol/Debuter/debutant.php"><img style="width:90%" src="assets/img/slider1.jpg"></a>
           <a href="bsol/Confirmer/confirmerProgresser/progresser.php"><img style="width:90%" src="assets/img/slider2.jpg"></a>
           <a href="bsol/Confirmer/confirmerPeaufiner/peaufiner.php"><img style="width:90%" src="assets/img/slider3.jpg"></a>
         <?php } elseif ($_SESSION['user_rang'] == 'confirmer') { ?>
           <a href="bsol/Debuter/debutant.php"><img style="width:90%" src="assets/img/slider1.jpg"></a>
           <a href="bsol/Progresser/progresser.php"><img style="width:90%" src="assets/img/slider2.jpg"></a>
           <a href="bsol/Peaufiner/peaufiner.php"><img style="width:90%" src="assets/img/slider3.jpg"></a>
           <a href="bsol/Confirmer/confirmer.php"><img style="width:90%" src="assets/img/slider4.jpg"></a>
         <?php } ?>



			<!--
			<p
            <button style="margin-top: 2%; margin-bottom: 2%;background-color: #003D00;" type="button" onclick="document.location.href='index.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                    Retour
            </button>
			/p>
			-->

            </div>
        </section>
    </div>
</main>
