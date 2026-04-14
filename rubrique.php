<?php
include 'includes/header.php';
$niveau = $_GET['lvl'];
?>


<?php if ($niveau == 1): ?>
  <a href="debutant.php"><img src="assets/img/debuter.jpg" alt="Débuter" style="width:200px;height:300px;"></a>
<?php endif; ?>

<?php if ($niveau == 2): ?>
  <a href="progresser.php"><img src="assets/img/progresser.jpg" alt="Progresser" style="width:200px;height:300px;"></a>
<?php endif; ?>

<?php if ($niveau == 3): ?>
  <a href="peaufiner.php"><img src="assets/img/peaufiner.jpg" alt="Peaufiner" style="width:200px;height:300px;"></a>
<?php endif; ?>

<?php if ($niveau == 4): ?>
  <a href="confirmer.php"><img src="assets/img/confirmer.jpg" alt="Confirmer" style="width:200px;height:300px;"></a>
<?php endif; ?>

<?php include 'includes/footer.php';
?>
