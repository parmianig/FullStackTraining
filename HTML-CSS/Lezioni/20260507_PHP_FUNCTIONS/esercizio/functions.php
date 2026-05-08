<?php

use BcMath\Number;

session_start();

$abbonamentoErr = '';
$abbonamento = '';
$mesi = '';


if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $abbonamento = $_POST['abbonamento'] ?? '';
    $mesi = $_POST['mesi'] ?? '';
}

// Restituisca il totale formattato.

if ($abbonamento === '') {
    $abbonamentoErr = 'Scegli un abbonamento';
}

if ($mesi === '') {
    $mesiErr = 'Scegli il numero di mesi';
}

if (empty($abbonamentoErr)) {
    $_SESSION['utente'] = [
        'abbonamento' => $abbonamento,
        'mesi' => $mesi,
        'loggato' => true
    ];

    // evitare di ricaricare i dati nel form ad ogni refresh della pagina
    header('Location: home.php');
    exit();
} else {
    $formErr = 'Controlla i campi compilati';
}

// in questo array associativo, la chiave è il tipo di abbonamento ed è una stringa 
// e il valore corrisponde alla percentuale di sconto, ed è un float
$abbonamento = [
    'base' => 30,
    'premium' => 50,
    'default' => 0
];

// Riceva il nome dell'abbonamento (Base: €30, Premium: €50).
function tipoAbbonamento(string $tipoAbbonamento): float
{
    global $abbonamento;
    // cerca tipo di abbonamento in abbonamento, se lo troiva restituisce lo sconto
    print_r($abbonamento);
    if (isset($abbonamento[$tipoAbbonamento])) {
        return $abbonamento[$tipoAbbonamento];
    } 

    switch ($tipoAbbonamento) {
        case 'base':
            return 30;
        case 'premium':
            return 50;
        default:
            return 0;
    }
}

// Riceva il numero di mesi.
function calcoloCostoAbbonamento(string $abbonamento, float $mesi, int $sconto): float
{
    return tipoAbbonamento($abbonamento) * $mesi * (1 - $sconto / 100);
}

// Applichi uno sconto del 15% se l'utente prenota per più di 6 mesi.
$costoAbbonamento = calcoloCostoAbbonamento('base', 12, 15);

print_r($costoAbbonamento);

?>
<?php if (isset($_SESSION['flash'])) : ?>
    <span class="success"><?php echo $_SESSION['flash']; ?></span>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <div class="container">
        <!-- crea un form per richiedere al cliente il tipo di abbonamento: Baee e Premium -->
        <form action="" method="post">

            <div class="form-group full-width">
                <label for="abbonamento">Abbonamento</label>

                <div class="select-wrapper">
                    <select id="abbonamento" name="abbonamento">
                        <option value="">Scegli un abbonamento</option>
                        <option value="BASE">BASE 30€</option>
                        <option value="PREMIUM">PREMIUM 50€</option>
                    </select>
                </div>

                <?php if (!empty($abbonamentoErr)) : ?>
                    <span class="error"><?php echo $abbonamentoErr; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group full-width">
                <label for="mesi">Il numero di mesi</label>
                <input
                    type="number"
                    id="mesi"
                    name="mesi"
                    placeholder="Scrivi il numero di mesi"
                    min="1"
                    max="24"
                    step="1"
                    value="<?php echo htmlspecialchars($mesi); ?>">
                <?php if (!empty($mesiErr)) : ?>
                    <span class="error"><?php echo $mesiErr; ?></span>
                <?php endif; ?>
            </div>

            <div class="button-cell full-width">
                <button type="submit" class="btn">Calcola Prezzo</button>
            </div>
        </form>
    </div>
</body