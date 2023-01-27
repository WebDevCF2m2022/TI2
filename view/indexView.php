<?php# pour debuguer la variable POST 
var_dump($_POST);  
 ?>
<!DOCTYPE html>
<html lang="fr">  
<head><meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'OR</title> 
 <link href="css/style.css" rel="stylesheet" />  
<link href="css/captcha.css" rel="stylesheet" /> 
    <script src="js/captcha.js" defer></script></head>
    </head>
       <body onload="captchaCF2M(redirectionDuckduck,7)">    
       
       <h1>Le Livre d'or</h1>    
       
       <?php

    if(isset($message)):
        # le message est affiché
    ?>    
    <h4><?=$messageZ?></h4>   
    <?php
    endif;
    ?>    
   
<img src="img/email.png" alt="email" class="image">
<div class="container">

  <form id='monFormulaire' name='lemail' action='' method="POST">
  <h3>Votre avis est important</h3>
    <label for="fname">Prénom*</label>
    <input type="text" id="fname" name="firstname">
    
    <label for="fname">Nom</label>
    <input type="text" id="fname" name="lastname">

    
    <label for="emailAddress">E-mail*</label>
    <input id="emailAddress" type="email" name="usermail">

    <label for="subject">Message*</label>
    <textarea id="subject" name="message" maxlength="600"></textarea><br><br>

    <button id="captchaValidate" type="button">Valider</button>
    <p><span>(*) Ce champ est obligatoire</p></span>
  
     <div class="disC"> <p id="captcha"></p></br></br> 
        <input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>           
                 
        <button id="captchaRefresh" type="button">Refresh</button>        
       
    </div>    
         
  </form>
</div>

       <!-- <h3>Messages précédents</h3>    -->
    <?php

    # s'il n'y a pas de mail
    if(empty($nbMail)):
    ?>    <h4>Pas encore d'adresses</h4>    <?php
    # au moins un mail
    else:
        # on a le nombre de mails ici
        ?>   
         <h4 class=txtM>Nous avons <?=$nbMail?> adresses inscrites</h4>       
    <?php

        # ici c'est s'il y a des mails
        foreach($responseMail as $item):
        ?>
        
    <div class='theMail'>

         <?=$item['firstname']?> 
         <?=$item['lastname']?> 
         <?=$item['usermail']?>
         <?=$item['message']?>
        
    </div> 
          
    <?php
        endforeach;
    endif;
    ?></body></html>