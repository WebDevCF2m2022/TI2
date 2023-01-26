<?php
var_dump($_POST); 
?>
<?php
# débugogage de la variable POST
//var_dump($_POST);   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/captcha.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/captcha.js" defer></script>
    <title>Mail</title>
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
    <!--<form name='lemail' action='' method="POST">
            <input type="text" name="nomadresses" placeholder="votre nom" required><br>
            <input type='email' name="mailadresses" placeholder="votre mail" required><br>
            <input type="submit" value="Envoyer">
        </form>-->
           <form name='monFormulaire' action='' method="POST"> 
        <div class="loginFormulaire" id="monFormulaire">
      <div class="formTitle">
        <h1>Member Login</h1>
      </div>
      <div class="form-input">
        <label for="username">Prénom *</label>
        <input type="text" name="firstname" placeholder="Saisissez votre prénom"  id="username" required />
      </div>
      <div class="form-input">
        <label for="username">Nom</label>
        <input type="text" name="lastname" placeholder="Saisissez votre nom"  id="username" />
      </div>
      <div class="form-input">
        <label for="email">E-mail *</label>
        <input type="email" name="usermail" placeholder="mail"  id="Saisissez votre email" required />
      </div>
      <div class="form-input">
        <label for="Message">Message *</label>
        <textarea name="message" placeholder="message"  id="message" required /></textarea>
      </div>
      <div class="captchaValidate">
            <button id="captchaValidate">Valider</button>
            <!--<button id="captchaRefresh">Refresh</button> -->
          </div>

      
      <div class="captcha">
        <label for="captcha">Entrer Captcha</label>
        <div class="captc" id="captcha"></div>

        <div class="captcha-form">
          <input
            type="texte"
            id="captchaInput"
            placeholder="Entrer captcha text"
          />
          <div class="captchaValidate">
            <!--<button id="captchaValidate">Login</button>-->
           <button id="captchaRefresh">Refresh</button>
          </div>
        </div>
      </div>
    </div>
  
    <h3>Les mails</h3>
    <?php
    # pas de mail
    if(empty($nbMail)):
    ?>
    <h4>Nous avons <?=$nbMail?> adresses inscrites</h4>
    <?php
    # on a au moins un mail
    else:
        # affichage du nombre de mail
     
        # tant qu'on a des mail
        foreach($responseMail as $item):
        ?>
<div class='theMail'>
    <?=$item['firstname']?>
    <?=$item['lastname']?>
    <?=$item['usermail']?>
    <?=$item['datemessage']?>
    <br>
    <?=$item['message']?>
  </div>
        <?php
        endforeach;
    endif;
    ?>
</body>
</html>
