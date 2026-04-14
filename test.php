<div id="paypal-button-container"></div>
<!---<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',

      },
      createOrder: function(data, actions) {
          return actions.order.create({
              purchase_units: [{
                  amount: {
                      value: '1'
                  }
              }]
          });
      },
      onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
      }
  }).render('#paypal-button-container');
</script>--->


<?php
include 'includes/pdo.php';
session_start();
$_SESSION['user_id'] = 1;
$date = date('d/m/Y');
if ($_SESSION['page'] == '/test.php') {
  echo $_SESSION['prix'] = rand(2, 4);
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
} else {
  echo "j'ajoute pas dans la bdd";
}
$_SESSION['page'] = $_SERVER['PHP_SELF'];


?>
