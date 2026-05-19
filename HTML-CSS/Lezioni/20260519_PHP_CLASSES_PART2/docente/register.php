<?php


require_once 'Post.php';
require  'UtenteGenerato.php';

// oggetto della classe persona
$utenteCreato= null;
$messaggio="";

// se hai premuto il bottone dal form di registrazione, avvia
// la creazione dell'oggetto
if( isset($_POST['crea_persona'])){

    // recupera i valori dai campi input
    $nome= $_POST['nome'];
    $email= $_POST['email'];
    $ruoli= $_POST['ruoli'];
    $genere= $_POST['genere'];

    // creazione dells persona tramite il costruttore
    try{
        
        $utenteCreato= new UtenteGenerato($nome, $email, $ruoli, $genere);
    }catch (InvalidArgumentException $e) {
        $messaggio= "<p style='color:red'> Errore: ".$e->getMessage() ."</p>";
    }

}

// -------- GESTIONE DEI POST
// -- potrai creare un post solo se sei amministratore
// cotrolla che hai premuto il tasto pubblica post

if (isset($_POST['pubblica_post'])){

    $ruoliRecuperati= $_POST['auth_ruoli'];
    $genereRecuperato= $_POST['auth_genere'];

    try{

        $autore= new UtenteGenerato(
            $_POST['auth_nome'],
            $_POST['auth_email'],
            $ruoliRecuperati,
            $genereRecuperato

        );

        $nuovo_post= new Post($_POST['titolo'], $_POST['contenuto'], $autore);

        $messaggio= $nuovo_post->mostraPost();
        $utenteCreato= $autore; 

    }catch (InvalidArgumentException $e) {
        $messaggio= "<p style='color:red'> Errore: ".$e->getMessage() ."</p>";
    }

    
}



?>