<?php


    function somma_tutto(int|float ...$numeri): float {
        $totale = 0;
        foreach ($numeri as $numero) {
            $totale += $numero;
        }
        return $totale;
    }
    print_r(somma_tutto(1, 2, 3, 4, 5) . PHP_EOL);
    
    $quadrato = fn(int $n) => $n ** 2;
    print_r(somma_tutto($quadrato(4)));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>20260507</title>
    
</head>
<body>
    
</body>
</html>