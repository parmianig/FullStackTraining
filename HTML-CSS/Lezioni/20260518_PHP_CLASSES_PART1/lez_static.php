<?php

class Contatore
{

    private static int $tot_istanze = 0;
    private string $nome;

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


$a = new Contatore("Alpha");
$a = new Contatore("Beta");

echo Contatore::getTotale();

class Colore {
    private function __construct(
        public readonly int $r,
        public readonly int $g,
        public readonly int $b
    ) {
        
    }

    // factory
    public static function fromRGB(int $r, int $g, int $b)
    {
        if ($r > 255 || $g > 255 || $b > 255) {
            echo "Errore: il valore non può superare il numero 255";
        } elseif ($r < 0 || $g < 0 || $b < 0) {
            echo "Errore: il valore non può essere negativo";
        } else {
            return new self($r, $g, $b);
        }
    }

    public static function rosso(): self
    {
        return new self(255, 0, 0);
    }
    public static function verde(): self
    {
        return new self(0, 255, 0);
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
        return new self(255, 0, 0);
    }


    public function __toString(): string {
        return "rgb($this->r, $this->g, $this->b)";
    }

}

echo Colore::fromRGB(255,255,0) . "\n";
echo Colore::rosso() . "\n";

$blue = Colore::blue();
echo $blue;


class Ordine {
    const STATO_BOZZA = 'bozza';
    
    const STATO_CONFERMATO = 'confermato';
    
    const STATO_SPEDITO = 'spedito';
    
    const STATO_CONSEGNATO = 'conseganto';
    
    const STATO_ANNULLATO = 'annullato';


    const STATI_VALIDI = [
        self::STATO_BOZZA,
        self::STATO_CONFERMATO,
        self::STATO_SPEDITO,
        self::STATO_CONSEGNATO,
        self::STATO_ANNULLATO,
    ];

    const IVA = 22.0;
    const SPESA_SPEDIZIONE_GRATIS_SOPRA = 50.0;

    private string $stato;
    private float $totale;

    public function __construct(float $totale) {
        $this->totale = $totale;
        $this->stato = self::STATO_BOZZA;
    }

    public function cambioStato(string $nuovo_stato) {
        if(!in_array($nuovo_stato, self::STATI_VALIDI)) {
            throw new InvalidArgumentException("stato non valido: $nuovo_stato ");
        }

        $this->stato = $nuovo_stato;
    }

    public function calcolaSpedizione(): float {
        return $this->totale >= self::SPESA_SPEDIZIONE_GRATIS_SOPRA ? 0.00: 5.99;
    }

    public function totaleIVA(): float {
        return round($this->totale * (1+self::IVA/100), 2);
    }

    // -- Letttura dello stato
    public function getStato() {
        return $this->stato;
    }
}

echo "\n ---- CONST ----\n";
$ordine = new Ordine(80.00);
echo "Costo della spedizione: " . $ordine->calcolaSpedizione() . "\n";

echo "Prezzo totale iva inclusa (22%): " . $ordine->totaleIVA() . "\n";

$ordine->cambioStato(Ordine::STATO_CONFERMATO);
echo "Stato ordine: " . $ordine->getStato() . "\n";

class Padre {
    
}