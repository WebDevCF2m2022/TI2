
<?php

require_once "../config.php";


try{
    #connexion mysqli (mariadb)
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    mysqli_set_charset($db, DB_CHARSET);
    # capture d'erreur
}catch(Exception $e){
    #arrêter le script et afficher l'erreur 
    exit(mb_convert_encoding($e->getMessage(),'UTF-8','ISO-8859-1'));
}



    
          #SO IL EXISTE LE VARIABLE POST +FORMULAIRRE ENVOYER
         if( isset($_POST['firstname']) && isset($_POST['usermail'])){

          #TRAITEMENT DES CHAMPS CONTRE INJECTION SQL (securité)  // filter_var($email , FILTER_VALIDATE_EMAIL); voir la function sur php.net  et mettre dans cette condition pour verifie la valide de email, mais il verifie pas s'il est vide 
            $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
            $nom=htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
             $email = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES);
             $msg= htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES); 


#debugage des champ traites si le variable poste existe le traite , les insere dans le db , est souvent utile 

  # si les champs sont pas vide (on seul erreur generfal)
            if(!empty($nom)&& !empty($email)&& !empty($msg)){
              /*
var_dump($prenom); 
var_dump($nom); 
var_dump($email);
var_dump($msg); 
*/
                       #insertion partie SQL 
                  $sqlInsertMail = "INSERT INTO `livreor` (`id`, `firstname`, `lastname`, `usermail`, `message`, `datemessage`) VALUES (NULL, '$prenom', '$nom', '$email', '$msg', current_timestamp())";
/*var_dump($sqlInsertMail); */
                #requete avec try catch 
               try{
                  #requête
                mysqli_query($db,$sqlInsertMail); 
                 $message ='<span style="color:green;">Merci pour votre message envoyer </span>'; 
                
                 ?>
                <!-- <h2><?=$message?></h2> il m'affiche plusieur fois -->
                 

               <?php
               // header("Location: ./");  // il enregiste plus apres dans base de donne :)) c'est un probleme que le je fait 11 fois :) ? SI JE MISE IL AFICHE PLUS SMS 
               }catch(Exception $e){
               # echo $e->getCode(); 
      
               #avec les code sql on peut faire des erreur differents
                   if($e->getCode()==1406){
                   # creation du l'erreur
                    $message='<span style="color:red;">!very long mail </span>';
                    ?>
                    <h2><?=$message?></h2>
                  <?php
                  //si il c'est un autre alors on a parte 
                  }elseif($e->getCode()){
                     #creatipon du l'erreur
                     $message='<span style="color:red;">now email pls </span>';
                     ?>
                     <h2><?=$message?></h2>
                   <?php
                
                 }

           }
     
     #sinon erreur
         }else{
            #creation de variable $message
            $message='<span style="color:red;"> you have a bug try again !</span>'; 

         }
        }

        #chargement de tous les mails 

      #requette en variables texte contenant du MySql
    $sqlMail = "SELECT   `firstname`, `lastname`, `usermail`, `message`, `datemessage` FROM `livreor`
    ORDER BY `datemessage` DESC;";


    # execution de la requete avec un try 
    try{
        $queryMail = mysqli_query($db,$sqlMail); 
    }catch(Exception $e){
          #arrêter le script et afficher l'erreur 
         
       exit(mb_convert_encoding($e->getMessage(),'UTF-8','ISO-8859-1'));
    }
    
        

    # on compte le nombre de mails récupêres 
    $nbMail = mysqli_num_rows($queryMail); 
 


      #on convertit les mails récupers en tableaux associatifs integres dans un tableau indexe
    $reposeMail = mysqli_fetch_all($queryMail,MYSQLI_ASSOC) ; 

 
     #on efface toute le donnee recuperes par un SELECT 
     mysqli_free_result($queryMail); 




    # fermeture de connextion a la fin fu fichier 
    mysqli_close($db); 


    #appell de l'a vu  
    include_once '../view/indexView.php';










