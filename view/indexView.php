<?php
//*var_dump($responseLog)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/captcha.css">
    <script src="js/captcha.js" defer></script>
</head>
<body>
    <h1>Test</h1>

    <?php
    # si on a un message, si on a un message 
    if(isset($messageError)):
        
    ?>
    <h4><?=$messageError?></h4>
    <?php
    endif;
    ?>

<div class="formulaire">
    <img src="img/email.png" alt="">
    <form name='formBook' action='' method="POST">
      
            <input type="text" name="prenomLog" placeholder="Prenom" ><br>
            <input type='text' name="nomLog" placeholder="Nom" required><br>
            <input type='email' name="mailLog" placeholder="Mail" required><br>
            <input type='text' name="messageLog" placeholder="Message" required><br>
            <input type="button " value="Envoyer">
    </form>
</div>
        <div>
			<p id="captcha"></p><br>
			<input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>
			<button id="captchaValidate" type="button">Valider</button>
			<button id="captchaRefresh" type="button">Refresh</button>
		</div>
        <?php
    # pas de mail
    if(empty($nbLog)):
    ?>
    <h4>Pas encore d'adresses</h4>
    <?php
    # on a au moins un mail
    else:
        # affichage du nombre de mail
        ?>
    <h4>Nous avons <?=$nbLog?> adresses inscrites</h4>
        <?php
        foreach($responseLog as $item):
        ?>
        <div class='affichageLog'>
            <?=$item['firstname']?> 
            <?=$item['lastname']?> 
            <?=$item['usermail']?> 
            <?=$item['datemessage']?>
            <br>
            <?=$item['message']?> <br>
        </div>
        <?php
        endforeach;
        endif;
    ?>

    
</body>
</html>