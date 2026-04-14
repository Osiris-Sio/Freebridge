<?php
include 'includes/header.php';
$niveau = $_GET['lvl'];
?>


<?php
if (lvl == 1) 
{
<a  href="debutant.php"><img src="assets/img/debuter.jpg" alt="Débuter" style="width:200px;height:300px;"></a>
}


if (lvl == 2)
{	
<a  href="progresser.php"><img src="assets/img/progresser.jpg" alt="Progresser" style="width:200px;height:300px;"></a>
}

if (lvl == 3) 
{	
<a  href="peaufiner.php"><img src="assets/img/peaufiner.jpg" alt="Peaufiner" style="width:200px;height:300px;"></a>
}

if (lvl == 4)
{
<a  href="confirmer.php"><img src="assets/img/confirmer.jpg" alt="Confirmer" style="width:200px;height:300px;"></a> 
}
?>

<?php
include 'includes/footer.php';
?>
