<?php


// inclut les parametre de connexions
require_once "../config.php";



# Connexion avec try-catch
try{
    # connexion mysqli
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    # choix du jeux de caractère
    mysqli_set_charset($db,DB_CHARSET);

# capture l'erreur
}catch(Exception $e){

    # arrêter le script et afficher l'erreur
    exit(utf8_encode($e->getMessage()));
}


# Verifier si il existe les variables POST
if(isset($_POST['firstname'], $_POST['lastname'],$_POST['usermail'],$_POST['message'] ))
{
    # traitement des champs contre injection SQL (Sécurité!) , 
    // htmlspecialchars =  Convertit les caractères spéciaux en entités HTML
    //strip_tags = Supprime les balises HTML et PHP d'une chaîne
    //trim = Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);

    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);

    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES); 

    $msg = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);
    

    
    

    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if(!empty($prenom)&&!empty($mail)&&!empty($msg)){
        

        # insertion requete partie SQL
        $sqlInsert = "INSERT INTO `livreor` ( `firstname`, `lastname`, `usermail`, `message`) VALUES ('$prenom', '$nom', '$mail', '$msg')";
       
       
        
       
        # requête avec try catch 
        try{

            # execute la requête de la db
            mysqli_query($db,$sqlInsert);

            
            # pas d'erreur création du texte
            $message ="Merci pour votre inscription";


        }catch(Exception $e){

           # echo $e->getCode();

           $message = $e-> getMessage();


           # avec le code erreur SQL on peut faire des erreurs différentes

            if($e->getCode()==1406){

                # création de l'erreur

                $message = "Un champs est trop long";

            }elseif($e->getCode()==1062){

                # création de l'erreur

                $message = "Vous êtes déjà inscrit avec ce mail";
            }
           
        }


    # sinon erreur

    }else{
        # création de la variable $message

        $message = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }

}
else {$message = '';}

// requête en variable texte contenant du MySQL

$sqlMail = "SELECT `lastname`,`firstname`,`usermail`, `message`,`datemessage` FROM `livreor` ORDER BY `datemessage` DESC; ";

// exécution de la requête avec un try / catch

try {
    $queryMail = mysqli_query($db, $sqlMail);

}catch(Exception $e){

    # arrêter le script et afficher l'erreur (de type SQL)

    exit(utf8_encode($e->getMessage()));
}


# on compte le nombre de mails récupérés

$nombredeMail = mysqli_num_rows($queryMail);

// Récupère toutes les lignes de résultats dans un tableau associatif

$responseMail = mysqli_fetch_all($queryMail,MYSQLI_ASSOC);



# on efface les données récupérées pas un SELECT

mysqli_free_result($queryMail);

# fermeture de connexion

mysqli_close($db); 

# appel de la vue

include_once '../view/indexView.php';