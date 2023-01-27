<?php

require_once "../config.php";

try{
    # connexion mysqli
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    # charset
    mysqli_set_charset($db,DB_CHARSET);

# capture l'erreur
}catch(Exception $e){

    # arrêter le script et afficher l'erreur
    exit(($e->getMessage()));   //utf8_encode déprécié

}

//adaptation faites à deux avec A-M
if(isset($_POST['firstname'], $_POST['usermail'] )){
    # traitement des champs contre injection SQL (Sécurité!)
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES); // on pourrait vérifier si c'est un mail valide ( filter_var voir la fonction sur php.net)
    $msgUser = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);
    # débugage des champs traités
  //  var_dump($prenom);
  //  var_dump($nom);
  //  var_dump($mail);
  //  var_dump($msgUser);
 
  # si les champs sont bons
    if(!empty($prenom)&&!empty($mail)){
        
        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`, `lastname`, `usermail`, `message`, `datemessage`) VALUES ('$prenom', '$nom', '$mail', '$msgUser', current_timestamp());";
       // var_dump($sqlInsert);
        
       # requête avec try catch
        try{
            # requête
            mysqli_query($db,$sqlInsert);
            
            # si pas d'erreur création du texte
            $message ="Merci pour votre inscription";

        }catch(Exception $e){
           
           # avec le code erreur SQL on peut faire des erreurs différentes, idem avec le $e->getMessage() etc...
            if($e->getCode()==1406){
                # création de l'erreur
                $message = "Un champs est trop long";

            }elseif($e->getCode()==1062){
                # création de l'erreur
                $message = "Vous êtes déjà inscrit avec ce mail";
            }
            
        }
    }else{
        $message = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }

}

# chargement de tous les mails

// requête en variable texte contenant du MySQL
$sqlMail = "SELECT * FROM `livreor` ORDER BY `datemessage` DESC; ";

// exécution de la requête avec un try / catch
try {
    $queryMail = mysqli_query($db, $sqlMail);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(($e->getMessage()));    //utf8_encode déprécié
}


# on compte le nombre de mails récupérés
$nbMail = mysqli_num_rows($queryMail);

# on convertit les mails récupérés en tableaux associatifs intégrés dans un tableau indexé
$responseMail = mysqli_fetch_all($queryMail,MYSQLI_ASSOC);



# on efface les données récupérées pas un SELECT (bonnes pratiques)
mysqli_free_result($queryMail);
# fermeture de connexion  (bonnes pratiques)
mysqli_close($db); 

# appel de la vue
include_once '../view/indexView.php';