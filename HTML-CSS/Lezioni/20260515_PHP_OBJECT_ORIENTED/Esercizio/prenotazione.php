<?php
/*Devi creare una classe chiamata Prenotazione. 
Questa classe deve gestire i dati di una camera d'albergo*/

class Prenotazione
{
    private $cliente;
    private $numeroNotti;
    private $codiceSconto;

    public function __construct($cliente, $numeroNotti, $codiceSconto)
    {
        $this->cliente = $cliente;
        $this->numeroNotti = $numeroNotti;
        $this->codiceSconto = $codiceSconto;
    }

    // ma deve essere "severa": non deve permettere dati illogici (come un numero di persone negativo o una data passata).

    public function setCliente(string $cliente)
    {
        if (empty($cliente)) {
            throw new Exception("Il cliente non può essere vuoto");
        }
        $this->cliente = $cliente;
    }

    public function setNumeroNotti(int $numeroNotti)
    {
        // Il numeroNotti deve essere almeno 1. Se è 0 o meno, solleva un errore.
        if ($numeroNotti < 1) {
            throw new Exception("Il numero di notti deve essere almeno 1");
        }
        $this->numeroNotti = $numeroNotti;
    }

    public function setCodiceSconto(string $codiceSconto)
    {
        // Il codiceSconto deve avere un formato fisso: deve iniziare con la parola "SCONTO" (es: "SCONTO10"). Se non è così, solleva un errore.
        // Per il codice sconto, usa la funzione PHP str_starts_with($stringa, "SCONTO") per verificare l'inizio della parola.
        if (!str_starts_with($codiceSconto, "SCONTO")) {
            throw new Exception("Il codice sconto deve iniziare con 'SCONTO'");
        }
        $this->codiceSconto = $codiceSconto;
    }

    public function render() {
        echo "Cliente: " . $this->cliente . "<br>";
        echo "Numero notti: " . $this->numeroNotti . "<br>";
        echo "Codice sconto: " . $this->codiceSconto . "<br>";
    }
}