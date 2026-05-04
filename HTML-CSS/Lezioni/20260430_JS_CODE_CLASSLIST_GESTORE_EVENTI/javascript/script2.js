let box = document.getElementById("box-interattiva");
let log = document.getElementById("debug-log");

// Functione per inserire gli eventi ne ltag div con id="debug-log"
function upDateLog(messaggio) {
    let logEntry = document.createElement("div");
    logEntry.className = "log-entry";
    logEntry.textContent = `> ${messaggio}`
    log.prepend(logEntry);
}

//------Gestore di eventi

// - Event Click
box.addEventListener("click", () => {
    box.classList.toggle("click-attivo");
    upDateLog("Evento: Click");
});

// - Evento Doppio Click
box.addEventListener("dblclick", () => {
    box.classList.toggle("click-attivo");
    upDateLog("Evento: Doppio Click");
});

// - Evento Scroll
window.addEventListener("wheel", (event) => {
    event.preventDefault();
    box.classList.toggle("scrolling");
    upDateLog("Evento: Scroll");
    setTimeout(() => {
        box.classList.toggle("scrolling"), 500;
    })
}, { passive: false });

// - Evento Resize
window.addEventListener("resize", () => {
    const H = window.innerHeight;
    const W = window.innerWidth;

    document.body.style.backgroundColor = W < 600 ? "lightblue" : "lightgreen";
    upDateLog(`Responsive: ${W}px x ${H}px`);
});