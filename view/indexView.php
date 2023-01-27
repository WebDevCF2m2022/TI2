<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/captcha.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/captcha.js" defer></script>
</head>
<body>
    <h1 class="titre">Livre d'or</h1>
    <img class="img" src="img/email.png">
    <div class="form">
        <p class="laisser">Laissez-nous un message</p>
<form id="monFormulaire" name='livre' action='' method="POST">
    <label class="pre" for="">Prénom*</label>
            <br><input class="nom" type="text" name="firstname" placeholder="Votre Prenom" required><br>

            <br><label class="pre" for="">Nom</label>
            <br><input class="pre1" type='nom' name="lastname" placeholder="Votre Nom"><br>

            <br><label class="pre" for="">E-mail*</label>
            <br><input class="mail" type='email' name="usermail" placeholder="Votre Mail" required><br>
            
            
            <br><label class="pre2" for="">Message*</label>
            

           <br> <textarea class="mess" name="message" id="" cols="30" rows="10"></textarea>
           <p class="ce">(*) Ce champ est obligatoire</p><br>
           <button id="captchaValidate" type="button">Envoyer</button><br>
        </form>
        </div>


        <br><div class="tous">
        <br><p id="captcha"></p><br>
        <br><button id="captchaRefresh">Refresh</button><br>
        <br><input id="captchaInput" type="text" placeholder="Remplir"><span></span></br></br>
       
    </div>


 <h3>Messages précédents</h3>
 <div class="boucle"><?php
 echo $message;
# pas de mail
    if(empty($nombredeMail)):
 ?></div>
    
    <h4>Pas encore d'adresses</h4>
    <?php
    echo $message;
    # on a au moins un mail
    else:
        # affichage du nombre de mail
        ?>
    <h4>Nous avons <?=$nombredeMail?> adresses inscrites</h4>
        
        <?php
        # tant qu'on a des mail
        
        foreach($responseMail as $item):
        ?>
<div class='envo'><?=$item['firstname']?>   Le   <?=$item['datemessage']?><br><?=$item['message']?></div>
        <?php
        endforeach;
    endif;
    ?>
</body>
</html>


