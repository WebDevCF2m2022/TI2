<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/captcha.css">
    <title>Formulaire</title>
</head>
<body>
<h1 id="titre">Le livre d'or</h1>
<div class="pageflex">
<img src="img/email.png" alt="email">
<form action="" method="POST" id="formulaire">
    <h2 class="message"> Laissez-nous un message :</h2>
    <div class="conteneurChampsLabelInput">
        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname" placeholder="Votre prénom" autocomplete="given-name" maxlength="50">
    </div>
<br>
    <div class="conteneurChampsLabelInput">
        <label for="lastname">Nom :(*)</label>
        <input type="text" name="lastname" placeholder="Votre nom" autocomplete="family-name" maxlength="50">
    </div>
<br>
    <div class="conteneurChampsLabelInput">
        <label for="usermail">Adresse mail :(*)</label>
        <input type="email" name="usermail" placeholder="Votre adresse mail" autocomplete="email" maxlength="100" required>
    </div>
<br>
    <div class="conteneurChampsLabelInput">
        <label for="message" class="labelcommentaire">Commentaire :(*)</label>
        <textarea name="message" cols="50" rows="10" maxlength="600" placeholder="veuillez laissez votre commentaire ici" required>
        </textarea>
    </div>

    <h5>Champs requis (*)</h5>
    <div class="positionbouton">
    <input type="button" id="captchaValidate" value="Envoyer">
    </div>
    <br>
    <br>

    <div class="captcha">
        <p id="captcha"></p></br><br>
        <div class="positionbouton">
        <button id="captchaRefresh" type="button">Refresh</button><span></span></br>
        </div>
        <br>
        <br>
        <input id="captchaInput" type="text" placeholder="Entrez le captcha">
        
    </div>
</form>
<script src="js/captcha.js"></script>
</div>
<?php

/*<h3><?=$message?></h3>
<h3><?$messageGood?></h3>*/
if (isset($erreur)) :
    ?>
    <h4><?=$erreur?></h4>
     <?php
 elseif (isset($messageValider)) :
    ?>
    <h4><?=$messageValider?></h4>
    <?php
 endif;
if ($nbUser == 0):
?>
<h2 class="message">Pas de message précédent</h2>
<?php
elseif ($nbUser == 1):
?>
<h2 class="message">Message précédent :</h2>
<h2 class="nbMessage">Il y a un commentaire disponible</h2>
<?php
else:
?>
<h2 class="message">Messages précédents:</h2>
<h3 class="nbMessage">Il y a <?=$nbUser?> commentaires disponibles</h3>
<?php
endif;
//var_dump($_POST);
// si aucun resultat in affiche pas d adresse
if (empty($resultatRecupDB)): 
?>
    
        <h2 class="nbMessage">Pas encore de commentaire enregistré </h2>
<?php
elseif ($nbUser == 1):
?>
    <h2 class="nbMessage"> Un commentaire a été enregistré </h2>
<div id="tableau">
<?php
foreach ($resultatRecupDB as $item):
?>
    <table>
        <tr>
            <th>
                <h2 class="titreTableau">Prénom:</h2>
            </th>
            <th>
                <h2 class="titreTableau">
                    Nom:
                </h2>
            </th>
            <th>
                <h2 class="titreTableau">Adresse mail:</h2>
            </th>
        </tr>
        <tr>
            <td>
                <h3><?=$item['firstname']?></h3>
            </td>
            <td>
                <h3> <?=$item['lastname']?></h3>
            </td>
            <td>
                <h3><?=$item['usermail']?></h3>
            </td>
        <tr>
            <th colspan="2">
                <h2 class="titreTableau">Commentaire :</h2>
            </th>
            <th>
                <h2 class="titreTableau">Date :</h2>
            </th>
        </tr>
            <td colspan="2">
                <h3><?=nl2br($item['message'], ENT_QUOTES);?></h3>
            </td>
            <td>
                <h3><?=date('d-m-Y H:i:s',strtotime($item['datemessage']))?></h3>
            </td>
        </tr>
    <hr>

    </table>
<?php
        endforeach;
?>
</div>
<?php
    else:
// si on a plusieurs adresses dans la DB on boucle 
        
?>
<div id="tableau">
<?php

foreach ($resultatRecupDB as $item):

?>
    <table>
        <tr>
            <th>
                <h2 class="titreTableau">Prénom:</h2>
            </th>
            <th>
                <h2 class="titreTableau">
                    Nom:
                </h2>
            </th>
            <th>
                <h2 class="titreTableau">Adresse mail:</h2>
            </th>
        </tr>
        <tr>
            <td>
                <h3><?=$item['firstname']?></h3>
            </td>
            <td>
                <h3><?=$item['lastname']?></h3>
            </td>
            <td>
                <h3><a href="mailto:'.$item['usermail']'"><?=$item['usermail']?></a></h3>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <h2 class="titreTableau">Commentaire :</h2>
            </th>
            <th>
                <h2 class="titreTableau">Date :</h2>
            </th>
        </tr>
            <td colspan="2">
                <h3><?=nl2br($item['message'], ENT_QUOTES);?></h3>
            </td>
            <td>
                <h3><?=date('d-m-Y H:i:s',strtotime($item['datemessage']))?></h3>
            </td>
        </tr>

    </table>
<?php
        endforeach;
    
?>
</div>
<?php
           
    endif;

//var_dump($resultatRecupDB);

?>
</body>
</html>