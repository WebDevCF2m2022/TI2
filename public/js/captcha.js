function capTI(callback, min = 6, max = 6) {
	
	function randomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1) + min);
	}

	function generateCaptchaArray(arr) {
		nb = randomInt(min, max);
		let cap = [];
		for (let i = 0; i < nb; i++) {
			x = Math.floor(Math.random() * arr.length);
			cap.push(arr[x]);
		}
		return cap;
	}

	function generateCaptcha() {
		capOut.innerHTML = "";
		capIn.value = "";
		let capcap = generateCaptchaArray(alphabet);
		for (let i = 0; i < capcap.length; i++) {
			let colorsRandom = randRGB();

			let size = randSize(20, 30);

			capOut.insertAdjacentHTML(
				"beforeend",
				`<span style="color:rgb(${colorsRandom[0]},${colorsRandom[1]},${colorsRandom[2]});font-size:${size}rem;">${capcap[i]}</span>`
			);
		}
	}

	
	function validateCaptcha() {
		if (capOut.textContent == capIn.value) {
			if(error.className == "invalid"){
				capIn.style.border = "3px solid green"
				error.classList.remove("invalid");
				confirm.classList.add("valid");
				setTimeout (callback, 3000);
			}else{
				capIn.style.border = "3px solid green"
				confirm.classList.add("valid");
				setTimeout (callback, 3000);
			}
		} else {
			generateCaptcha();
			capIn.style.border = "3px solid red"
			error.classList.add("invalid");
		}
	}
	
	function refreshCaptcha(){
		if(error.className == "invalid"){
			error.classList.remove("invalid");
			capIn.style.border = "1px solid black"
			generateCaptcha()
		}else{	
			generateCaptcha();
		}
	}

	//choisir couleur randow
	function randRGB() {
		let arrayRGB = [];
		for (let i = 0; i < 3; i++) {
			arrayRGB.push(randomInt(20, 230));
		}
		return arrayRGB;
	}

	//choisir taille random
	function randSize(randMin = 10, randMax = 10) {
		return randomInt(randMin, randMax) / 10;
	}

	const alphabet = ["a","b","c","d","e","f","g","h","i","j","k","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","D","E","F","G","H","I","J","K","L","M","N","P","Q","R","S","T","U","W","Y","1","2","3","4","5","6","7","8","9"]

	let capOut = document.querySelector("#captchaOutput");
	let capIn = document.querySelector("#captchaInput");
	let capValid = document.querySelector("#captchaValidate");
	let refresh = document.querySelector("#refresh");
	let error = document.querySelector('#error')
	let confirm = document.querySelector('#confirm')
	


	generateCaptcha();
	capValid.addEventListener("click", validateCaptcha);
	refresh.addEventListener("click", refreshCaptcha);

}

function soumission() {
	document.querySelector('form').requestSubmit(); 
}

capTI(soumission, 7, 7);


