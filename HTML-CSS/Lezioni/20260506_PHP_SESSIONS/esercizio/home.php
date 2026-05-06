<?php
session_start();

if (!isset($_SESSION['utente'])) {
    header('Location: register.php');
    exit();
}

$utente = $_SESSION['utente'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <div class="home-box">
            <h1>Benvenuto</h1>
            <p class="subtitle">
                Ecco i tuoi dati di registrazione.
            </p>

            <table class="table">
                <tr>
                    <th>Nome</th>
                    <td><?php echo htmlspecialchars($utente['name'] ?? ''); ?></td>
                </tr>
                <tr>
                    <th>Cognome</th>
                    <td><?php echo htmlspecialchars($utente['surname'] ?? ''); ?></td>
                </tr>
                <tr>
                    <th>Data di nascita</th>
                    <td><?php echo htmlspecialchars($utente['birthday'] ?? ''); ?></td>
                </tr>
                <tr>
                    <th>Età</th>
                    <td><?php echo htmlspecialchars($utente['eta'] ?? ''); ?></td>
                </tr>
                <tr>
                    <th>Abbonamento</th>
                    <td><?php echo htmlspecialchars($utente['abbonamento'] ?? ''); ?></td>
                </tr>
                <tr>
                    <th>Peso</th>
                    <td><?php echo htmlspecialchars($utente['peso'] ?? ''); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($utente['email'] ?? ''); ?></td>
                </tr>
            </table>

            <a class="logout-link" href="register.php">Esci</a>
        </div>
    </div>
</body>
</html>
