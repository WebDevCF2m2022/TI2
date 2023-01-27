
				const allCharacters = ['A', 'B', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'Y', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
				const captcha = document.querySelector('#captcha');
				const captchaInput = document.querySelector('#captchaInput');
				const captchaValidate = document.querySelector('#captchaValidate');
				const captchaRefresh = document.querySelector('#captchaRefresh');

			// Fonction qui génère un captcha 
			function captchaLivreOr(callback, captchaLen) {
				function randomInt(min, max) {
					return Math.floor(Math.random() * (max - min + 1) + min)
				}
				
				// Retourne un array contenant les éléments tiré au hasard
				function getElementsFromArray(array, numberOfElements) {
					let arrayOfElements = [];
					for (let i = 0; i < numberOfElements; i++) {
						let randomElement = array[randomInt(0, array.length - 1)];
						arrayOfElements.push(randomElement);
					}
					return arrayOfElements
				}
				
				// Vide le contenu pour réinsérer un nouveau captcha
				function generateCaptcha() {
					captcha.innerHTML = "";
					captchaInput.value = ""; 

					let captchaArray = getElementsFromArray(allCharacters, captchaLen);
					for (let i = 0; i < captchaArray.length; i++) {
						let colors = randomRGB();
						let size = randomSize();
						captcha.insertAdjacentHTML('beforeend', `<span style="color: rgb(${colors[0]}, ${colors[1]}, ${colors[2]}); font-size: ${size}em">${captchaArray[i]}</span>`);
					}
				}

				// Vérifie si la valeur de l'user correspond au captcha et appelle le callback sinon génère un nouveau captcha
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
					return randomInt(20, 30) / 10
				}
				generateCaptcha(captchaLen);
				captchaValidate.addEventListener('click', validateCaptcha);
				captchaRefresh.addEventListener('click', generateCaptcha);
			}

			function envoisForm() {
				document.querySelector("#monFormulaire").requestSubmit(); // Envois du formulaire
			}

			captchaLivreOr(envoisForm, 7);