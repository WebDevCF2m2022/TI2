<?php
//var_dump($_POST); 
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
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/captcha.css" rel="stylesheet">
    <script src="js/captcha.js" defer></script>
    <title>Mail</title>
</head>
<body>
<header class="titre">
      <h1>Livre d'or</h1>
    </header>
    <main>

   
    <?php
        #si on a un message 
        if(isset($info)):
        #on l'afficher
        ?>
        <h4><?=$info?></h4>
        <?php
        endif; 
          ?>

<section class="conteneurpicform"> 
        <div class="picture">
          <img class="image" src="img/email.png">
        </div>
        <div class="conteneurform">
          <h2 class="titreform">Laissez-nous un message</h2>
    <form action="" method="POST" class="formulaire" name="lemail" id="monFormulaire">
    <div class="formTitle">    </div>
       
      </div>
         <div class="form-input">
           <label for="username">Prénom *</label>
           <input type="text" name="firstname" id="username"  required>
         </div>
         <div class="form-input">
         <label for="username">Nom</label>
        <input type="text" name="lastname" id="username" />
            </div>

      <div class="form-input">
      <label for="email">E-mail *</label>
           <input type="email" name="usermail" id="email" required>
         </div>   

    <div class="form-input">
    <label for="Message">Message *</label>      
    <textarea  name="message" id="message" require></textarea>
         </div> 
         <div class="endform">
         <p class="stars">(*)Ce champs est obligatoire</p>
         <div class="captchaValidate">
        <button id="captchaValidate" type ="button" class="envoyer">Envoyer</button>
        </div>
    </div>
</section><br><br>
<section>

<aside>
<div class="captcha"class="captchacolor">
			<p id="captcha" ></p></br></br>
            
			<input id="captchaRefresh" type="button" value="Refresh"><br>
      <div class="captcha-form">
			<input id="captchaInput" type="text" placeholder="Entrez le captcha" require>
            <div><span></span></br></br></div>
<!-- je change avec input pour avoir le button submit aussi 
			<button id="captchaValidate" type ="button">Valider</button>
			<button id="captchaRefresh" type="button">Refresh</button>-->
      </div>
		</div>
</aside>
     </form>
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
<div class="conteneurmsg">
    <?=$item['firstname']?>
    
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
