<?php

require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/functions.php';

$error = "";

// SE LOGGATO VAI ALLA PAGINA HOME
if (isset($_SESSION['utente']['loggato']) && $_SESSION['utente']['loggato'] === true) {
    header('Location: home.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // recuperate dal form login
    $email = sanifica($link, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Compila tutti i campi";
    } else {

        // Preparazione della query per cercare l'utente
        $sql = "SELECT * FROM utenti WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            // colleghiamo il valore dell'email (s= Stringa)
            mysqli_stmt_bind_param($stmt, 's', $email);

            // esgui la query 
            if (mysqli_stmt_execute($stmt)) {

                $result = mysqli_stmt_get_result($stmt);

                // verifica se esiste l'utente
                if ($user = mysqli_fetch_assoc($result)) {

                    if (password_verify($password, $user['password'])) {
                        // Login ricevuto! salviamo i dati nella sessione
                        $_SESSION['utente'] = [

                            'id' => $user['id'],
                            'username' => $user['username'],
                            'email' => $user['email'],
                            'ruolo' => $user['ruoli'],
                            'loggato' => true

                        ];

                        header('Location: home.php');
                        exit;
                    } else {
                        $error = "Password Errata";
                    }
                } else {
                    $error = "Nessun account trovato con questa email";
                }
            } else {
                $error = "Errore durante l'invio della query";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        .container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }

        .error:empty {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Accedi</h2>

        <div class="<?php echo !empty($error) ? 'error' : ''; ?>">
            <?php echo htmlspecialchars($error); ?>
        </div>

        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" class="btn" value="Login">
        </form>

        <p>Non hai un account? <a href="register.php">Registrati qui</a></p>
    </div>

</body>

</html>