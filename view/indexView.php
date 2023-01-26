<?php
var_dump($_POST)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/captcha.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/captcha.js" defer></script>
</head>
<body>
    
<form id="monFormulaire" name='livre' action='' method="POST">
    <label for="">Prénom</label>
            <input type="text" name="firstname" placeholder="Votre Prenom" required><br>

            <label for="">Nom</label>
            <input type='nom' name="lastname" placeholder="Votre Nom"><br>

            <label for="">E-mail</label>
            <input type='email' name="usermail" placeholder="Votre Mail" required><br>
           <textarea name="message" id="" cols="30" rows="10"></textarea>
           
        </form>


        <div>
        <p id="captcha"></p><br>
        <input id="captchaInput" type="text" placeholder="Remplir"><span></span></br></br>
        <button id="captchaValidate">Envoyer</button>
        <button id="captchaRefresh">Autres</button>
    </div>


 <h3>Les mails</h3>
 <?php
 echo $message;
    # pas de mail
    if(empty($nombredeMail)):
    ?>
    
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
<div class='lesmails'><?=$item['lastname']?> <?=$item['firstname']?> <?=$item['usermail']?></div>
        <?php
        endforeach;
    endif;
    ?>
</body>
</html>