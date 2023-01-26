<?php

// LO = livre d'or

require_once "../config.php";

// connection à la DB avec try catch
try{
    $dbLO = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT);
    mysqli_set_charset($dbLO, DB_CHARSET);
    
}catch(Exception $e){
    
    exit(mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1'));
    
}

// insertion d'articles dans la DB par l'utilisateur :
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'])) {

    $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
    $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
    $usermail = htmlspecialchars(strip_tags(trim($_POST['usermail'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])), ENT_QUOTES);


    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if (!empty($firstname) && !empty($lastname) && filter_var($usermail,FILTER_VALIDATE_EMAIL) &&!empty($message)) {

        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`,`lastname`, `usermail`, `message`) VALUES ('$firstname','$lastname', '$usermail', '$message');";

        try{

            mysqli_query($dbLO, $sqlInsert);
            $messageRetour = "t'es bien inscrit copain!";

        }catch(Exception $e){

            if($e->getCode()==1406){
                # création de l'erreur
                $message = "Un champs est trop long";

            }elseif($e->getCode()==1062){
                # création de l'erreur
                $message = "Vous êtes déjà inscrit avec ce mail";
            }
        }
    }else{
         if(!filter_var($usermail,FILTER_VALIDATE_EMAIL)){
            $messageRetour = "mail pas valide";
        }else{
            $messageRetour = "il y a un problème! rééssayez!";
        }
    }
}

// recupération des messages qui sont dans la DB (nom prénom messages et date) : 
$sqlLO = "SELECT `firstname`, `lastname`, `message`, `datemessage` FROM `livreor` ORDER BY `datemessage` DESC;";
$queryLO = mysqli_query($dbLO, $sqlLO);
$nbLO = mysqli_num_rows($queryLO);
$resultLO = mysqli_fetch_all($queryLO, MYSQLI_ASSOC);


// on ferme la DB derrière nous parce qu'on est poli :
mysqli_free_result($queryLO);
mysqli_close($dbLO);

// affichage de la vue :
include_once '../view/indexView.php';
