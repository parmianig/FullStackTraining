<?php
require_once 'functions.php';

$risultato = "";

// inserisci i controlli

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Palestra Online</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background: #eee;
        }

        .box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .alert {
            margin-top: 20px;
            padding: 10px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }

        select,
        input,
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2>Preventivo Palestra</h2>
        <form method="POST">
            <label>Scegli il piano:</label>
            <select name="piano">
                <option value="base">Base (€30/mese)</option>
                <option value="premium">Premium (€50/mese)</option>
            </select>

            <label>Numero di mesi:</label>
            <input type="number" name="mesi" min="1" required>

            <button type="submit">Calcola Prezzo</button>
        </form>

        <?php if ($risultato): ?>
            <div class="alert"><?php echo $risultato; ?></div>
        <?php endif; ?>
    </div>

</body>

</html>