<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre D'or de Jon</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- titre -->
    <h1>Travail</h1>
    <!-- formulaire utilisateur -->
    <form action="" method="post">
        <input type="text" name="firstname" id="firstname" placeholder="prénom">
        <input type="text" name="lastname" id="lastname" placeholder="nom de famille">
        <input type="mail" name="usermail" id="usermail" placeholder="email">
        <textarea name="message" id="message" cols="30" rows="10" placeholder="votre texte"></textarea>

        <!-- mettre en type="button" hein -->
        <button type="submit">envoyer</button>
    </form>
    <?php
    if (isset($messageRetour)) : ?>
        <?= $messageRetour ?>
    <?php
    endif;
    ?>
    <!-- a enlever -->
    <hr>
    <div style="padding: 5rem;"></div>



    <div class="message-affiche">
        <?php
        // var_dump($resultLO);

        // on vérifie si y'a des messages dans le LO et on affiche combien y'en a si y'en a :

        if (empty($nbLO)) : ?>
            <?= "il y a pas de messages ici"; ?>
            <?php else :
            if ($nbLO == 1) : ?>

                <p><?= "il y a " . $nbLO . " adresse"; ?></p>
            <?php else : ?>
                <p><?= "il y a " . $nbLO . " adresses"; ?></p>
            <?php endif; ?>
            <?php foreach ($resultLO as $item) : ?>
                <p><?= $item['firstname']; ?></p>
                <p><?= $item['lastname']; ?></p>
                <p><?= $item['message']; ?></p>
                <p><?= $item['datemessage']; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- affichage des éléments des la DB -->

    </div>

</body>

</html>