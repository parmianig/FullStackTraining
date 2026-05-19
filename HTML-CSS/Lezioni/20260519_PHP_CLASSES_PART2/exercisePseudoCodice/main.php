<?php

require_once __DIR__ . '/Libro.php';
require_once __DIR__ . '/LibroPrestabile.php';

$libro1 = new LibroPrestabile("Il nome della rosa", "Eco");
$libro2 = new LibroPrestabile("1984", "Orwell");

echo "\n";
$libro1->stampaInfo();
$libro1->prendi("Marco");
$libro1->prendi("Luca");

echo "\n";
$libro1->stampaInfo();
$libro1->restituisci();
$libro1->prendi("Luca");
echo "\n";
$libro1->mostraStorico();

$libro2->prendi("Anna");
$libro2->restituisci();
echo "\n";
$libro2->stampaInfo();
echo "\n";
$libro2->mostraStorico();
