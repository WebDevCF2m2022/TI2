<?php
// on importe le fichier config en require once car fichier important et necessaire au site on arrete le script en cas d erreur  
require_once "../config.php";

// Try catch permettant de recuperer les erreurs en cas de probleme de connexion a la DB
try {


    // Creation d un variable qui contient les donnees de connection a la DB 
    $donneeDeConnexionSql = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT );

    //var_dump($DonneeDeConnexionSql);
    //On definit les caractere
    mysqli_set_charset($donneeDeConnexionSql, DB_CHARSET);

// On capte les erreurs avec l objet d exexption $e et on les converti en UTF8
}catch(Exception $e){
    exit(mb_convert_encoding($e->getMessage(),'UTF-8', 'ISO-8859-1'));
}


// Creation d une requete qui va recuperer les donnees de la DB

// Variable qui contient la requete SQL 
$requeteRecupDonneesDB = "SELECT `firstname`,`lastname`,`usermail`,`message`,`datemessage` FROM livreor ORDER BY datemessage DESC;";


// Variable qui envoie la requete SQL a la DB abec la connexion a la DB + la requete
// On arrete le script en cas d erreur , et affiche le message 

$recupDonneesDB = mysqli_query($donneeDeConnexionSql, $requeteRecupDonneesDB) or die("Erreur de récuperation des données de la DB");

$nbUser = mysqli_num_rows($recupDonneesDB);


// On met la resultante dans un tableau associatif 
$resultatRecupDB = mysqli_fetch_all($recupDonneesDB, MYSQLI_ASSOC);
//Debugage des variables cree plus haut 
//var_dump($donneeDeConnexionSql, $requeteRecupDonneesDB, $resultatRecupDB, $recupDonneesDB);


//On traite les données recues par le formulaire avant de l envoyer dans la DB

// On verifie l'existance des variables Post envoyee par le formulaire avec un isset 

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message'])){
    // on traite les donnees utilisateur avant de les envoyer vers la DB, on enleve les espaces avec le trim , on supprime les tags html avec strip_tags, et on converti les caracteres speciaux en entites html avec html specialchars et on encode les guillemets avec ENT_QUOTES
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])), ENT_QUOTES);
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])), ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])), ENT_QUOTES);
    $texte = htmlspecialchars(strip_tags(trim($_POST['message'])), ENT_QUOTES);



    // Envoi des donnees traitee precedement 
// Je verifie que les donnes Post ne sont PAS vides et si elle sont remplie je les stock dans un variable qui contient les instructions SQL vers la DB et je filtre le champs mail qui verifie si c est bien un mail valide 
    if (!empty($nom)&&!empty($texte)&&filter_var($mail,FILTER_VALIDATE_EMAIL)):
        $envoiDesDonneesUtilisateurSql = "INSERT INTO livreor (firstname,lastname,usermail,message) VALUES ('$prenom','$nom','$mail','$texte')";
       // header("Location:./");
        // try catch qui permet la gestion des messages en cas et de reussite de l envoi ou des differentes erreurs 


        try {

            // Si la conditon precedente est validee on envoit les données a la DB avec mysqli_query
            mysqli_query($donneeDeConnexionSql, $envoiDesDonneesUtilisateurSql);
            // message en cas de reussite de l envoie du formulaire
           //ob_start();
           $messageValider = "Merci pour votre commentaire ";
           header("Refresh:3" );
           /*$to      = $mail;
           $subject = 'TI/26-01';
           $message = 'Merci pour votre inscription';
           $headers = 'From: pierre-alain.dassy@cf2m.onmicrosoft.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();*/
           //header("Location:./");
           //mail($to, $subject, $message, $headers);
           //ob_flush();

        } catch (Exception $e) {


            // Ici je vais gérer avec Exception les différentes erreurs si la condition n' est pas verifiee 
// Si un champs est trop long 
            if ($e->getCode() == 1406) {
                $erreur = "Un champs est trop long";
            }
            
        }


// Si le mail n est pas valide
    elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)):
        $erreur = "Veuillez utiliser un mail valide";
// Dans tous les autres cas ou ca n a pas envoye le formulaire
    else:
        $erreur = "Il y a eu un problème lors de votre inscription, veuillez réessayer";

    endif;
}

//var_dump($erreur, $messageValider);


include "../view/indexView.php";

mysqli_free_result($recupDonneesDB);
mysqli_close($donneeDeConnexionSql);



