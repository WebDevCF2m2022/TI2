<?php

# chargement des constantes de connexion
require_once "../config.php";

# Essai de connexion
try {
    # connexion mysqli
    $db = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT);
    # charset
    mysqli_set_charset($db, DB_CHARSET);

    # capture l'erreur
} catch (Exception $e) {

    # arrêter le script et afficher l'erreur
    exit(utf8_encode($e->getMessage()));
}

# si il existe les variables POST = formulaire envoyé
if (isset($_POST['firstname'], $_POST['usermail'], $_POST['message'])) {
    # traitement des champs contre injection SQL (Sécurité!)
    $nom = htmlspecialchars(strip_tags(trim($_POST['firstname'])), ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])), ENT_QUOTES);
    // on pourrait vérifier si c'est un mail valide ( filter_var voir la fonction sur php.net)
    $mess = htmlspecialchars(strip_tags(trim($_POST['message'])), ENT_QUOTES);
    # débugage des champs traités
    // var_dump($nom,$mail);

    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if (!empty($nom) && !empty($mail)) {

        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`firstname`,`usermail`,`message`) VALUES ('$nom','$mail', '$mess');";

        # requête avec try catch
        try {
            # requête
            mysqli_query($db, $sqlInsert);

            # si pas d'erreur création du texte
            $message = "Laissez-nous un message";
        } catch (Exception $e) {
            # echo $e->getCode();

            # avec le code erreur SQL on peut faire des erreurs différentes, idem avec le $e->getMessage() etc...
            if ($e->getCode() == 1406) {
                # création de l'erreur
                $message1 = "Pas encore de message";
            } elseif ($e->getCode() == 1062) {
                # création de l'erreur
                $message2 = "Vous êtes déjà inscrit avec ce mail";
            }
        }


        # sinon erreur
    } else {
        # création de la variable $message
        $message = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }
}

# chargement de tous les mails

// requête en variable texte contenant du MySQL
$sqlMail = "SELECT `firstname`, `usermail`, `message` FROM `livreor` ORDER BY `datemessage` DESC; ";

// exécution de la requête avec un try / catch
try {
    $queryMail = mysqli_query($db, $sqlMail);
} catch (Exception $e) {
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(utf8_encode($e->getMessage()));
}


# on compte le nombre de mails récupérés
$nbMail = mysqli_num_rows($queryMail);

# on convertit les mails récupérés en tableaux associatifs intégrés dans un tableau indexé
$responseMail = mysqli_fetch_all($queryMail, MYSQLI_ASSOC);



# on efface les données récupérées pas un SELECT (bonnes pratiques)
mysqli_free_result($queryMail);
# fermeture de connexion  (bonnes pratiques)
mysqli_close($db);

# appel de la vue
include_once '../view/indexView.php';
