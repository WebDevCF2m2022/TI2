<?php
//*var_dump($_POST)
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
    <h1>Livre d'Or</h1>

    <?php
    # si on a un message, si on a un message 
    if(isset($messageError)):
        
    ?>
    <h4><?=$messageError?></h4>
    <?php
    endif;
    ?>

<div class="formulaire">
    <img src="img/logoyoussef.jpg" alt="">
    <form id="logFormulaire" name='formBook' action='' method="POST">
            <div class="formInt">
                <h3>Laissez-nous un message</h3>
                 <label for="prenomLog">Prenom *</label>  <input class="inputForm" type="text" name="prenomLog" placeholder="Prenom" required> <br>
                 <label for="nomLog">Nom  </label> <input class="inputForm" type='text' name="nomLog" placeholder="Nom" ><br>
                 <label for="mailLog">Mail *</label> <input class="inputForm" type='email' name="mailLog" placeholder="Mail" required><br>
                 <label class="labelMessage" for="messageLog"> Message *</label> <input class="inputFormMessage" type='text' name="messageLog" placeholder="" required><br>
                 <p class="champObligatoire" >(*) Ce champ est obligatoire</p>
                 <input class="boutonEnvoie" type="button" value="Envoyer">
            </div>

            <div class="capBody">
			<p id="captcha"></p><br>
			<input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>
		    <button id="captchaRefresh" type="button">Refresh</button>
		</div>
    </form>
</div>
<div class="messageEnvoyer">
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
    <h4>Nous avons <?=$nbLog?> avis </h4>
        <?php
        foreach($responseLog as $item):
        ?>
        <div class='affichageLog'>
            <p><?=$item['firstname']?> <?=$item['lastname']?> a envoyer ce message le <?=$item['datemessage']?> 
            <br><br>
            <?=$item['message']?> <br></p>
        </div>
</div>

        <?php
        endforeach;
        endif;
    ?>

    
</body>
</html>