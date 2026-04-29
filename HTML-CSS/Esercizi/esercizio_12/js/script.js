let supereroi = ["Spider-Man", "Batman", "Wonder Woman", "Iron Man"];

function _aggiungiElementoAllaFine() {
    supereroi.push("Thor");
    console.log(supereroi);
}

function _aggiungiElementoAllaTesta() {
    supereroi.unshift("Hulk");
    console.log(supereroi);
}

function _visualizzaArray() {
    console.log(supereroi);
}

function esercizio1() {
    _aggiungiElementoAllaFine();
    _aggiungiElementoAllaTesta();
    _visualizzaArray();
}

function esercizio2() {
    let voti = [5, 8, 4, 7, 10];

    // 2. Aggiungi un voto mancante
    console.log("2. Aggiungi un voto mancante")
    voti.push(9);
    console.log(voti);
    // La Sfida: Promosso o Bocciato?

    // 3. Calcola la media dei voti
    console.log("3. Calcola la media dei voti")
    let mediaVoti = 0;
    for (let index = 0; index < voti.length; index++) {
        mediaVoti += voti[index];
    }
    mediaVoti /= voti.length;
    console.log(mediaVoti);

    // usa il ciclo for con continue per stampare solo i voti maggiori di 5
    console.log("Usa il ciclo for con continue per stampare solo i voti maggiori di 5")
    for (let index = 0; index < voti.length; index++) {
        if (voti[index] > 5) {
            console.log(voti[index]);
        }
    }

}

function esercizio3() {
    // A. Recupera tutti gli elementi con la classe "box-utente":
    let utentiHTML = document.getElementsByClassName("box-utente");
    console.log(utentiHTML);

    // B. Crea un array che decide chi è online e chi no:
    let stati = ["online", "offline", "online", "offline"];

    // C. Usa il ciclo FOR per applicare le classi:
    for (let index = 0; index < utentiHTML.length; index++) {
        // Prendiamo lo stato dall'array (online o offline)
        let statoAttuale = stati[index];
        utentiHTML[index].classList.add(statoAttuale);
    }
}

function esercizio3_1() {
    let utentiHTML = document.getElementsByClassName("box-utente");
    utentiHTML[3].classList.remove("offline")
    console.log(utentiHTML);
}

function esercizio3_2() {
    let utentiHTML = document.getElementsByClassName("box-utente");
    utentiHTML[3].classList.add("online");
    console.log(utentiHTML);
}

function esercizio3_3() {
    let utentiHTML = document.getElementsByClassName("box-utente");
    utentiHTML[3].innerText = "Anna (Appena entrata!)";
    console.log(utentiHTML);
}

window.esercizio1 = esercizio1;
window.esercizio2 = esercizio2;
window.esercizio3 = esercizio3;
window.esercizio3_1 = esercizio3_1;
window.esercizio3_2 = esercizio3_2;
window.esercizio3_3 = esercizio3_3;