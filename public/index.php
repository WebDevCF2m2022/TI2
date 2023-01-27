<?php
# lien avec les paramètres de connexion
require_once "../config.php";


# tentative de connexion
try{
    # connexion mysqli contenu dans config.php
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    # charset
    mysqli_set_charset($db,DB_CHARSET);

# capture l'erreur en cas d'erreur
}catch(Exception $e){

    # arrêter le script et afficher l'erreur
    exit(mb_convert_encoding($e->getMessage(),'UTF-8','ISO-8859-1'));

}

# Verifie si les variables POST ont été entrées par l'utilisateur
if(isset($_POST['firstname'], $_POST['usermail'], $_POST['message'] )){
    # Securisation des données qui seront encodées par l'utilisateur
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $mail = filter_var($_POST['usermail'], FILTER_SANITIZE_EMAIL);
    $msge = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);
    # débugage des champs traités ($prenom, $nom, $mail, $msge)
    // var_dump($nom,$mail,$msge,$prenom);

    # Verifie si les champs sont remplis et filtre les mails valides/invalides à l'aide de filter_var. possibilité envoyé le nom ou pas dans la base de donnée sql
    if((!empty($prenom)&&!empty($mail)&&!empty($msge)&&(filter_var($mail,FILTER_VALIDATE_EMAIL)))||(!empty($prenom)&&!empty($nom)&&!empty($mail)&&!empty($msge)&&(filter_var($mail,FILTER_VALIDATE_EMAIL)))){
        
        # variable d'insertion qui s'effectue si le try est validé par les variables
        $sqlInsert = "INSERT INTO `livreor` (`firstname`,`usermail`,`lastname`,`message`) VALUES ('$prenom','$mail','$nom','$msge');";

        # pour ne pas re-envoyé, re-inseré la dernière requête de l'utilisateur en cas de refresh vers la db
        header("Location: ./");

        # requête try catch
        try{
            # requête
            mysqli_query($db,$sqlInsert);
            
            # si pas d'erreur
            $reponse ="Votre message a bien été enregisté, merci.";

        }catch(Exception $e){

            if($e->getCode()==1406){
                # création de l'erreur
                $reponse = "Un champs est trop long.";

            }elseif($e->getCode()==1062){
                # création de l'erreur
                $reponse = "Vous êtes déjà inscrit avec ce mail";
            }
            
        }


    # si erreur
    }else{
        # création de la variable $reponse que l'on retrouve dans la vue
        $reponse = "Il y a eu un problème lors de l'enregistrement de votre message, veuillez réessayer.";
    }

}

# chargement de tous les messages du livre d'or

// requête en variable texte contenant du MySQL
$sqlMessage = "SELECT `firstname`, `lastname`, `usermail`, `message`, `datemessage` FROM `livreor` ORDER BY `datemessage` DESC; ";

try {
    $queryMessage = mysqli_query($db, $sqlMessage);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(mb_convert_encoding($e->getMessage(),'UTF-8','ISO-8859-1'));
}


# compteur de messages sauvés dans $quantMessages à l'aide de mysqli_num_rows
$quantMessages = mysqli_num_rows($queryMessage);

# on convertit les messages récupérés en tableaux associatifs intégrés dans un tableau indexé
$responseMessag = mysqli_fetch_all($queryMessage,MYSQLI_ASSOC);



# on efface les données récupérées par le "SELECT.." précédent (bonnes pratiques)
mysqli_free_result($queryMessage);
# fermeture de connexion (bonnes pratiques)
mysqli_close($db); 

# on appel de la vue
include_once '../view/indexView.php';

