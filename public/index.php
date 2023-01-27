<?php

require_once "../config.php";

try{
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);

    mysqli_set_charset($db,DB_CHARSET);

}catch(Exception $e){

    exit(utf8_encode($e->getMessage()));

}
// conditions si les superglobals post existe bien et on les stocks chacunes dans des variables propre a eux 
if(isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'] )){
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES);
    $textmessage = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);
    

    #  condition si (verification des variable si elles sont vides ou pas)
    if(!empty($prenom)&&!empty($mail)&&!empty($textmessage)){
        
        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`,`lastname`,`usermail`, `message`) VALUES ('$prenom','$nom','$mail','$textmessage');";

        # requête try catch
        try{
            # requête
            mysqli_query($db,$sqlInsert);
            
            # message d'inscription
            $message ="Votre message a bien été envoyé";

        }catch(Exception $e){
            
            $message =  $e -> getMessage();
        }


    # sinon
    }else{
        # variable $message
        $message = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }

}
else {$message = "";
}


# chargement de tous les messages

// requête en variable texte contenant du MySQL
$sqlMessage = "SELECT `firstname`, `lastname`, `usermail`, `message` , `datemessage` FROM `livreor` ORDER BY `datemessage` DESC; ";

// exécution de la requête avec un try / catch
try {
    $queryMessage = mysqli_query($db, $sqlMessage);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(utf8_encode($e->getMessage()));
}

# on compte le nombre de messages récupérés
$nbMessage = mysqli_num_rows($queryMessage);


# on convertit les messages récupérés en tableaux associatifs intégrés dans un tableau indexé
$responseMessage = mysqli_fetch_all($queryMessage,MYSQLI_ASSOC);

mysqli_free_result($queryMessage);

mysqli_close($db); 

include_once '../view/indexView.php';



