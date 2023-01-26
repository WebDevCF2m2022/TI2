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
    <h1>Livre D'or</h1>

    <!-- formulaire utilisateur -->
    <div class="logo">
        <img src="img/email.png">
    </div>

    <!-- formulaire -->
    <form action="" method="post">
    <div class="form-container">
        <?php
            if (isset($messageRetour)) : ?>
                <p><?= $messageRetour ?></p>
            <?php
            endif;
            ?>
            <h2>Laissez-nous un message : </h2>
            <label for="firstname">Prénom *</label><input type="text" name="firstname" id="firstname">
            <label for="lastname">Nom</label><input type="text" name="lastname" id="lastname">
            <label for="usermail">E-mail *</label><input type="email" name="usermail" id="usermail">
            <label for="message">Message *</label><textarea name="message" id="message"></textarea>
            
            <!-- mettre en type="button" hein -->
            <button id="captchaValidate" type="button">Envoyer</button>
        </div>

        <div class="cap">
            <p id="captchaOutput"></p>
            <button id="refresh" type="button">Rafraichir</button><br>
            <input id="captchaInput" placeholder="faites le captcha" type="text" />
            <span id="error"><p>ERREUR</p></span>
        </div>

    </form>

    <div class="message-container">
        <h2>Messages précédents : </h2>
        <?php
        // on vérifie si y'a des messages dans le LO et on affiche combien y'en a si y'en a :

        if (empty($nbLO)) : ?>
            <?= "il y a pas de messages ici"; ?>
            <?php else :

                foreach ($resultLO as $item) : ?>
                <div class="messages">
                    <h4><?= $item['firstname'] . " " . $item['lastname'] . " a envoyé ce message le " . $item['datemessage']; ?></h4>
                    <p><?= "Message : " . $item['message']; ?></p>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- affichage des éléments des la DB -->
    </div>
    <script src="js\captcha.js"></script>

</body>

</html>