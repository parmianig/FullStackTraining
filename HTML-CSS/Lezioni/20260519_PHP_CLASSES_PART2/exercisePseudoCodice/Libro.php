<?php

class Libro
{
    private string $titolo;
    private string $autore;
    protected bool $disponibile;
    protected string $nomePrestito;

    public function __construct(string $titolo, string $autore)
    {
        $this->titolo = $titolo;
        $this->autore = $autore;

        $this->disponibile = true;
        $this->nomePrestito = "";
    }

    public function getTitolo(): string
    {
        return $this->titolo;
    }

    public function getAutore(): string
    {
        return $this->autore;
    }

    public function isDisponibile(): bool
    {
        return $this->disponibile;
    }

    public function stampaInfo()
    {
        $disponibilita = $this->disponibile ? 'Sì' : 'No';
        
        echo "\n===== Info =====\n" .
            "Titolo: {$this->titolo}\n" .
            "Autore: {$this->autore}\n" .
            "Disponibile: {$disponibilita}\n";

        if (!$this->disponibile) {
            echo "Nome prestito: {$this->nomePrestito}\n";
        }
    }
}


/* $libro = new Libro("Baloon", "Luca rossi");

$libro->stampaInfo(); */
