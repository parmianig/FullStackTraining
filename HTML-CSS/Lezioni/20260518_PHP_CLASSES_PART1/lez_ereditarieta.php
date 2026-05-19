<?php
class Padre
{
    protected string $nome;
    protected string $email;
    public int $eta = 18;
    private string $passeword = "1234";

    public function __construct(string $nome, string $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function presentati()
    {
        return "Mi chiamo {$this->nome} e la mia email {$this->email}";
    }
}

class Figlia extends Padre
{
    private float $stipendio;
    public function __construct(string $nome, string $email, float $stipendio)
    {
        parent::__construct($nome, $email);
        $this->stipendio = $stipendio;
    }

    public function presentati()
    {
        return "Mi chiamo {$this->nome} e mi chiamo {$this->email} e il mio stipendio è {$this->stipendio}";
    }

    public function __toString() {
        return "Il tuo nome: " . $this->nome . "\nLa tua età: " . $this->eta . "\nLa tua email: " . $this->email . "\nIl tuo stipendio: " . $this->stipendio."\n";
    }
}
echo "\n--------- Chiamata alla classe figlia: ";

$mario = new Figlia("Mario", "test@test.it", 1200);
echo $mario;
echo $mario->presentati();

echo "\n\n--------- Chiamata alla classe padre: ";

$padre = new Padre("vito", 'vito_test@mail.it');
echo $padre->presentati();
