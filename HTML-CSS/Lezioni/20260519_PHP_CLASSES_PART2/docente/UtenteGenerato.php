<?php

require_once 'Persona.php';

class UtenteGenerato extends Persona{

    // ---- Aggiungiamo la proprietà Genere alla classe persona.
    public string $genere; // maschio | femmina

    // ---- Costruttore 
    public function __construct(string $nome, string $email, array $ruoli, string $genere, string $stato = 'attivo'){

        parent::__construct($nome,$email,$ruoli, $stato);

        $this->setGenere($genere);

    }

    // ---- Getter
    public function getGenere(){
        return $this->genere;
    }

    // ---- Setter con convalida
    public function setGenere(string $genere){

        $convertiGenere= strtolower($genere);

        $genereValidi = ['maschio', 'femmina'];

        if(!in_array($convertiGenere, $genereValidi)){
            
            throw new InvalidArgumentException(
                    "Genere non valido. Accettiamo solo: ".implode(', ', $genereValidi)
            );}

        $this->genere = $convertiGenere;

    } 

    // ---- OVERRIDE di presentati()

    public function presentati(){

        $saluto= ($this->getGenere() === 'femmina')? 'Benvenuta' : 'Benvenuto';
        $listaRuoli= implode(", ", $this->ruoli);
        $password= "1234";
        return 
        "
            $saluto {$this->getNome($password)}!
            Email: {$this->getEmail()}
            Genere: {$this->genere}
            Ruoli: $listaRuoli 
            Stato: {$this->stato}     
        ";





    }





}




?>
