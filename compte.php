<!DOCTYPE html>

<?php include 'includes/header.php'; ?>
<main class="mdl-layout__content">
    <div class="page-content">
        <section style="margin: 5% 20%; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; background-color: white">
            <div class="page-content colorgreen" style="color: black; text-align: center">

 
<h3 style="text-decoration: underline">Mon Compte</h3>
<p style="text-align: left; margin-left: 1%">Bonjour, <?php echo $_SESSION['user_prenom'] .
  ' ' .
  $_SESSION['user_nom']; ?></p>
<pre>Les abonnements sont mensuels et dépendent du niveau 
Il est possible de se désabonner à tout instant, ce qui supprime les prélévements.
C'est cette procédure qu'il faut utiliser pour passer en catégorie supérieure.</pre>

<table style="width: 90%; margin: 0 5%">
  

  
  <tr>
    <td>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="9GZ56P2N9RZ2J">
<table>
<tr><td><input type="hidden" name="on0" value="Progresser">Progresser</td></tr><tr><td><select name="os0">
	<option value="Accès">Accès : €2,00 EUR - mensuel</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6Q8V6VZ6UD8FJ">
<table>
<tr><td><input type="hidden" name="on0" value="Peaufiner">Peaufiner</td></tr><tr><td><select name="os0">
	<option value="Accès">Accès : €3,00 EUR - mensuel</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="T4ST5LJNNKNJY">
<table>
<tr><td><input type="hidden" name="on0" value="Confirmer">Confirmer</td></tr><tr><td><select name="os0">
	<option value="Accès">Accès : €4,00 EUR - mensuel</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>

	</td>
 
	<A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=YGV5Y2X5ZPJRE">
	<IMG SRC="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_unsubscribe_LG.gif" BORDER="0">
	</A> 
	 
    </tr>
</table>
</div>
</section>
</div>
</main>

<?php
$date = date('d/m/Y');
if ($_SESSION['prix'] == 2) {
  $sql =
    "UPDATE user SET user_rang='progresser', user_date='" .
    $date .
    "' WHERE user_id=" .
    $_SESSION['user_id'] .
    '';
  $conn->query($sql);
} elseif ($_SESSION['prix'] == 3) {
  $sql =
    "UPDATE user SET user_rang='peaufiner', user_date='" .
    $date .
    "' WHERE user_id=" .
    $_SESSION['user_id'] .
    '';
  $conn->query($sql);
} elseif ($_SESSION['prix'] == 4) {
  $sql =
    "UPDATE user SET user_rang='confirmer', user_date='" .
    $date .
    "' WHERE user_id=" .
    $_SESSION['user_id'] .
    '';
  $conn->query($sql);
}
$_SESSION['page'] = '';

$_SESSION['page'] = $_SERVER['PHP_SELF'];

include 'includes/footer1.php';


?>
