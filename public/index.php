<?php
# chargement des constantes de connexion
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
$affiche ="";
$erreur="";
# si il existe les variables POST = formulaire envoyé
if(isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'] )){
    # traitement des champs contre injection SQL (Sécurité!)
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES);
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);
    $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
    if (!$mail) {
        $erreur = "L'adresse e-mail est invalide";
    } else {
    # débugage des champs traités
    // var_dump($nom,$prenom,$mail,$message);
    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if(!empty($nom)&&!empty($prenom)&&!empty($mail)&&!empty($message)){
        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`, `lastname`, `usermail`, `message`) VALUES ('$prenom','$nom','$mail','$message');";
        # requête avec try catch
        try{
            # requête
            mysqli_query($db,$sqlInsert);
            # si pas d'erreur création du texte
            $affiche ="Merci pour votre inscription";
        }catch(Exception $e){
           # echo $e->getCode();
           # avec le code erreur SQL on peut faire des erreurs différentes, idem avec le $e->getMessage() etc...
            if($e->getCode()==1406){
                # création de l'erreur
                $erreur = "Un champs est trop long";
            }elseif($e->getCode()==1062){
                # création de l'erreur
                $erreur = "Vous êtes déjà inscrit avec ce mail";
            }
        }
    # sinon erreur
    }else{
        # création de la variable $message
        $erreur = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }
}
}
# chargement de tous les mails
// requête en variable texte contenant du MySQL
$sqlRequest = "SELECT `firstname`, `lastname`, `usermail`, `message`,`datemessage` FROM `livreor` ORDER BY `datemessage` DESC;";
// exécution de la requête avec un try / catch
try {
    $queryMessage = mysqli_query($db, $sqlRequest);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(utf8_encode($e->getMessage()));
}
$nbMails = mysqli_num_rows($queryMessage);

# on convertit les mails récupérés en tableaux associatifs intégrés dans un tableau indexé
$messageUser = mysqli_fetch_all($queryMessage,MYSQLI_ASSOC);
# on efface les données récupérées pas un SELECT (bonnes pratiques)
mysqli_free_result($queryMessage);
# fermeture de connexion  (bonnes pratiques)
mysqli_close($db); 
# appel de la vue
include_once '../view/indexView.php';