<?php

require_once "../config.php";
# Essai de connexion
try{
    # connexion mysqli
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    # charset
    mysqli_set_charset($db,DB_CHARSET);

# capture l'erreur
}catch(Exception $e){

    # arrêter le script et afficher l'erreur
    exit(utf8_encode($e->getMessage()));

}

# si il existe les variables POST = formulaire envoyé
if(isset($_POST['firstname'], $_POST['lastname'],$_POST['usermail'] ,$_POST['message'] )){
    # traitement des champs contre injection SQL (Sécurité!)
    $nom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $prenom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES);
    $mess = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES); 
    
    
    
    
    # débugage des champs traités
    var_dump($nom,$mail,$prenom,$mess);

    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if(!empty($nom)&&!empty($prenom)&&!empty($mail)&&!empty($mess)){

        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`,`lastname`,`usermail`,`message`) 
                        VALUES ('$nom','$prenom','$mail','$mess');";
var_dump($sqlInsert);
        # requête avec try catch
        try{
            # requête
            mysqli_query($db,$sqlInsert);

            # si pas d'erreur création du texte
            $message ="Merci pour votre message";

        }catch(Exception $e){
           # echo $e->getCode();

           # avec le code erreur SQL on peut faire des erreurs différentes, idem avec le $e->getMessage() etc...
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

# chargement de tous les messages

// requête en variable texte contenant du MySQL
$sqlMess = "SELECT `firstname`, `lastname`,`usermail`,`message`,`datemessage` FROM `livreor` ORDER BY `datemessage` DESC; ";

// exécution de la requête avec un try / catch
try {
    $queryMess= mysqli_query($db, $sqlMess);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(utf8_encode($e->getMessage()));
}


# on compte le nombre de mails récupérés
$nbMess= mysqli_num_rows($queryMess);

# on convertit les mails récupérés en tableaux associatifs intégrés dans un tableau indexé
$repMess = mysqli_fetch_all($queryMess,MYSQLI_ASSOC);



# on efface les données récupérées pas un SELECT (bonnes pratiques)
mysqli_free_result($queryMess);
# fermeture de connexion  (bonnes pratiques)
mysqli_close($db); 

# appel de la vue
include_once '../view/indexView.php';
