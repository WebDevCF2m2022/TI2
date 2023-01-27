<?php

require_once "../config.php";


try{
      //connexion a la DB 
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    mysqli_set_charset($db,DB_CHARSET);
 //catch l'erreur
}catch(Exception $e){
        //message de l'erreur + arret script
    exit(utf8_encode(($e->getMessage())));

}
 
 // Si var POST existe (=envoie formulaire)
if(isset($_POST['prenomLog'], $_POST['nomLog'], $_POST['mailLog'], $_POST['messageLog'])) {

    $prenom = htmlspecialchars(strip_tags((trim($_POST['prenomLog'])), ENT_QUOTES));
    $nom = htmlspecialchars(strip_tags((trim($_POST['nomLog'])), ENT_QUOTES));
    $mail = htmlspecialchars(strip_tags((trim($_POST['mailLog'])), ENT_QUOTES));
    $message = htmlspecialchars(strip_tags((trim($_POST['messageLog'])), ENT_QUOTES));
}

//var_dump($prenom, $nom, $mail, $message); (test)

 //si les champs obligatoire ne sont pas vide
if(!empty($nom)&&!empty($mail)&&!empty($message)){

    $sqlInsert = "INSERT INTO livreor (firstname, lastname, usermail, message) VALUES ('$nom', '$prenom', '$mail', '$message')";

    try {
        mysqli_query($db, $sqlInsert);
        $messageError ="Merci pour votre avis";
        header("Location: ./");

    }catch(Exception $e){

        if($e->getCode()==1406){
            $messageError = "Un champ est trop long";
        }else{
            $messageError = "Il ya eu un problème d'envoie, veuillez réessayer";
        }
    }
}

$sqlLog = "SELECT firstname, lastname, usermail, message, datemessage FROM `livreor` ORDER BY `datemessage` DESC;";

try {
    $queryLog = mysqli_query($db, $sqlLog);
}catch(Exception $e){
    
    exit(utf8_encode($e->getMessage()));
}

//comptage des Logs
$nbLog = mysqli_num_rows($queryLog);

// conversion log en tableaux associatifs dans tableau indexé (recup et affiche)
$responseLog = mysqli_fetch_all($queryLog, MYSQLI_ASSOC);

// askip bonne pratique
mysqli_free_result($queryLog);




include_once '../view/indexView.php';