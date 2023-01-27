 
			function captchaAna(callback, captchaLen) {
				function randomInt(min, max) {
					return Math.floor(Math.random() * (max - min + 1) + min)
				}
				
				// Retourne un array du element 
				function getElementsFromArray(array, numberOfElements) {
					let arrayOfElements = [];
					for (let i = 0; i < numberOfElements; i++) {
						let randomElement = array[randomInt(0, array.length - 1)];
						arrayOfElements.push(randomElement);
					}
					return arrayOfElements
				}
				
				// Vide le contenu et insere un nouveau captcha
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

				// on verifie le captcha de user c'est valide si non on genere un autre 
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
                        // pour avoir pas contrast on commence de 21
						arrayRGB.push(randomInt(21, 255));
					}
					// randomInt(min, max de coleur)
					return arrayRGB
				}

				// Génère un nombre décimal afin d'être utilisé en tant que valeur de 2em et 3em 
				function randomSize() {
					return randomInt(20, 28) / 10
				}
			
                // toute sauf les : C,O ,V,W,X,Z ,i , 0  comme dans les consigne 
				const allCharacters = ['A', 'B', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'Y',  'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
				const captcha = document.querySelector('#captcha');
				const captchaInput = document.querySelector('#captchaInput');
				const captchaValidate = document.querySelector('#captchaValidate');
				const captchaRefresh = document.querySelector('#captchaRefresh');

				generateCaptcha(captchaLen);
				captchaValidate.addEventListener('click', validateCaptcha);
				captchaRefresh.addEventListener('click', generateCaptcha);
			}

			function redirectionSubmit() {
				
				document.querySelector("#monFormulaire").requestSubmit(); // Envoyer un formulaire
			}

			captchaAna(redirectionSubmit, 7); 