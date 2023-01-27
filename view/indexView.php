<?php
//var_dump($_POST)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/captcha.css">
        <script src="js/captcha.js" defer></script>
</head>
<body onload="captchaHome(redirection,7)">
    <h1>Laissez-nous un message</h1>
    <div class="agencement">
        <img id="satisfaction" src="img/Satisfaction.jpg" alt="Donnez votre avis">
        <section><!--formulaire-->
            <form name='livret' action='' method="POST">
                <div class="champs"><label for="lastname">Nom*</label><input type="text" name="lastname" placeholder="Indiquez votre nom" required></div>
                <div class="champs"><label for="firstname">Prénom*</label><input type="text" name="firstname" placeholder="Indiquez votre prénom" required></div>
                <div class="champs"><label for="usermail">E-mail*</label><input type='email' name="usermail" placeholder="Indiquez votre e-mail" required></div>
                <div class="champs"><label for="avis">Votre avis*</label><textarea maxlength="600" name="message" placeholder="Indiquez votre avis" required></textarea></div>
                <div class="envoi"><p>(*Champs obligatoires)</p></div>
                <div class="envoi"><input id="bouton" type="submit" value="Envoyer"></div>        
            </form>
        </section>
    </div>
    <div class="vide"></div>
    <div class="card">   <!--pour TOUT le captcha-->
		<p id="captcha" class="box_captcha"></p>
		<input id="captchaInput" type="text"  placeholder="Tapez le captcha"><br>
		<button id="captchaValidate">Valider</button>
        <button id="captchaRefresh">Refresh</button>
	</div>

    <h3>Les mails</h3>
    <?php
    # pas de mail
    if(empty($nbMail)):
    ?>
    <h4>Pas encore d'adresses</h4>
    <?php
    # on a au moins un mail
    else:
        # affichage du nombre de mail
        ?>
    <h4>Nous avons <?=$nbMail?> adresses inscrites</h4>
        <?php
        # tant qu'on a des mail
        foreach($responseMail as $item):
        ?>
<div class='theMail'>
   <p>  <?=$item['firstname']?> a envoyé ce message le <?=$item['datemessage']?>: <br> <?=$item['message']?></p>  <!--$item['lastname']  nom retiré par souci d'anonymat MAIS required quand je veux contacter pour un message -->
</div>
        <?php
        endforeach;
    endif;
    ?>
</body>
</html>