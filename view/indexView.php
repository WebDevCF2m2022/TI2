<?php
//var_dump($_POST);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/captcha.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/captcha.js" defer></script>
    <title>Livre d'or</title>
</head>
<body onload="envoisForm(7)">

    <h1>MON LIVRE D'OR SECRET 🤫</h1>

    <img src="img/email.png" alt="">

    <!-- formulaire de messages -->
    <form id="monFormulaire" name='livredor' action='' method="POST">
        <h2>Laissez-nous un message</h2>

        <div id="prenom">
        <div id="lab">
        <label for="">Prénom*</label>
        </div>
        <input class="unput" type="text" name="firstname" placeholder="Votre Prénom" required>
        </div>

        <div id="nom">
        <div id="lab">
        <label for="">Nom</label>
        </div>
        <input class="unput" type="text" name="lastname" placeholder="Votre nom">
        </div>
        
        <div id="mail">
        <div id="lab">
        <label for="">E-mail*</label>
        </div>
        <input class="unput" type='email' name="usermail" placeholder="Votre mail" required>
        </div>

        <div id="mess">
        <div id="lab">
        <label for="">Message*</label>
        </div>
        <textarea class="unput" id="" name="message" cols="30" rows="10" placeholder="Entrez votre message qui s'affichera ensuite en bas du formulaire"></textarea>
        </div>

        <h5>(*) Ces champs sont obligatoires</h5>

        <button class="btn" id="captchaValidate" type="button">envoyer</button>


    </form>
    <!-- captcha -->
    <div class="captcha">
        <p id="captcha"></p>
        <button class="" id="captchaRefresh" type="button">Refresh</button> <br>
        <input id="captchaInput" type="text" placeholder="Entrez le captcha"><span> </span>
        
    <?=$message?>
    </div>

    
    <div class="txt">
    <h3>Les messages précédents</h3>
    <?php
    # pas de messages
    if(empty($nbMessage)):
    ?>
    <h4>Aucuns messages</h4>
    <?php
    # on a au moins un message
    else:
        # affichage du nombre de messages
        ?>
    <h4>Nous avons <?=$nbMessage?> messages</h4>
        <?php
        # tant qu'on a des messages
        foreach($responseMessage as $item):
        ?>
        </div>
<div class='lesmessages'> <span id="auteur"><?=$item['firstname']?> <span id="pasdebold"> à envoyer ce message le </span><em><?=$item['datemessage']?></em></span><?=$item['message']?></div>
        <?php
        endforeach;
    endif;
    ?>
    
    <script src="js/captcha.js"></script>
</body>
</html>