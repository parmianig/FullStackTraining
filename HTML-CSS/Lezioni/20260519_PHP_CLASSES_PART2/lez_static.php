<?php

class Contatore
{
    public static $tot_istanze = 0;

    public string $nome;

    public function __construct(string $nome)
    {

        self::$tot_istanze++;
        $this->nome = $nome;
    }

    public static function getTotale(): int
    {
        return self::$tot_istanze;
    }
}

$a =  new Contatore("Alpha");
$b =  new Contatore("Beta");

echo "Istanza contattore a " . $b->getTotale() . " istanze";
echo "Istanza contattore b " . $b->getTotale() . " istanze";

class Colore
{
    private function __construct(
        public readonly int $r,
        public readonly int $g,
        public readonly int $b,
    ) {}

    public static function fromRGB(int $r, int $g, int $b): self
    {
        return new self($r, $g, $b);
    }

    public static function rosso(): self
    {
        return new self(255, 0, 0);
    }
    public static function verde(): self
    {
        return new self(255, 255, 0);
    }
    public static function blue(): self
    {
        return new self(0, 0, 255);
    }
    public static function bianco(): self
    {
        return new self(255, 255, 255);
    }
    public static function nero(): self
    {
        return new self(0, 0, 0);
    }
}
