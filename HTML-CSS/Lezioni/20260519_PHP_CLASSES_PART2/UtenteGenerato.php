<?php

require_once 'persona.php';

class UtenteGenerato extends Persona {
    public string $genere; // maschio | femmina

    #[Override]
    public function __construct(string $nome, string $email, array $ruoli, string $stato = 'attivo')
    {
        parent::__construct($nome, $email, $ruoli, $stato);
        $this->setGenere($genere);
    }

    public function setGenere(string $genere) {
        $convertiGenere = strtolower($genere);
        $genreValidi = ['maschio', 'femmina'];

        if(!in_array($genere, $genreValidi)) {
            throw new InvalidArgumentException("Il genere deve essere: ".implode(', ', $genreValidi));
        }
        $this->genere = $convertiGenere;
    }

    public function presentati() {
        $saluto = ($this->genere === 'femmina')? 'Benvenuta' : 'Benvenuto';
        $listaRuoli = implode(", ", $this->ruoli);
return "
    $saluto {this-<getNome('1234')}!\n
    Email: 
    "

    }
}