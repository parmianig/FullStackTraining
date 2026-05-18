<?php

declare(strict_types=1);

require_once __DIR__ . '/prenotazione.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="prenotazione.php" method="post">
        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" required maxlength="100">
        </div>
        <div>
            <label for="notti">Notti</label>
            <input type="text" name="notti" required>
        </div>
        <div>
            <label for="sconto">Sconto</label>
            <input type="text" name="sconto" required>
        </div>
        <button type="submit">Invia</button>
    </form>
</body>

</html>

<?php
// Quando ricevi i dati via $_POST, apri un blocco try.
// Dentro il try, istanza l'oggetto Prenotazione.
// Subito dopo, aggiungi il blocco catch (Exception $e).
// Dentro il catch, usa $e->getMessage() per stampare a video l'errore in un box rosso.
try {
    $prenotazione = new Prenotazione($_POST['nome'], $_POST['notti'], $_POST['sconto']);
    $prenotazione->render();
} catch (Exception $e) {
    echo "<div style='padding:10px; border:1px solid #f44336; background:#ffebee; margin-bottom:1rem;'>" . $e->getMessage() . "</div>";
}

// renderizza prenotazione come HTML



?>