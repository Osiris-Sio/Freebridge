<?php
include 'header.php'
?>
<main class="mdl-layout__content">
    <div class="page-content">
        <section style="margin: 5% 20%; width: 60%; border: 1px solid #003d00; border-radius: 20px; padding-top: 1%; background-color: white">
            <div class="page-content colorgreen" style="color: black; margin-left: 5%; margin-right: 5%; width: 90%">
                <form action="formulaire_cible.php" method="post">
                    <div style="display: flex;flex-direction: column;">
                        <div style="order: 1;margin-right: 10%">
                            Nom* :<br>
                            <div style="margin-top: -2%; margin-bottom: 5%; width: 100% " class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                                <input <?php if(isset($_SESSION['user_nom'])) { ?> value="<?php echo $_SESSION['user_nom'] ?>" <?php } ?> required style="border-bottom: 1px solid #003D00;width: 40%" class="mdl-textfield__input" type="text" name="nom">
                                <label class="mdl-textfield__label" for="nom" style="background: transparent; border: none;"></label>
                            </div>
                        </div>
                        <div style="order: 2;">
                            Prénom* :<br>
                            <div style="margin-top: -2%; margin-bottom: 2%;width: 100%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                                <input <?php if(isset($_SESSION['user_prenom'])) { ?> value="<?php echo $_SESSION['user_prenom'] ?>" <?php } ?> required style="border-bottom: 1px solid #003D00; width: 30%" class="mdl-textfield__input" type="text" name="prenom">
                                <label class="mdl-textfield__label" for="prenom" style="background: transparent; border: none;"></label>
                            </div>
                        </div>
                    </div>
                    <div>
                        Adresse mail* :<br>
                        <div style="margin-top: -2%; margin-bottom: 5%;width: 100%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input <?php if(isset($_SESSION['user_mail'])) { ?> value="<?php echo $_SESSION['user_mail'] ?>" <?php } ?> required style="border-bottom: 1px solid #003D00; width: 60%" class="mdl-textfield__input" type="email" name="mail">
                            <label class="mdl-textfield__label" for="mail" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <div>
                        Votre demande* :<br>
                        <div style="margin-top: -2%; width: 100%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded" data-upgraded=",MaterialTextfield">
                            <input required style="border-bottom: 1px solid #003D00;width: 93%" class="mdl-textfield__input" type="text" name="demande">
                            <label class="mdl-textfield__label" for="demande" style="background: transparent; border: none;"></label>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <button style="margin-top: 2%; margin-bottom: 2%;background-color: #003D00; margin-right: 20%" type="button" onclick="document.location.href='index.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Retour
                        </button>
                        <button style="margin-top: 2%; margin-bottom: 2%;background-color: #003D00;" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
<?php
include 'footer1.php';
?>