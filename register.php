<?php
include 'includes/header.php'; ?>
<style>
    .mdl-checkbox__ripple-container .mdl-ripple {
        background: rgb(0, 100, 0) !important;
    }
</style>
<main class="mdl-layout__content">
    <div class="page-content">
        <section style="margin:5% 20%; text-align: center; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; background-color: white">
            <div class="page-content colorgreen" style="color: black; margin-left: 5%; margin-right: 5%; width: 90%">
                <form action="register_cible.php" method="post">
                    <div>
                        Nom* :<br>
                        <div style="margin-top: -2%; margin-bottom: 5%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input required style="border-bottom: 1px solid #003d00;" class="mdl-textfield__input" type="text" name="nom">
                            <label class="mdl-textfield__label" for="nom" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <div>
                        Prénom* : <br>
                        <div style="margin-top: -2%; margin-bottom: 2%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input required style="border-bottom: 1px solid #003d00;" class="mdl-textfield__input" type="text" name="prenom">
                            <label class="mdl-textfield__label" for="prenom" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <div>
                        Adresse mail* :<br>
                        <div style="margin-top: -2%; margin-bottom: 5%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input required style="border-bottom: 1px solid #003d00;" class="mdl-textfield__input" type="email" name="login">
                            <label class="mdl-textfield__label" for="login" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <div>
                        Mot de passe* :<br>
                        <div style="margin-top: -2%; margin-bottom: 5%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input style="border-bottom: 1px solid #003d00;" class="mdl-textfield__input" type="text" name="password">
                            <label class="mdl-textfield__label" for="password" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <div>
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                            <input required type="checkbox" id="checkbox-1" class="mdl-checkbox__input">
                            <span class="mdl-checkbox__label">En cochant cette case vous acceptez que Freebridge enregistrer les informations saisis ci-dessous
							</span>
                        </label>
                    </div>
                    <div id="divregisterbtn">
                        <button id="btnretour" style="margin-top: 2%; margin-bottom: 2%;background-color: #003D00; margin-right: 20%" type="button" onclick="document.location.href='index.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Retour
                        </button>
                        <button style="margin-top: 2%; margin-bottom: 2%;background-color: #003D00;" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Inscription
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
<?php include 'includes/footer.php'; ?>



