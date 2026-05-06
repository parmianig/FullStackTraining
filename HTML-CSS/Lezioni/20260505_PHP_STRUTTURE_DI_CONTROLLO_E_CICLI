<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    // scriviamo il ciclo for
    for ($i = 0; $i < 10; $i++) {
        echo "for " . $i . "<br>";
    }

    // ciclo while
    $i = 0;
    while ($i < 10) {
        echo "while " . $i . "<br>";
        $i++;
    }
    
    // ciclo do-while
    $i = 0;
    do {
        echo "do-while " . $i . "<br>";
        $i++;
    } while ($i < 10);

    // ciclo foreach
    $corsi = ["PHP", "JS", "HTML", "CSS"];
    foreach ($corsi as $corso) {
        echo "foreach " . $corso . "<br>";
    }

    // ciclo foreach
    $corsi = ["PHP", "JS", "HTML", "CSS"];
    foreach ($corsi as $key => $corso) {
        echo "foreach " . $key . " => " . $corso . "<br>";
    }

    // inizializza un dizionario
    $dizionario = [
        "nome" => "Alice",
        "cognome" => "Rossi",
        "eta" => 36
    ];
    echo $dizionario["nome"] . "<br>";
    echo $dizionario["cognome"] . "<br>";
    echo $dizionario["eta"] . "<br>";

    // esempio utilizzo di statement match
    echo "<h2>Statement Switch</h2>";
    $corso = "PHP";
    switch ($corso) {
        case "PHP":
            echo "PHP";
            break;
        case "JS":
            echo "JS";
            break;
        case "HTML":
            echo "HTML";
            break;
        case "CSS":
            echo "CSS";
            break;
        default:
            echo "corso non trovato";
            break;
    }

    // esempio di utilizzo dello statement match
    echo "<h2>Statement Match</h2>";
    $corso = "PHP";
    echo match ($corso) {
        "PHP" => "<h3 style='color:red'>PHP</h3>",
        "JS" => "JS",
        "HTML" => "HTML",
        "CSS" => "CSS",
        default => "corso non trovato",
    };

    echo "<h2>Altro esempio di utilizzo di match</h2>";
    // $adulto sia un numero interno e senza virgola
    $adulto = 17;
    if (!is_int($adulto)) {
        echo "adulto non e' un numero intero";
        exit;
    }
    echo match (true) {
        $adulto >= 18 => "adulto",
        default => "minorenne",
    };
    
    // esempio array associativi
    $smartphone = [
        "marca" => "Apple",
        "modello" => "iPhone 14",
        "colore" => "rosso",
        "prezzo" => 1000
    ];

    $styleKey = 'style=\'color: red\'';
    $styleValue = 'style=\'color: green\'';

    foreach ($smartphone as $key => $value) {
        echo "<p $styleKey>" . $key . " => " . "<span $styleValue>" . $value . "</span<p>";
    }

    

    ?>
</body>
</html>