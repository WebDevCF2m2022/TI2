<?php

// LO = livre d'or

require_once "../config.php";

// connection à la DB avec try catch
try {
    $dbLO = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT);
    mysqli_set_charset($dbLO, DB_CHARSET);
} catch (Exception $e) {

    exit(mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1'));
}

// insertion d'articles dans la DB par l'utilisateur :
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'])) {

    $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
    $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
    $usermail = htmlspecialchars(strip_tags(trim($_POST['usermail'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])), ENT_QUOTES);

    if (!empty($firstname) && filter_var($usermail, FILTER_VALIDATE_EMAIL) && !empty($message)) {

        //   requête sql de l'insertion
        $sqlInsert = "INSERT INTO `livreor` (`firstname`,`lastname`, `usermail`, `message`) VALUES ('$firstname','$lastname', '$usermail', '$message');";

        try {
            $queryInsert = mysqli_query($dbLO, $sqlInsert);
            header("Location: ./");
        } catch (Exception $e) {
            if ($e->getCode() == 1406) {
                $messageRetour = "Un champs est trop long";
            }
        }
    } else {
        if (!filter_var($usermail, FILTER_VALIDATE_EMAIL)) {
            $messageRetour = "mail pas valide";
        } else {
            $messageRetour = "il y a un problème! rééssayez!";
        }
    }
}


// recupération des messages qui sont dans la DB (nom prénom messages et date) : 
$sqlLO = "SELECT `firstname`, `lastname`, `message`, `datemessage`, `usermail`FROM `livreor` ORDER BY `datemessage` DESC;";


try {
    $queryLO = mysqli_query($dbLO, $sqlLO);
} catch (Exception $e) {

    exit(mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1'));
}
$nbLO = mysqli_num_rows($queryLO);
$resultLO = mysqli_fetch_all($queryLO, MYSQLI_ASSOC);



// on ferme la DB derrière nous parce qu'on est poli :
mysqli_free_result($queryLO);
mysqli_close($dbLO);

// affichage de la vue :
include_once '../view/indexView.php';
