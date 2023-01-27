<?php
# débugogage de la variable POST
// var_dump($_POST);   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link href='css/style.css' rel='stylesheet' />
    <link href='css/captcha.css' rel='stylesheet' />
    <script src="js/captcha.js" defer></script>
</head>
<body onload="captchaCF2M(envoiFormulaire, 7);">
    <h1>Livre d'or</h1>
    <img src="../img/email.png" alt="">
    <div id="formulaire"><br>
    <h2>Laissez nous un message</h2>
        <form id='monFormulaire' name='lemail' action='' method="POST">
            <p>Prénom</p>
            <input type="text" name="firstname" placeholder="Prénom"><br>
            <p>Nom *</p>
            <input type="text" name="lastname" placeholder="Nom" required><br>
            <p>E-Mail *</p>
            <input type="email" name="usermail" placeholder="E-Mail" required><br>
            <p>Message *</p>
            <textarea type="text" name="message" placeholder="Écrivez votre message ici" required></textarea>
            <h6>(*) Ce champ est obligatoire</h6>
            <button id="captchaValidate" type="button">Envoyer</button><br><br>
            <div id="messageSend" style="display: none; color: blue; font-weight: bolder; font-size: 50px; text-align: center;">
            Formulaire envoyé avec succès</div>
        </form>
        </div>
        <div id="blockcaptcha">
			<p id="captcha"></p></br>
			<input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>
			<button id="captchaRefresh" type="button">Refresh</button>
		</div>
    <h3>Messages précédents</h3>
    
        <?php
        # tant qu'on a des données
        foreach($finalArr as $item):
        ?>
<div id='affiche'>
        <h4>Nom</h4>
            <span><?=$item['lastname']?></span>
        <h4>Pénom (optionnel)</h4>
            <span><?=$item['firstname']?></span>
        <h4>Date</h4>
            <span><?=$item['datemessage']?></span>
        <h4>Message</h4>
            <span><?=$item['message']?></span>
</div>
<?php
    endforeach;
?>
</body>
</html>