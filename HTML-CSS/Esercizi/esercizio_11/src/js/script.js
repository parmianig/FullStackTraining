function controllaTesto() {
    const testo = document.querySelector(".testoDefault");
    const reportRisultato = document.getElementById("risultatoControllo");
    testo.classList.remove("testoAlertGreen");
    reportRisultato.textContent = "";
    
    if (testo.value === "" && !testo.classList.contains("testoAlertRed")) {
        testo.classList.add("testoAlertRed");
    }
    
    if (testo.value !== "") {
        testo.classList.remove("testoAlertRed");
        testo.classList.add("testoAlertGreen");
    }
    
    if (testo.classList.contains("testoAlertGreen")) {
        reportRisultato.textContent = "Controllo effettuato con successo";
    }
}

function darkMode() {
    const body = document.getElementById("darkModePage");
    const titolo = document.getElementById("titoloDarkModeDefault");
    const text = document.getElementById("testoDarkModeDefault");
    const button = document.getElementById("darkModeButton");

    if (body.classList.contains("containerEsercizio3Black") && text.classList.contains("testoDarkModeWhite")) {
        body.classList.remove("containerEsercizio3Black");
        titolo.classList.remove("testoDarkModeWhite");
        text.classList.remove("testoDarkModeWhite");
        button.textContent = "Attiva Modalità Notte";
    } else {
        body.classList.add("containerEsercizio3Black");
        titolo.classList.add("testoDarkModeWhite");
        text.classList.add("testoDarkModeWhite");
        button.textContent = "Attiva Modalità Giorno";
    }
}

function eseguiContatore(value) {
    if(!Number.isInteger(value)) {
        console.log("Inserisci un numero intero");
        return;
    }

    const contatore = document.getElementById("contatore");
    const mostraContatore = document.getElementById("mostraContatore");

    if (!contatore || !mostraContatore) {
        console.error("Elementi contatore o mostraContatore non trovati");
        return;
    }

    let contatoreValue = parseInt(mostraContatore.innerText);
    contatoreValue += value;
    mostraContatore.innerText = contatoreValue
    console.log(contatoreValue);
    if (contatoreValue > 10) {
        mostraContatore.classList.remove("mostraContatoreBlu");
        mostraContatore.classList.add("mostraContatoreRosso");
    } else if (contatoreValue < 0) {
        mostraContatore.classList.remove("mostraContatoreRosso");
        mostraContatore.classList.add("mostraContatoreBlu");
    }
}

function cambiaColore(lightColor) {
    const luceSemaforo = document.getElementById("luceSemaforo");

    if (!luceSemaforo) {
        console.error("Elemento luceSemaforo non trovato");
        return;
    }

    luceSemaforo.classList.remove("rosso", "giallo", "verde", "grigio");
    switch (lightColor) {
        case "red":
            luceSemaforo.classList.add("rosso");
            break;

        case "yellow":
            luceSemaforo.classList.add("giallo");
            break;

        case "green":
            luceSemaforo.classList.add("verde");
            break;

        default:
            console.error("lightColor non valido");
            break;
    }
}

window.cambiaColore = cambiaColore;
window.eseguiContatore = eseguiContatore;
window.darkMode = darkMode;
window.controllaTesto = controllaTesto;