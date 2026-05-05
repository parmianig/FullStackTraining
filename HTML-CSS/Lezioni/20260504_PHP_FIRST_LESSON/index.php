<?php
    $nome="Alice";
    $cognome="Rossi";
    echo "Ciao $nome $cognome";
    echo "<br>";
    $nome="Marta";
    $cognome="Verdi";
    echo "Ciao $nome $cognome";

    $eta = 36;
    echo "<br>";
    echo "L'eta di $nome e' $eta anni";

    echo "<br>";
    $colore = "red";
    $corso = "PHP";
    echo "<p style='color:$colore'>Il colore e' $colore e il corso è $corso</p>";

    const VARIABILE_COSTANTE="costante (costante è la variabile costante)";
    echo "<br>";
    echo "La costante e' ".VARIABILE_COSTANTE;
?>