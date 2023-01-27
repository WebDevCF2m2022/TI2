<?php

# débugogage de la variable POST
 //var_dump($_POST);   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <link href='css/style.css' rel='stylesheet' />
    <link href='css/captcha.css' rel='stylesheet' />
    <script src="js/captcha.js" defer></script>
</head>
<body onload="captchaCF2M(validationForm, 7);">
    <h1>Livre D'Or</h1>
    
    <div class="imageD">
        <img src="img/email.png" alt="">
    
    <div class="formulaire">
        <form id='monFormulaire' name='lemail' action='' method="POST">
            <h2>Laissez-nous un message</h2>
            <div id="affiche">
           <p><?=$affiche ?></p>

            </div>

            <div id="erreur">
               <p> <?=$erreur?></p>
            </div>
            <p>Votre nom :</p><br>
                <input type="text" name="firstname"  required>
            <br><br>
            <p>Votre prénom *: </p><br>
                <input type="text" name="lastname" >
            <br><br>
            <p>Votre mail :*</p><br>
                <input type='email' name="usermail"  required>
            <br><br>
            <p>Votre message :*</p>
            <br>
            <textarea maxlength="600" id="msg" name="message" ></textarea>
            <br><br>
            <p class="champs">(*) Ce champs est obligatoire</p>
            <button id="captchaValidate" type="button">Valider</button>
            
    </div>
    </div>

            
        </form>
        <div id="captchaa">
			<p id="captcha"></p></br></br>
            <button id="captchaRefresh" type="button">Refresh</button>
			<input id="captchaInput" type="text" placeholder="Entrez le captcha"><span> </span></br></br>
			
		</div>
    
    <?php
    # si on a un message
    if(isset($message)):
        # on l'affiche
    ?>
    
    <?php
    endif;
?>
    
    <?php
    # pas de mail
    if(empty($nbMails)):
    ?>
    <h4>Pas encore de message</h4>
    <?php
    # on a au moins un mail
    else:
        # affichage du nombre de mail
        ?>
        <h4>Nous avons <?=$nbMails?> mails enregistrer</h4>

<h2>Message précédents</h2>

<?php
foreach($messageUser as $item):
        ?>
        
        <div class="client">
            
        <h4><?=$item['firstname']?> à envoyé ce message le <?=$item['datemessage']?></h4>

        
        <div class='messageUser'><?=$item['message']?></div>

        </div>


        <?php
        endforeach;
   
    endif;
    ?>
</body>
</html>
