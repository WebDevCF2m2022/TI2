<?php
# débugogage de la variable POST
// var_dump($_POST);   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <link href='css/style.css' rel='stylesheet' />
    <link href='css/captcha.css' rel='stylesheet' />
    <script src="js/captcha.js"></script>
</head>

<body onload="captchaCF2M(redirectionDuckduck, 7);">

    <header id="header">
        <h1>Livre d'or</h1>
        <img src="../public/img/email.png" alt="">

        <div class="container">
            <?php
            # si on a un message
            if (isset($message)) :
                # on l'affiche
            ?>

            <?php
            endif;
            ?>
            <form id="monFormulaire" action="" method="POST">
                <h4><?= $message ?></h4>
                <div class="row">
                    <div class="col-25">
                        <label for="firstname">Prénom :</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="firstname" placeholder="votre prénom..">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="lastname">Nom :</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="lastname" placeholder="votre nom..">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="usermail">mail :</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="usermail" placeholder="entrer votre email">
                    </div>
                </div>


                <div class="row">
                    <div class="col-25">
                        <label for="message">message :</label>
                    </div>
                    <div class="col-75">
                        <textarea id="subject" name="message" placeholder="entrer votre message ici.." style="height:200px"></textarea>
                    </div>
                </div>
                <p>(*) Ce champ est obligatoire</p>
                <div class="row">
                    <input type="submit" value="Submit">
                </div>

        </div>
        </form>
        </div>

        <p id="captcha"></p></br></br>
        <button id="captchaRefresh" type="button">Refresh</button>
        <input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>
        </form>
        </div>

        </div>
        <h3>Les mails</h3>
        <?php
        # pas de mail
        if (empty($nbMail)) :
        ?>

        <?php
        # on a au moins un mail
        else :
            # affichage du nombre de mail
        ?>
            <h4>Nous avons <?= $nbMail ?> messages inscrites</h4>
            <?php
            # tant qu'on a des mail
            foreach ($responseMail as $item) :
            ?>
                <div class="text">
                    <h4><?= $item['firstname'] ?> à envoyé le message le <?= $item['datemessage'] ?></h4>
                    <p><?= $item['message'] ?></p>
                </div>


        <?php
            endforeach;
        endif;
        ?>



    </header>

</body>

</html>