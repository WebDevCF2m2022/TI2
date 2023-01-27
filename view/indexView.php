<?php
# débugogage de la variable POST
var_dump($_POST);   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/captcha.css">
    <script src="js/captcha.js" defer></script>

</head>
<header id="header">
<body onload="captchaCF2M(redirectionDuckduck, 7)">
<div class="imag"><img src="img/email.png" alt=""></div>
    <h1>Livre d'or</h1>
    <div class="form">
    <h2>Laissez-nous un message</h2>
    <?php
    # si on a un message
    if(isset($message)):
        # on l'affiche
    ?>
    <h4><?=$message?></h4>
    <?php
    endif;
    ?>
        <form id="monFormulaire" action='' method="POST">
            <div class="id"><label for="nom">Nom*</label><input type="text" name="firstname" placeholder="nom" required></div><br>

            <div class="id"><label for="prenom">Prénom*</label><input type="text" name="lastname" placeholder="prénom" required><br>

            <div class="id"><label for="email">E-mail*</label><input type='email' name="usermail" placeholder="e-mail" required><br>

            <div class="messageUser"><label for="message">Message*</label><textarea maxlength="600" name="message" placeholder="Votre message"required></textarea><br>

            <div class="envoie">
            
        </form>
    </div>
        <div class="capt">
			<h1>captcha</h1>
			<p id="captcha"></p><br>
			<input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>
			<button id="captchaRefresh" type="button">Refresh</button>
            <button id="captchaValidate" type="button">Valider</button>
		</div>
       
    
    <h3>Les messages précèdents</h3>
    <?php
    # pas de mail
    if(empty($nbMess)):
    ?>
    <h4>Pas encore de message</h4>
    <?php
    # on a au moins un mail
    else:
        # affichage du nombre des mess
        ?>
    
        <?php
        # tant qu'on a des mail
        foreach($repMess as $item):
           // var_dump($item)
        ?>
        
<div class='theMess'><h4><?=$item['firstname']?> à envoyé ce message le <?=$item['message']?><?=$item['datemessage']
?></h4>
</div>
        <?php
        
        endforeach;
    endif;
    ?>
     </header>
</body>
</html>