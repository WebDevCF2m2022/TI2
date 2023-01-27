<?php

# chargement des constantes de connexion
require_once "../config.php";


# Essai de connexion
try{
    # connexion mysqli
    $dbconnect = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    # charset
    mysqli_set_charset($dbconnect,DB_CHARSET);

# capture l'erreur
}catch(Exception $e){

    # arrêter le script et afficher l'erreur
    exit(utf8_encode($e->getMessage()));

}

# si il existe les variables POST = formulaire envoyé
if(isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'] )){
    # traitement des champs contre injection SQL (Sécurité!)
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES);

if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    // l'adresse e-mail est valide, envoyez l'e-mail
} else {
    // l'adresse e-mail est invalide, ne pas envoyer l'e-mail
}
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);

    # débugage des champs traités
    // var_dump($nom,$prenom,$mail,$message);

    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if(!empty($prenom)&&!empty($mail)&&!empty($message)){
        
        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`, `lastname`, `usermail`, `message`, `datemessage`) VALUES ('$prenom','$nom','$mail','$message, '$datemess');";

        # requête avec try catch
        try{
            # requête
            mysqli_query($dbconnect,$sqlInsert);
            
            # si pas d'erreur création du texte
            $affiche ="Merci pour votre inscription";

        }catch(Exception $e){
           # echo $e->getCode();

           # avec le code erreur SQL on peut faire des erreurs différentes, idem avec le $e->getMessage() etc...
            if($e->getCode()==1406){
                # création de l'erreur
                $affiche = "Un champs est trop long";

            }elseif($e->getCode()==1062){
                # création de l'erreur
                $affiche = "Vous êtes déjà inscrit avec ce mail";
            }
            
        }


    # sinon erreur
    }else{
        # création de la variable $message
        $affiche = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }
}

// Chargement de tout les champs requis pour la DB

// Requête du MySQL
$sqlRequest = "SELECT `firstname`, `lastname`, `usermail`, `message`, `datemessage` FROM `livreor` ORDER BY `message` DESC;";

// exécution de la requête avec un try / catch
try {
    $queryMsg = mysqli_query($dbconnect, $sqlRequest);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(utf8_encode($e->getMessage()));
}


# on compte le nombres de donnée récuperé
$nbMsg = mysqli_num_rows($queryMsg);

# on convertit les données récupérés en tableaux associatifs intégrés dans un tableau indexé
$finalArr = mysqli_fetch_all($queryMsg,MYSQLI_ASSOC);



# on efface les données récupérées pas un SELECT (bonnes pratiques)
mysqli_free_result($queryMsg);
# fermeture de connexion  (bonnes pratiques)
mysqli_close($dbconnect); 

# appel de la vue
include_once '../view/indexView.php';



