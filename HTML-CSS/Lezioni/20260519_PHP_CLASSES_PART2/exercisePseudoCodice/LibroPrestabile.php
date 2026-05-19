<?php

require_once __DIR__ . '/Libro.php';

class LibroPrestabile extends Libro {
    
    private array $storicoPrestiti = [];

    public function __construct(string $titolo, string $autore)
    {
        return parent::__construct($titolo, $autore);
    }

    public function prendi(string $nomeUtente): bool {
        if (!$this->disponibile) {
            echo "\nLibro già in prestito\n";
            return false;
        }

        $this->disponibile = false;
        $this->nomePrestito = $nomeUtente;
        $this->storicoPrestiti[] = $nomeUtente;
        echo "prestito OK!";
        return true;
    }

    public function restituisci(): bool {
        if ($this->disponibile) {
            echo "Il libro non era in prestito";
            return false;
        }

        $this->disponibile = true;
        $this->nomePrestito = "";
        echo "restituzione OK!";
        return true;
    }

    public function mostraStorico(): void {
        echo "\n===== Storico Prestiti =====\n";
        
        if (empty($this->storicoPrestiti)) {
            echo "Nessun prestito registrato.\n";
            return;
        }
        
        foreach ($this->storicoPrestiti as $index => $utente) {
            echo ($index + 1) . ". {$utente}\n";
        }
    }
}