console.log("domande esercizio 10");

function checkEta() {
    console.log("checkEta esercizio 10");

    const eta = parseInt(document.getElementById("eta").value);

    if (Number.isNaN(eta)) {
        document.getElementById("risultato").innerText = "Inserisci un'età valida";
        return;
    }
    
    let risultato = "";
    if (eta < 18) {
        risultato = "⛔️ Accesso negato! Sei troppo giovane.";
    } else {
        risultato = "Benvenuto nel club!";
    }

    risultato = "hai inserito " + eta + " anni: " + risultato;

    document.getElementById("risultato").innerText = risultato;
    console.log(risultato);
    document.getElementById("eta").value = "";
}

function abbigliamento() {
    console.log("abbigliamento esercizio 10");

    const temperatura = parseFloat(document.getElementById("temperatura").value);
    const clima = document.getElementById("clima").value;

    if (Number.isNaN(temperatura)) {
        document.getElementById("risultato").innerText = "Inserisci una temperatura valida";
        return;
    }

    if (clima === "") {
        document.getElementById("risultato").innerText = "Seleziona un clima";
        return;
    }

    let risultato = "";
    if (temperatura < 10) {
        risultato = "Cappotto pesante";
    } else if (temperatura >= 10 && temperatura <= 20) {
        if (clima == "Piove") {
            risultato = "Impermeabile e ombrello";
        } else if (clima == "C'è il sole") {
            risultato = "Giacchetta leggera";
        } else {
            risultato = "T-shirt";
        }
    } else {
        risultato = "T-shirt";
    }

    risultato = "hai inserito " + temperatura + " e " + clima + ": " + risultato;

    document.getElementById("risultato").innerText = risultato;
    console.log(risultato);
    document.getElementById("temperatura").value = "";
    document.getElementById("clima").value = "";

}

function spedizione() {
    console.log("spedizioni esercizio 10");

    const peso = parseFloat(document.getElementById("peso").value);
    const velocita = document.getElementById("velocita").value;

    if (Number.isNaN(peso)) {
        document.getElementById("risultato").innerText = "Inserisci un peso valido";
        return;
    }

    if (velocita === "") {
        document.getElementById("risultato").innerText = "Seleziona una velocità";
        return;
    }

    let risultato = "";
    if (peso < 2) {
        risultato = "la spedizione costa 5€";
    } else if (peso >= 2 && peso <= 10) {
        if (velocita == "standard") {
            risultato = "la spedizione costa 10€";
        } else if (velocita == "espressa") {
            risultato = "la spedizione costa 15€";
        } else {
            risultato = "T-shirt";
        }
    } else {
        risultato = "la spedizione costa 30€ (sovrapprezzo carichi pesanti)";
    }

    risultato = "hai inserito " + peso + " e " + velocita + ": " + risultato;

    document.getElementById("risultato").innerText = risultato;
    console.log(risultato);
    document.getElementById("peso").value = "";
    document.getElementById("velocita").value = "";

}

window.checkEta = checkEta;
window.abbigliamento = abbigliamento;
window.spedizione = spedizione;