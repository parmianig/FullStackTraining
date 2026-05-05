<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php
            $colorePrimario="red";
            $coloreSecondario="black";
            $border="20px solid green";
            $padding="10px 20px 20px 40px";
            $align="center";
            echo "h1 { color: $colorePrimario; background-color: $coloreSecondario; }";
        ?>
        h1 {
            border: <?php echo $border; ?>;
            padding: <?php echo $padding; ?>;
            text-align: <?php echo $align; ?>;
        }
        p {
            border: <?php echo $border; ?>;
            padding: <?php echo $padding; ?>;
            text-align: <?php echo $align; ?>;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>La mia prima pagina PHP</h1>
            <p>con HTML CSS JS e PHP</p>
            
            <?php
                // set local timezone
                date_default_timezone_set("Europe/Rome");

                $nomeUtente = "Mario Rossi";
                $oraCorrente = date("H:i:s"); // Ora corrente in formato HH:MM:SS
                $dataCorrente = date("d/m/Y"); // Ora corrente in formato HH:MM:SS
                echo "<p>Benvenuto $nomeUtente</p>";
                echo "<p>Ora corrente: $oraCorrente - Data corrente: $dataCorrente</p>";

                // --- Array corìsi da passare in una lista

                $corsi = ["PHP", "JS", "HTML", "CSS"];
                echo "<ul>";
                foreach ($corsi as $corso) {
                    echo "<li>$corso</li>";
                }

                echo "</ul>";
            ?>
        </div>
    </main>
</body>
</html>