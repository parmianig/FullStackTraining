let titolo = document.getElementById("titolo");
let weightStatus = document.getElementById("weightStatus");

function _getCurrentWeightStatus() {
    const curretWeight = getComputedStyle(titolo).fontWeight;
    const textContent = curretWeight == "700" || curretWeight == "bold" ? "Bold" : "Normal";

    weightStatus.style.fontWeight = textContent.toLowerCase(textContent);
    weightStatus.textContent = textContent
}

function toggleBold() {
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
    paddingAttuale = parseInt(getComputedStyle(document.getElementById("paddingContainer")).padding);
    _cambiaPadding(paddingAttuale);
}

function _cambiaPadding(newPaddingValue) {
    // controlla che il valore sia un numero
    if (Number.isNaN(newPaddingValue)) {
        console.log("New padding is not a valid number");
        return;
    }
      
    if(newPaddingValue < 0) {
        newPaddingValue = 0;
    }
    
    const container = document.getElementById("paddingContainer");
    const currentPadding = parseInt(getComputedStyle(container).padding);

    container.style.padding = newPaddingValue + "px";
    document.getElementById("paddingValue").innerText = newPaddingValue + "px";
}

function cambiaPadding(step) {
    const paddingAttuale = parseInt(getComputedStyle(document.getElementById("paddingContainer")).padding);
    _cambiaPadding(paddingAttuale + step);
}

document.addEventListener("DOMContentLoaded", () => {
    _getCurrentWeightStatus();
});

document.addEventListener("DOMContentLoaded", () => {
    _getCurrentPaddingStatus();
});

window.cambiaColore = cambiaColore;
window.cambiaColorePicker = cambiaColorePicker;
window.cambiaFontSize = cambiaFontSize;
window.cambiaFontSizeUp = cambiaFontSizeUp;
window.cambiaFontSizeDown = cambiaFontSizeDown;
window.toggleBold = toggleBold;
window.cambiaPadding = cambiaPadding;