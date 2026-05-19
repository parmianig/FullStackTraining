<?php

class ContoBase
{
    protected const DEPOSITO = 'Deposito';
    protected const PRELIEVO = 'Prelievo';
    private string $numeroConto;
    protected float $saldo;
    protected string $intestatario;

    public function __construct(string $intestatario, float $saldoIniziale = 0.0)
    {
        $this->intestatario = $intestatario;
        $this->saldo = $saldoIniziale;

        $this->numeroConto = strtoupper(uniqid('IT'));
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }


    public function stampaInfo()
    {
        echo "\n-----------------------\n";
        echo "
            Numero Carta: {$this->numeroConto}\n
            Intestatario: {$this->intestatario}\n
            Saldo attuale: {$this->numeroConto}\n
            ";
        return "";
    }

    protected function registraOperazione(string $tipo, float $importo) {
        $data = date('d/m/Y H:i:s');

        return "[ $data ] | $tipo | € $importo";
    }
}
