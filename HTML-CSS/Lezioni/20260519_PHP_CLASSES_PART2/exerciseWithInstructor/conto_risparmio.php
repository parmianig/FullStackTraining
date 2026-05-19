<?php

require_once __DIR__ . "/conto_base.php";

class ContoRisparmio extends ContoBase
{
    public function __construct(string $intestatario, float $saldoIniziale = 0.0)
    {
        return parent::__construct($intestatario, $saldoIniziale);
    }
}