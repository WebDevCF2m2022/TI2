<?php
/*var_dump($_POST)*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href='css/style.css' rel='stylesheet' />
    <link href='css/captcha.css' rel='stylesheet' />
    <script src="js/captcha.js" defre ></script>
    <title>Livre d'or TI2</title>
</head>
<body>
    <h1>Livre d'or </h1>
    <?php
        #si on a un message 
        if(isset($message)):
        #on l'afficher
        ?>
        <h4><?=$message?></h4>
        <?php
        endif; 
          ?>
    <img src="../img/email.png" alt="email">
    <form action="" method="POST" class="formulaire" name="lemail" id="monFormulaire">
         <h3>Laissez-nous un message</h3>
         <div class=form>
        <div class="login">
            Prénom *:<input type="text" name="firstname" class="logpre" require>
         </div>
         <div class="login">
            Nom     :<input type="text" name="lastname" class="lognom" >
            </div>
         <div class="login">
            E-Mail *:<input type="email" name="usermail" class="logmail"require>
         </div>   
         <div class="message">
            Message*:<input type="text" name="message" class="logmsg"require>
         </div> 
           <h3 class=oblig>(*) Ce champ est obligatoire </h3>
        <div class="button">
        <button id="captchaValidate" type ="button" >Envoyer</button>
        </div>
    </div>
    <div class=bordcaptcha>
			<p id="captcha"></p></br></br>
            
			<input id="captchaRefresh" type="button" value="Refresh"><br>

			<input id="captchaInput" type="text" placeholder="Entrez le captcha" require>
            <div><span></span></br></br></div>
<!-- je change avec input pour avoir le button submit aussi 
			<button id="captchaValidate" type ="button">Valider</button>
			<button id="captchaRefresh" type="button">Refresh</button>-->
          
		</div>
     </form>
   
     <?php
          #pas de e-mail
           if(empty($nbMail)):
        ?>
<h4>Pas encore de nombre <?=$nbMail?> d'adresses inscrites </h4>
        <?php
         # on a au moins un mail 
         else:
            #tant que on a des mail
         foreach ( $reposeMail  as $item):
            ?>

 <div class="messageUser">
    <?= $item['firstname']?>
    <?=$item['lastname']?>
    <?=$item['usermail']?>
    <?=$item['datemessage']?>
 <br>
 <div class=messageTest><?=$item['message']?></div>
    </div>
        <?php
        endforeach; 
        endif; 
        ?>
     <style>
.messageUser{
    border: solid 2px #000;
    border-radius: 10px;
    width: 400px;
    height: auto;
    margin: 7px 7px;
    margin-right: 10px;
    padding: 10px;
}
.messageTest{
    width:300px;
    height: auto;
   
}
 /**pour captcha */
  .bordcaptcha{
    position: absolute;
    top: 722px;
    left: 789px;
    border: 2px solid #d3d3d3;
    background: #eadab3;
  }
    
 #captcha {
            -webkit-user-select: none; /* Safari */
            -ms-user-select: none; /* IE 10+ */
            user-select: none;
        
            background-color: black;
            display: inline;
            padding: 0.8em;
            border-radius: 5px;
            width: 181px;
        }
        
        .invalidCaptcha {
            border: solid 2px red;
            border-radius: 3px;
        }
        
        .invalidCaptcha + span::after {
            content: "captcha invalide";
            color: red;
            font-size: 2.7em;
            font-style: italic;
            padding-left: 5px;
        }
        
        .validCaptcha {
            border: solid 2px green;
            border-radius: 3px;
        }
        
        .validCaptcha + span::after {
            content: "vérification réussie";
            color: green;
            font-size: 2.7em;
            font-style: italic;
            padding-left: 5px;
        }
        </style>
        <script>
            /* Fonction qui génère un captcha qui sera inséré dans un élément avec l'id "captcha"
			et qui nécessite un callback qui sera appellé lorsqu'le captcha	est validé ainsi qu'une
			longueur de captcha pour la génération */
			function captchaCF2M(callback, captchaLen) {
				function randomInt(min, max) {
					return Math.floor(Math.random() * (max - min + 1) + min)
				}
				
				// Retourne un array contenant autant d'élements venant de "array" que "numberOfElements"
				function getElementsFromArray(array, numberOfElements) {
					let arrayOfElements = [];
					for (let i = 0; i < numberOfElements; i++) {
						let randomElement = array[randomInt(0, array.length - 1)];
						arrayOfElements.push(randomElement);
					}
					return arrayOfElements
				}
				
				// Vide le contenu de l'élément avec l'id "captcha" et y insère un nouveau captcha
				function generateCaptcha() {
					captcha.innerHTML = "";
					captchaInput.value = ""; 

					let captchaArray = getElementsFromArray(allCharacters, captchaLen);
					for (let i = 0; i < captchaArray.length; i++) {
						let colors = randomRGB(); //
						let size = randomSize();
						captcha.insertAdjacentHTML('beforeend', `<span style="color: rgb(${colors[0]}, ${colors[1]}, ${colors[2]}); font-size: ${size}em">${captchaArray[i]}</span>`);
					}
				}

				// Vérifie si l'entrée utilisateur correspond au captcha et appelle le callback sinon génère un nouveau captcha
				function validateCaptcha() {
					if (captcha.textContent === captchaInput.value) {
						captchaInput.classList.remove("invalidCaptcha");
						captchaInput.classList.add("validCaptcha");
						callback();
					} else {
						captchaInput.classList.add("invalidCaptcha");
						generateCaptcha(captchaLen);
					}
				}

				function randomRGB() {
					let arrayRGB = [];

					for (let i = 0; i < 3; i++) {
						arrayRGB.push(randomInt(21, 255));
					}
					// randomInt(min, max)
					return arrayRGB
				}

				// Génère un nombre décimal afin d'être utilisé en tant que valeur de em
				function randomSize() {
					return randomInt(10, 18) / 10
				}
			
				const allCharacters = ['A', 'B', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'Y',  'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
				const captcha = document.querySelector('#captcha');
				const captchaInput = document.querySelector('#captchaInput');
				const captchaValidate = document.querySelector('#captchaValidate');
				const captchaRefresh = document.querySelector('#captchaRefresh');

				generateCaptcha(captchaLen);
				captchaValidate.addEventListener('click', validateCaptcha);
				captchaRefresh.addEventListener('click', generateCaptcha);
			}

			function redirectionDuckduck() {
				
				document.querySelector("#monFormulaire").requestSubmit(); // Envoyer un formulaire
			}

			captchaCF2M(redirectionDuckduck, 7)
            </script>

</body>
</html>