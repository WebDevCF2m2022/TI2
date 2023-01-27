<?php
var_dump($_POST)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Laissez-nous un message</h1>
    <div class="agencement">
        <img id="satisfaction" src="images/Satisfaction.jpg" alt="Donnez votre avis">
        <section><!--formulaire-->
            <form name='livret' action='' method="POST">
                <div class="champs"><label for="nom">Nom*</label><input type="text" name="lastname" placeholder="Indiquez votre nom" required></div>
                <div class="champs"><label for="prenom">Prénom*</label><input type="text" name="firstname" placeholder="Indiquez votre prénom" required></div>
                <div class="champs"><label for="mailadresses">E-mail*</label><input type='email' name="usermail" placeholder="Indiquez votre e-mail" required></div>
                <div class="champs"><label for="avis">Votre avis*</label><textarea maxlength="600" name="message" placeholder="Indiquez votre avis" required></textarea></div>
                <div class="envoi"><p>(*Champs obligatoires)</p></div>
                <div class="envoi"><input id="bouton" type="button" value="Envoyer"></div>
                   
            </form>
        </section>
    </div>
</body>
</html>