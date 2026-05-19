<?php

class Persona{

    // ------------- PROPRIETà DELLA CLASSE

    private string $nome;
    private string $email;
    public array $ruoli;
    public string $stato;

    // ------------- COSTRUTTORE
    public function __construct(string $nome, string $email, array $ruoli, string $stato="attivo"){

        $this->nome= $nome;
        $this->email= $email;
        $this->ruoli= $ruoli;
        $this->stato= $stato;

    }

    // ------------ GETTER E SETTER
    // -- GETTER: SOLO LETTURA DELLEA PROPRIETà (RETURN)
    // -- SETTER: IMPOSTA IL VALORE ALLA PROPRIETà

    //------------- GETTER

    public function getNome($password) : string {

        if($password == '1234'){return $this->nome;}

        return "Password errata!";
        
    }

    public function getEmail(): string{
        return $this->email;
    }


    // ----- SETTER
    public function setNome(string $nome){

        if(strlen($nome) <3){

            throw new Exception("Nome utente troppo corto");
        }

        $this->nome= $nome; 
    }

    public function setEmail(string $email){

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

            throw new Exception("Email non valida es: < mario@test.it > ");
        }

        $this->email= $email;
    }


    // ------------ METODI 

    public function haRuolo($ruoloRichiesto): bool{

        return in_array($ruoloRichiesto, $this->ruoli);

    }

    public function presentati(){

        $listaRuoli= implode(", ", $this->ruoli);
        return "\nCiao,\nti chiami: $this->nome;\nla tua email: $this->email,\ni tuoi ruoli sono: $listaRuoli";
    }

    public function aggiungiRuolo(string $nuovoRuolo):Persona{

        if(!$this->haRuolo($nuovoRuolo)){

            $this->ruoli[]= $nuovoRuolo;

            echo "\nil tuo ruolo $nuovoRuolo è stato aggiunto";    
        }else{
            echo "\nil ruolo $nuovoRuolo è già presente";
        }

        return $this;

    }


}


// // ------------------------------ CREAZIONE DELL'OGGETTO

// try{

//     // crezione dell'oggetto
//     $stefano= new Persona("Stafano", "test@email.it", ['admin','editor']);
//     echo $stefano->getNome("1234");
//     echo "\n--------------\n";
//     echo $stefano->getEmail();
//     echo "\n--------------\n";
//     echo $stefano->presentati();
//     echo "\n--------------\n";  
//     echo $stefano->aggiungiRuolo("user")->presentati();
//     echo "\n--------------\n";  
//     $stefano->setNome("bob");
//     echo $stefano->presentati();
//     echo "\n--------------\n";  
//     $stefano->setEmail("bob@tim.it");
//     echo $stefano->presentati();
//     echo "\n--------------\n";  

//     //--------- Creazione del seconfo oggetto
//     $mario= new Persona("mario", "mario@tim.it",['editor']);
//     echo "Oggetto Mario: ".$mario->getNome("1234");
//     echo "\n--------------\n";  
//     echo "Oggetto Stefano: ".$stefano->getNome("1234");
//     echo "\n--------------\n";  

// }catch(Exception $e){

//     echo "Errore critico: ".$e->getMessage();

// }