<?php
# débugogage de la variable POST
// var_dump($_POST);   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link href='css/style.css' rel='stylesheet' />
    <link href='css/captcha.css' rel='stylesheet' />
    <script src="js/captcha.js" defer></script>
</head>
<body onload="captchaCF2M(submitForm, 7);">
    <h1>Livre d'or</h1>
    <img src="img/email.png" width="300px" alt="Laissez un message">

        <form id='envoiMessag' name='sendMessage' action='' method="POST">
            <h2>Laissez-nous un message</h2>
            <?php
            # si on a un message
            if(isset($reponse)):
                # on l'affiche
            ?>
            <p id="reponse"><?=$reponse?></p>
            <?php
            endif;
            ?>
            <div class="ligne">
                <div class="coll25">
                    <label for="firstname">Prénom *</label>
                </div>
                <div class="coll75">
                    <input type="text" name="firstname" required>
                </div>
            </div>
            <div class="ligne">
                <div class="coll25">
                        <label for="lastname">Nom  </label>
                    </div>
                    <div class="coll75">
                        <input type="text" name="lastname">
                </div>
            </div>
            <div class="ligne">
                <div class="coll25">
                    <label for="usermail">E-mail *</label>
                    </div>
                    <div class="coll75">
                        <input type='text' name="usermail"  required>
                </div>
            </div>
            <div class="ligne">
                <div class="coll25">
                    <label for="message">Message *</label>
                </div>
                <div class="coll75">
                    <textarea  name="message" id="message" maxlength="600" required></textarea>
                </div>
            </div>
                <p>(*)Ce champ est obligatoire</p>
                <button id="captchaValidate" type="button">Envoyer</button>
        </form>

        <div class="divCaptcha">
            <p id="captcha"></p>
            <button id="captchaRefresh" type="button">Rafraîchir</button>
			<input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span>
		</div>

    <h3>Les messages précedents</h3>
    <?php
    # pas de mail
    if(empty($quantMessages)):
    ?>
    <h4>Pas encore de messages :(</h4>
    <?php
    # on a au moins un mail
    else:
        # affichage du nombre de mail
        ?>
    <h4>Nous avons <?=$quantMessages?> messages</h4>
        <?php
        # tant qu'on a des mail
        foreach($responseMessag as $item):
        ?>
            <div class='leMsge'>
                <p><?=$item['firstname']?> a envoyé ce message le <?=$item['datemessage']?></p>
                <div id="messages"><?=$item['message']?></div>
            </div>
        <?php
        endforeach;
    endif;
    ?>
</body>
</html>
