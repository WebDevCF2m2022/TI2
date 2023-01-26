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
    <title>Mail</title>
    <link href='css/style.css' rel='stylesheet' />
</head>
<body>
    <h1>Mail</h1>
    <h2>Formulaire</h2>
    <?php
    # si on a un message
    if(isset($message)):
        # on l'affiche
    ?>
    <h4><?=$message?></h4>
    <?php
    endif;
    ?>
        <form name='lemail' action='' method="POST">
            <input type="text" name="nomadresses" placeholder="votre nom" required><br>
            <input type='email' name="mailadresses" placeholder="votre mail" required><br>
            <input type="submit" value="Envoyer">
        </form>
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
<div class='theMail'><?=$item['nomadresses']?> <?=$item['mailadresses']?></div>
        <?php
        endforeach;
    endif;
    ?>
</body>