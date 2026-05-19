<?php

require_once 'Persona.php';

class Post {

    public string $titolo;
    public string $contenuto;
    public Persona $autore;

    public function __construct(string $titolo, string $contenuto, Persona $autore){

        $this->titolo= $titolo;
        $this->contenuto= $contenuto;
        $this->autore= $autore;

    }


    public function mostraPost(){

        return "
            <div style='border:1px solid; padding:10px; margin-bottom:10px'> 

                <h2> $this->titolo </h2>
                <p> $this->contenuto </p>
                <small> Scritto da <strong> {$this->autore->getNome('1234')} </strong> <small>
            </div>
        ";
    }

}

// $post_mario= new Post("il mio primo post", "il mio contenuto... ", $mario);
// $post_stefano= new Post("il mio secondo post", "il mio contenuto... ", $stefano);

// echo $post_mario->mostraPost();
// echo $post_stefano->mostraPost();
// echo $post_mario->mostraPost();




