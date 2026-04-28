let titolo = document.getElementById("titolo");
let weightStatus = document.getElementById("weightStatus");

function _getCurrentWeightStatus() {
    const titolo = document.getElementById("titolo");
    const weightStatus = document.getElementById("weightStatus");

    if (!titolo || !weightStatus) {
        console.log("titolo o weightStatus non trovato");
        return;
    }

    const currentWeight = getComputedStyle(titolo).fontWeight;
    const textContent = currentWeight == "700" || currentWeight == "bold" ? "Bold" : "Normal";

    weightStatus.style.fontWeight = textContent.toLowerCase();
    weightStatus.textContent = textContent;
}

function toggleBold() {
    const titolo = document.getElementById("titolo");

    if (!titolo) {
        console.log("Elemento titolo non trovato");
        return;
    }

    if (titolo.style.fontWeight == "bold") {
        titolo.style.fontWeight = "normal";
    } else {
        titolo.style.fontWeight = "bold";
    }

    _getCurrentWeightStatus();
}

function cambiaColore() {
    titolo.style.color = "blue";
    titolo.style.backgroundColor = "red";
}

function cambiaColorePicker() {
    const colore = document.getElementById("colorPicker").value;

    console.log(colore);

    titolo.style.color = colore;
}

function cambiaFontSize() {
    const fontSize = document.getElementById("fontSize").value;
    if (Number.isNaN(fontSize)) {
        console.log("Inserisci un numero");
        return;
    }
    titolo.style.fontSize = fontSize + "px";
}

function cambiaFontSizeUp() {
    const fontSize = parseInt(getComputedStyle(titolo).fontSize);
    titolo.style.fontSize = (fontSize + 1) + "px";
    _updateFontSizeInput(fontSize + 1);
}

function cambiaFontSizeDown() {
    const fontSize = parseInt(getComputedStyle(titolo).fontSize);
    titolo.style.fontSize = (fontSize - 1) + "px";
    _updateFontSizeInput((fontSize - 1))
}

function _updateFontSizeInput(fontSize) {
    document.getElementById("fontSize").value = fontSize;
}

let paddingAttuale = 0;
function _getCurrentPaddingStatus() {
    const container = document.getElementById("paddingContainer");

    if (!container) {
        console.log("Elemento paddingContainer non trovato");
        return;
    }

    paddingAttuale = parseInt(getComputedStyle(container).padding);
    _cambiaPadding(paddingAttuale);
}

function _cambiaPadding(newPaddingValue) {
    if (Number.isNaN(newPaddingValue)) {
        console.log("New padding is not a valid number");
        return;
    }

    if (newPaddingValue < 0) {
        newPaddingValue = 0;
    }

    const container = document.getElementById("paddingContainer");

    if (!container) {
        console.log("Elemento paddingContainer non trovato");
        return;
    }

    container.style.padding = newPaddingValue + "px";
    document.getElementById("paddingValue").innerText = newPaddingValue + "px";
}


function cambiaPadding(step) {
    const paddingAttuale = parseInt(getComputedStyle(document.getElementById("paddingContainer")).padding);
    _cambiaPadding(paddingAttuale + step);
}

function toggleNascondi(valore, bottone) {
    const numero = parseInt(valore);

    if (Number.isNaN(numero)) {
        console.log("valore non è un numero valido");
        return;
    }
    
    if (numero < 1 || numero > 2) {
        console.log("valore non valido");
        return;
    }

    const paragrafo = document.getElementById("paragrafo" + parseInt(valore));
    paragrafo.classList.toggle("hiddenText");

    if (paragrafo.classList.contains("hiddenText")) {
        bottone.textContent = "Mostra";
    } else {
        bottone.textContent = "Nascondi";    }

}

window.cambiaColore = cambiaColore;
window.cambiaColorePicker = cambiaColorePicker;
window.cambiaFontSize = cambiaFontSize;
window.cambiaFontSizeUp = cambiaFontSizeUp;
window.cambiaFontSizeDown = cambiaFontSizeDown;
window.toggleBold = toggleBold;
window.cambiaPadding = cambiaPadding;
window.toggleNascondi = toggleNascondi;

document.addEventListener("DOMContentLoaded", () => {
    _getCurrentWeightStatus();
    _getCurrentPaddingStatus();
});