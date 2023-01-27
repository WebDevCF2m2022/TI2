
const redirection = () => { document.location = "https://duckduckgo.com/"; }

const captchaHome = (callback, captchaLength) => {

    /* TIRAGE AU SORT (/* récupération sous forme d'un array) */
    const pickAtRandom = (list, tirages=1) => {
        let res = [];
        for (let i=0; i<tirages; i++){
            res.push( list[Math.floor(Math.random() * list.length)] );
        }
        return res;
    }

    /* RÉINITIALISATION ...0.0*/
    const emptyFields = () => {
        captchaInput.value = "";
        captcha.innerHTML = "";
    }
    /* MISE SOUS FORME DE STRING ET INSERTION DANS LE HTML */
    const putCaptchaInPlace = (lettersList) => {
        for (let i=0; i<lettersList.length; i++){
            captcha.insertAdjacentHTML('beforeend', `<span class="spe-${pickAtRandom(allCharacters, 1)} spe-${pickAtRandom(allCharacters, 1)}">${lettersList[i]}</span>`);
        }
    }

    /* LA SUITE DE CARACTÈRES */
    const generateCaptcha = () => {
        emptyFields();
        let captchArray = pickAtRandom(allCharacters, captchaLength);
        putCaptchaInPlace(captchArray);
    };

    /* VALIDATION */
    const validateCaptcha = () => {
        captcha.textContent === captchaInput.value && !!captchaInput.value ? callback() : generateCaptcha(captchaLength);
    }

    /* DÉCLARATION ET CONSTANTES */
    const allCharacters = ['A', 'B', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'Y', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    const captcha = document.querySelector('#captcha');
    const captchaInput = document.querySelector('#captchaInput');
    const captchaValidate = document.querySelector('#captchaValidate');
    const captchaRefresh = document.querySelector('#captchaRefresh');

    /* AJOUT DES ÉCOUTEURS D'ÉVÉNEMENTS*/
    captchaValidate.addEventListener('click', validateCaptcha);
    //captchaRefresh.addEventListener('click', generateCaptcha);

    /* LANCEMENT AU CHARGEMENT */
    generateCaptcha(captchaLength);

}

// captchaHome(redirection,7);