<?php
require_once __DIR__ . '/DB/db_config.php';

$error_message = '';
$success_message = '';

$link = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanifica($link, $_POST['nome'] ?? '');
    $email = sanifica($link, $_POST['email'] ?? '');
    $eta = sanifica($link, $_POST['eta'] ?? '');
    $citta = sanifica($link, $_POST['citta'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($nome) || empty($email) || empty($eta) || empty($citta) || empty($password)) {
        $error_message = 'Tutti i campi sono obbligatori';
    } else {
        $sql = "SELECT id FROM utenti WHERE email = '$email'";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $error_message = 'Email già registrata';
        } else {
            $password_hash = hashPassword($password);

            $sql = "INSERT INTO utenti (nome, email, password, eta, citta)
                    VALUES ('$nome', '$email', '$password_hash', '$eta', '$citta')";

            if (mysqli_query($link, $sql)) {
                $success_message = "Utente crato con successo<br> vai sulla pagina di <a href='login.php'> login </a>";

            } else {
                $error_message = 'Errore durante la registrazione: ' . mysqli_error($link);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <style>
        .container {
            display: flex;
            direction: column;
            align-items: center;
        }

        form {
            display: flex;
            direction: column;
            align-items: center;
        }

        .error {
            padding: 20px;
            background-color: #ecd1d1;
            color: #ff0000;
            border-left: 3px solid #ff0000;
            font-weight: bold;
        }

        .success {
            padding: 20px;
            background-color: #d2f0d2;
            color: #00ff00;
            border-left: 3px solid #00ff00;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php if (!empty($error)): ?>
            <h3 class="error"><?php echo $error; ?></h3>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <h3 class="success"><?php echo $success; ?></h3>
        <?php endif; ?>

        <form method="post">
            <div>
                <label>Nome:</label>
                <input type="text" name="nome" required>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label>Città:</label>
                <input type="text" name="citta">
            </div>
            <div>
                <label>Età:</label>
                <input type="number" name="eta">
            </div>
            <div>
                <input type="submit" class="btn" value="Invia">
            </div>
        </form>

    </div>

</body>

</html>

<?php
mysqli_close($link);
?>