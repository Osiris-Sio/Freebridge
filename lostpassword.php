<?php
include 'includes/header.php'; ?>
<main class="mdl-layout__content">
    <div class="page-content">
        <section style="margin: 5% 20%;text-align: center; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; background-color: white; padding-bottom: 2%;">
            <div class="page-content colorgreen" style="color: black;">
                <form action="lostpassword_cible.php" method="post">
                    <div>
                        Email*:<br>
                        <div style="margin-top: -2%; margin-bottom: 5%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input style="border-bottom: 1px solid #003d00;" class="mdl-textfield__input" required type="email" name="login">
                            <label class="mdl-textfield__label" for="login" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <button style="margin-bottom: 2%;background-color: #003D00;" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Envoyer un nouveau mot de passe
                    </button>
                    <br>
                    <button style="margin-top: 2%; margin-bottom: 2%;background-color: #003D00;%" type="button" onclick="document.location.href='login.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Retour
                    </button>
                </form>
                <br>
            </div>
        </section>
    </div>
</main>
<?php include 'includes/footer.php';
?>
