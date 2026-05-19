<?php

require_once __DIR__ . "/conto_corrente.php";

echo "================ Conto corrente Mario Rossi ================\n";

$cc = new ContoCorrente("Mario Rossi", 1000.00);

$cc->stampaInfo();

$cc->deposita(250.00);
$cc->preleva(200.00);
$cc->preleva(100.00);
$cc->mostraStorico();

echo "-> Saldo finale: € {$cc->getSaldo()} <-\n";
