<?php

require_once "../config.php";

try{
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);

    mysqli_set_charset($db,DB_CHARSET);

}catch(Exception $e){

    exit(utf8_encode($e->getMessage()));

}

if(isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'] )){
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES);
    $textmessage = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);
    
    # débugage des champs traités
    // var_dump($nom,$mail);

    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if(!empty($prenom)&&!empty($mail)&&!empty($textmessage)){
        
        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`,`lastname`,`usermail`, `message`) VALUES ('$prenom','$nom','$mail','$textmessage');";
        header("Location: ./");

        # requête avec try catch
        try{
            # requête
            mysqli_query($db,$sqlInsert);
            
            # si pas d'erreur création du texte
            $message ="Merci pour votre inscription";

        }catch(Exception $e){
            
            $message =  $e -> getMessage();
        }


    # sinon erreur
    }else{
        # création de la variable $message
        $message = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }

}
else {$message = "";
}


# chargement de tous les mails

// requête en variable texte contenant du MySQL
$sqlMessage = "SELECT `firstname`, `lastname`, `usermail`, `message`FROM `livreor` ORDER BY `datemessage` DESC; ";

// exécution de la requête avec un try / catch
try {
    $queryMessage = mysqli_query($db, $sqlMessage);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(utf8_encode($e->getMessage()));
}

# on compte le nombre de mails récupérés
$nbMail = mysqli_num_rows($queryMessage);


# on convertit les mails récupérés en tableaux associatifs intégrés dans un tableau indexé
$responseMessage = mysqli_fetch_all($queryMessage,MYSQLI_ASSOC);

mysqli_free_result($queryMessage);

mysqli_close($db); 

include_once '../view/indexView.php';



