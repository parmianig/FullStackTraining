<?php
    session_start();

    if(!isset($_SESSION['utente'])) {
        header('Location: register.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Benvenuto</h1>
    <p>la tua email: <?php echo $_SESSION['utente']['email']; ?></p>
    <hr>
    <a href="logout.php">Esci (e distruggi la sessione)</a>
</body>

</html>