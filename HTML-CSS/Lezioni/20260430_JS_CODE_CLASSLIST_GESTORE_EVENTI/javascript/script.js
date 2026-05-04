let boxVisibili = false;
let contatore = 3;

function aggiungiElementoDiv() {
    contatore++;

    const nuovoBox = document.createElement("div");
    nuovoBox.className = "box";
    nuovoBox.textContent = "Box " + contatore;

    if (boxVisibili) {
        nuovoBox.classList.add("displayOn");
    }

    document.querySelector("main").appendChild(nuovoBox);
}

function aggiungiElementoConClassList() {
    const boxes = document.querySelectorAll('.box');
    boxVisibili = !boxVisibili;

    for (const box of boxes) {
        box.classList.toggle("displayOn", boxVisibili);
    }
}

const bottone = document.getElementById("avvia");
bottone.addEventListener("click", aggiungiElementoConClassList);

window.aggiungiElementoDiv = aggiungiElementoDiv;
