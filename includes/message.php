<div id="toast-container">

<?php
/**
 * Système global de notifications (Toasts)
 */

// Messages de succès (Confirmations)
if (isset($_SESSION['messages']['confirm']) && is_array($_SESSION['messages']['confirm'])) {
  foreach ($_SESSION['messages']['confirm'] as $message) { ?>
        <article role="alert" class="toast toast-success">
            <header>
                <strong>✓ Succès</strong>
                <span class="closebtn">&times;</span>
            </header>
            <div class="toast-content"><?php echo $message; ?></div>
        </article>
<?php }
  unset($_SESSION['messages']['confirm']);
}

// Messages d'erreur
if (isset($_SESSION['messages']['errors']) && is_array($_SESSION['messages']['errors'])) {
  foreach ($_SESSION['messages']['errors'] as $error) { ?>
        <article role="alert" class="toast toast-error">
            <header>
                <strong>⚠ Erreur</strong>
                <span class="closebtn">&times;</span>
            </header>
            <div class="toast-content"><?php echo $error; ?></div>
        </article>
<?php }
  unset($_SESSION['messages']['errors']);
}
?>
</div>
