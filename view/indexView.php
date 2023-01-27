<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre D'or de Jon</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/captcha">
</head>

<body>
    <h1>Livre D'or</h1>
    <div class="gros">
        <!-- logo -->
        <div class="logo">
            <img src="img/email.png">
        </div>

        <!-- formulaire -->
        <form action="" method="post">
            <div class="form-container">
                <h2>Laissez-nous un message : </h2>

                <div class="oui">
                    <label for="firstname">Prénom *</label>
                    <input type="text" name="firstname" id="firstname">
                </div>

                <div class="oui">
                    <label for="lastname">Nom</label>
                    <input type="text" name="lastname" id="lastname">
                </div>

                <div class="oui">
                    <label for="usermail">E-mail *</label>
                    <input type="email" name="usermail" id="usermail">
                </div>

                <div class="oui">
                    <label for="message">Message *</label>
                    <textarea name="message" id="message"></textarea>
                </div>

                <!-- mettre en type="button" hein -->
                <button id="captchaValidate" type="button">Envoyer</button>

                <?php
                if (isset($messageRetour)) : ?>
                    <p id="casse"><?= $messageRetour ?></p>
                <?php
                endif;
                ?>

            </div>
    </div>
    <!-- le captcha il va là -->
    <div class="cap">
        <p id="captchaOutput"></p>
        <button id="refresh" type="button">Rafraichir</button><br>
        <input id="captchaInput" placeholder="faites le captcha" type="text" />
        <span id="confirm">
            <p>Le captcha est valide!</p>
        </span>
        <span id="error">
            <p>Captach invalide!!</p>
        </span>
    </div>
    </form>

    <!-- affichage des messages -->
    <div class="message-container">
        <h2>Messages précédents : </h2>
        <?php

        // on vérifie si y'a des messages dans le LO  :
        if (empty($nbLO)) : ?>
            <div class="messages">
                <?= "il y a pas de messages ici"; ?>
            </div>

            <!-- affichage des message des la DB -->
            <?php else :
            foreach ($resultLO as $item) : ?>
                <div class="messages">
                    <a href="mailto:<?= $item['usermail'] ?>"><?= $item['firstname'] . " " . $item['lastname'] ?></a>
                    <h4><?= "a envoyé ce message le " . date("Y-m-d\ à \ H:i:s", strtotime($item['datemessage'])); ?></h4>
                    <p><?= "Message : " . $item['message']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
    <div style="margin-bottom: 2rem;"></div>
    <script src="js\captcha.js"></script>

</body>

</html>