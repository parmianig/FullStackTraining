<?php

class Persona
{
    protected string $nome;
    protected string $cognome;
    protected int $eta;
    private string $email;

    public function __construct(string $nome, string $cognome, int $eta, string $email)
    {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->setEta($eta);
        $this->setEmail($email);
    }

    public function getNomeCompleto(): string
    {
        return $this->nome . ' ' . $this->cognome;
    }


    public function getEta(): int
    {
        return $this->eta;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEta(int $eta): void
    {
        if ($eta < 0 || $eta > 110) {
            throw new InvalidArgumentException('Età non valida.');
        }

        $this->eta = $eta;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email non valida.');
        }

        $this->email = $email;
    }

    public function isMaggiorenne(): bool
    {
        return $this->eta >= 18;
    }

    public function getRuolo(): string
    {
        return 'Persona';
    }

    public function presentati(): string
    {
        return '[' . $this->getRuolo() . '] ' . $this->getNomeCompleto() . ', ' . $this->eta . ' anni, email: ' . $this->email;
    }
}

class Studente extends Persona
{
    private string $matricola;
    private string $corso;
    private array $voti = [];

    public function __construct(string $nome, string $cognome, int $eta, string $email, string $matricola, string $corso)
    {
        parent::__construct($nome, $cognome, $eta, $email);
        $this->matricola = $matricola;
        $this->corso = $corso;
    }

    public function getRuolo(): string
    {
        return 'Studente';
    }

    public function aggiungiVoto(float $voto): void
    {
        if ($voto < 0 || $voto > 10) {
            throw new InvalidArgumentException('Il voto deve essere compreso tra 0 e 10.');
        }

        $this->voti[] = $voto;
    }

    public function calcolaMedia(): float
    {
        if (count($this->voti) === 0) {
            return 0.0;
        }

        return array_sum($this->voti) / count($this->voti);
    }

    public function presentati(): string
    {
        return parent::presentati() . ', matricola: ' . $this->matricola . ', corso: ' . $this->corso . ', media voti: ' . round($this->calcolaMedia(), 2);
    }
}

class Docente extends Persona
{
    private string $materia;
    private float $compensoOrario;

    public function __construct(string $nome, string $cognome, int $eta, string $email, string $materia, float $compensoOrario)
    {
        parent::__construct($nome, $cognome, $eta, $email);
        $this->materia = $materia;
        $this->compensoOrario = $compensoOrario;
    }

    public function getRuolo(): string
    {
        return 'Docente';
    }

    public function calcolaCompenso(float $ore): float
    {
        if ($ore < 0) {
            throw new InvalidArgumentException('Le ore non possono essere negative.');
        }

        return $this->compensoOrario * $ore;
    }

    public function presentati(): string
    {
        return parent::presentati() . ', materia insegnata: ' . $this->materia . ', compenso orario: €' . number_format($this->compensoOrario, 2, ',', '.');
    }
}
