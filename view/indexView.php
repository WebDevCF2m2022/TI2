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

        <div class="formulaire">
            <?php
            # si on a un message
            if (isset($message)) :
                # on l'affiche
            ?>
                <h4><?= $message ?></h4>
            <?php
            endif;
            ?>
            <form id='monFormulaire' name='lemail' action='' method="POST">

                <div class="row">
                    <div class="col-25">
                        <label for="firstname">Prénom *:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="name" name="firstname" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="nom">Nom :</label>

                    </div>
                    <div class="col-75">
                        <input type="text" id="nom" name="lastname">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="email"> mail *:</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="mail" name="usermail" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="msg">Votre message *:</label>
                    </div>

                    <div class="col-75">
                        <textarea id="msg" name="message" cols="60" rows="5" maxlength="600"></textarea>
                    </div>
                </div>
             
                <p class="p1">(*) ce champ est obligatoire</p>
                <div class="row">
                    <div class="submit">
                        <button id="captchaValidate" type="button">Valider</button>
                    </div>
                </div>

            </form>


        </div>

        <div>
            <p id="captcha"></p></br></br>
            <input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>

            <button id="captchaRefresh" type="button">Refresh</button>
        </div>
        <h3></h3>
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
                    <p class="p2"><?=$item['message']?></p>
                    <?php
                    if (empty($mess)) :
                    ?>
                        <h3><?= $message1 ?></h3>
                    <?php
                    endif;
                    ?>
                </div>

        <?php
            endforeach;
        endif;
        ?>

    </header>

</body>

</html>