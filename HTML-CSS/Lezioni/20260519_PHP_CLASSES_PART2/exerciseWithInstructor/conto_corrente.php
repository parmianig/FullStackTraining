<?php

require_once __DIR__ . '/conto_base.php';

class ContoCorrente extends ContoBase
{

    private float $fido;
    private array $storico = [];

    public function __construct(string $intestatario, float $saldoIniziale = 0.0, float $fido = 500.00) {
        parent::__construct($intestatario, $saldoIniziale);

        $this->fido = $fido;
    }

    public function deposita(float $importo) {
        if ($importo <= 0) {
            echo "L'importo deve essere un valore positivo maggiore di 0";
            return;
        }

        $this->saldo += $importo;
        $this->storico[] = $this->registraOperazione(self::DEPOSITO, $importo);

        echo "\n-----------------------\n
              Depositato correttamente €$importo
              \n-----------------------\n";
    }

    public function preleva(float $importo) {
        if ($importo <= 0) {
            echo "L'importo deve essere un valore positivo maggiore di 0";
            return;
        }

        if ($importo > ($this->saldo + $this->fido)) {
            echo "L'importo negato per saldo insufficiente: inferiore alla somma del saldo e del fido";
            return;
        }

        $this->saldo -= $importo;
        $this->storico[] = $this->registraOperazione(self::PRELIEVO, $importo);
    }

    public function mostraStorico() {
        echo "\n ---- Storico Operazioni: \n";

        if (empty($this->storico)) {
            echo "Nessun storico da visualizzare.";
            return;
        }

        foreach ($this->storico as $riga) {
            echo $riga . "\n";
        }
    }    
}
