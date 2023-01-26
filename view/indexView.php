<?php
var_dump($_POST)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Livre d'or TI2</title>
</head>
<body>
    <h1>Livre d'or </h1>
    <?php
        #si on a un message 
        if(isset($message)):
        #on l'afficher
        ?>
        <h4><?=$message?></h4>
        <?php
        endif; 
          ?>
    <img src="../img/email.png" alt="email">
    <form action="" method="POST" class="formulaire" name="lemail" id="monFormulaire">
         <h3>Laissez-nous un message</h3>
        <div class="login">
            Prénom *:<input type="text" name="firstname" class="logpre">
            </div>
            <div class="login">
            Nom     :<input type="text" name="lastname" class="lognom">
            </div>
         <div class="login">
            E-Mail *:<input type="email" name="usermail" class="logmail">
         </div>   
         <div class="message">
            Message*:<input type="text" name="message" class="logmsg">
         </div> 
           <h3 class=oblig>(*) Ce champ est obligatoire </h3>
        <div class="button">
            <button type="submit">Envoyer</button>
        </div>
           
    
     </form>
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

 <div class="theMail"><?= $item['firstname']?><?=$item['usermail']?></div>
        <?php
        endforeach; 
        endif; 
        ?>
     <style>
        /* ecran plus de 800px**/
form{
    width: 800px;
   /* height: 200px;*/
    border: 2px solid #000;
    /* border-radius: 10px; */
    display: flex;
    flex-direction: column;
    padding: 50px;
    margin-left: 20%;
    margin-top: -415px;
    background-color: #2196f3;
}
.login{
    margin: 20px 20px;
}
.button{
    margin: 40px 20px;
}
img{
    width: 400px;
}
h1{
    font-size: 2em;
    text-align: center;
    color:#2196f3; 
}
h3{
    text-align: center; 
    color: #fff; 
}
.logpre,.lognom ,.logmsg, .logmail{
    width:600px; 
    padding:10px; 
}

.logmsg{
    height:100px; 
  /*  position: absolute;
    left: 525px;
    top: 380px;*/
}
/*
.lognom{
    position: absolute;
    left: 525px;
    top: 262px;
}
.logmail{
    position: absolute;
    left: 522px;
    top: 325px;
}
.oblig{
    position: absolute;
    top: 495px;
    left: 732px
}
*/

@media screen and (min-width: 400px) and (max-width:800px) {
    form {
            width: 300px;
            height: 100px;
            padding: 50px;
            border: 2px solid red;
            border-radius: 10px;
            display: block;
        }
    
        div {
            margin: 20px 20px;
        }
    
        .button {
            margin-left: 35%;
        }
    }

@media screen and (max-width:400px) {
    form {
        width: 200px;
        height: 100px;
        padding: 50px;
        border: 2px solid blue;
        border-radius: 10px;
        display: block;
    }

   .login,{
        margin: 10px 10px;
    }

    .button {
        margin: 0px 0px;
        margin-left: 35%;
    }
}
        </style>
</body>
</html>