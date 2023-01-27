<?php
//var_dump($_POST)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/captcha.css" rel="stylesheet" />
    <script src="js/captcha.js" defer ></script>
    <title>Livre d'or TI2</title>
</head>
<body>

  
   
   <div class="container">
 
        <div class="img">
            <img src="img/img1.svg">
            <div class="txt">

          
     <?php
          #pas de e-mail
           if(empty($nbMail)):
        ?>
<h4>Pas encore de nombre <?=$nbMail?> d'adresses inscrites </h4>
        <?php
         # on a au moins un mail 
         else:
            #tant que on a des mail
         foreach ( $reposeMail  as $item):
            ?>

 <div class="messageUser">
    <?= $item['firstname']?>
    <?=$item['lastname']?>
    <?=$item['usermail']?>
    <?=$item['datemessage']?>
 <br>
 <div class=messageTest><?=$item['message']?></div>
    </div>
        <?php
        endforeach; 
        endif; 
        ?>
        </div>
    </div>
        <div class="login-container">
      

            <form action="" method="POST" class="formulaire" name="lemail" id="monFormulaire">
                <img src="img/avatar.svg" alt="" class="avatar">
                <h2>Livre d'or</h2>
                <?php
                   #si on a un message 
                     if(isset($message)):
                     #on l'afficher notre message 
                     ?>
                     <h4 class="txtErr"><?=$message?></h4>
                     <?php
                      endif; 
       ?>
                <div class="input-div one">
                    <div>
                        <h5>Prenom *</h5>
                        <input type="text" name="firstname" class="logpre" require>
                    </div>
                </div>
                <div class="input-div">
                    <div>
                        <h5>Nom</h5>
                        <input type="text" name="lastname" class="lognom">
                    </div>
                </div>
                <div class="input-div">
                    <div>
                        <h5>E-mail *</h5>
                        <input type="email" name="usermail" class="logmail" require>
                    </div>
                </div>
                <div class="input-div">
                    <div>
                        <h5>Message *</h5>
                        <input type="textarea" maxlength="600" name="message" class="logmsg" require>
                    </div>
                </div>
             
                <h6 class=oblig>(*) Ce champ est obligatoire </h6>
            

                
                <div class=bordcaptcha>
                <input type="button" class="btn" value="Envoyer" id="captchaValidate">
                    <p id="captcha"></p></br></br>
                    
                    <input id="captchaRefresh" type="button" value="Refresh"><br>
        
                    <input id="captchaInput" type="text" placeholder="Entrez le captcha" require><span></span></br></br>
            
            </form>
       
   
     </div>

</div>

</body>
</html>
