<?php
include 'includes/header.php'
?>
<main class="mdl-layout__content">
    <div class="page-content">
        <section style="margin: 5% 20%; text-align: center; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; background-color: white; padding-bottom: 3%;">
            <div class="page-content colorgreen" style="color: black; margin-left: 5%; margin-right: 5%; width: 90%">
                <form action="login_cible.php" method="post">
                    <div>
                        Login :<br>
                        <div style="margin-top: -2%; margin-bottom: 5%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input style="border-bottom: 1px solid #003d00;" class="mdl-textfield__input" type="email" name="login">
                            <label class="mdl-textfield__label" for="login" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <div>
                        Mot de passe : <br>
                        <div style="margin-top: -2%; margin-bottom: 2%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input style="border-bottom: 1px solid #003d00;" class="mdl-textfield__input" type="password" name="password">
                            <label class="mdl-textfield__label" for="password" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <button style="margin-top: 2%; margin-bottom: 2%;background-color: darkgreen; margin-right: 2%" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
						Connexion
                    </button>
                    <a href="lostpassword.php" id="linkregister">Mot de passe oublié ?</a>
                </form>
                <a href="register.php" id="linkregister">Vous n'avez pas de compte ? cliquez ici pour vous en créer un</a>
                <br>
            </div>
        </section>
    </div>
</main>

