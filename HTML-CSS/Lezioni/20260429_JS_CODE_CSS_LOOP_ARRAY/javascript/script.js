function lanciaLoop() {
    for (let i = 0; i < 10; i++) {
        console.log(i);
    }
}

function lanciaLoopConBreak() {

    for (let index = 1; index < 10; index++) {
        console.log(index);
        if(index % 4 == 0) {
            console.log("Break on i % 4 == 0; index -> " + index);
            break;
        }
    }

}

function lanciaLoopConArray() {
    const array = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j"];
    for (let index = 0; index < array.length; index++) {
        console.log(array[index]);
    }
}

function esempioUnshift(valoreDaInserire) {
    const array = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j"];
    array.unshift(valoreDaInserire);
    console.log("Array dopo unshift -> ", array);
    _assertion(array[0] == valoreDaInserire, "Esempio Unshift fallito");
    
    console.info("Array unshifted as expected: elemento 0 is now: " + valoreDaInserire );
}

function esempioSpliceArray() {
    const array = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j"];
    array.splice(3, 0, "z");
    console.log("Array dopo splice -> ", array);
    _assertion(array[3] == "z", "Esempio Splice fallito");
    
    console.info("Array spliced as expected: elemento 3 is now: " + array[3] );
}

function esempioInnerTextHTML() {
    for (let index = 0; index < 10; index++) {
        document.getElementsByClassName("cicloForInnerText")[index].innerText = "Ciclo for " + index;
    }

    for (let index = 0; index < 10; index++) {
        if(index % 2 == 0) { 
            document.getElementById("cicloForInnerHTML").innerHTML += "<div>Ciclo for innerHTML " + index + "</div> ";
            continue; 
        } ;
        
        document.getElementById("cicloForInnerHTML").innerHTML += "<div style=\"background-color: lightgreen\">Ciclo for innerHTML " + index + "</div> ";
    }
}

function eliminaPrimo() {
    spesa.shift();
    aggiornaSpesa();

}

function aggiornaSpesa(spesa) {
    let listSpesa = document.getElementById("listaSpesa");
    
    spesa.forEach(element => {
        let li = document.createElement("li");
        li.textContent = "Prodotto " + element + " aggiunto alla spesa";
        listSpesa.appendChild(li);
    });
}

function aggiungiElementoA(listaSpesa) {
    let input = document.getElementById("inputSpesa");
    let inputSpesa = input.value.trim();

    if(inputSpesa != "") {
        listaSpesa.push(inputSpesa);
        aggiornaSpesa(listaSpesa);
        console.log("Hai inserito: " + inputSpesa);
        input.value = "";
    } else {
        alert("Inserisci qualcosa");
    }

    aggiornaSpesa();
}

const _assertion =  (condition, message) => {
    if (!condition) {
        throw new Error(message);
    }
}

window.lanciaLoop = lanciaLoop;
window.lanciaLoopConBreak = lanciaLoopConBreak;
window.lanciaLoopConArray = lanciaLoopConArray;
window.esempioUnshift = esempioUnshift;
window.esempioSpliceArray = esempioSpliceArray;
window.esempioInnerTextHTML = esempioInnerTextHTML;
window.aggiornaSpesa = aggiornaSpesa;
window.aggiungiElementoA = aggiungiElementoA;