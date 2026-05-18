<?php

declare(strict_types=1);

require_once __DIR__ . '/persona.php';

class Post
{
    private string $titolo;
    private string $contenuto;
    private Persona $autore;

    public function __construct(string $titolo, string $contenuto, Persona $autore)
    {
        $this->setTitolo($titolo);
        $this->setContenuto($contenuto);
        $this->autore = $autore;
    }

    public function getTitolo(): string
    {
        return $this->titolo;
    }

    public function getContenuto(): string
    {
        return $this->contenuto;
    }

    public function getAutore(): Persona
    {
        return $this->autore;
    }

    public function setTitolo(string $titolo): void
    {
        $titolo = trim($titolo);

        if ($titolo === '' || mb_strlen($titolo) < 3) {
            throw new InvalidArgumentException('Il titolo deve contenere almeno 3 caratteri.');
        }

        $this->titolo = $titolo;
    }

    public function setContenuto(string $contenuto): void
    {
        $contenuto = trim($contenuto);

        if ($contenuto === '') {
            throw new InvalidArgumentException('Il contenuto del post non può essere vuoto.');
        }

        $this->contenuto = $contenuto;
    }
}
