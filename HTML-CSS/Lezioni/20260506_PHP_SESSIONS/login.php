<?php
session_start();

$error = '';
$email = '';
$password = '';

if (isset($_SESSION['utente']['loggato']) && $_SESSION['utente']['loggato'] === true) {
    header('Location: home.php');
    exit();
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '') {
        $error = 'Inserisci una email';
    } elseif ($password === '') {
        $error = 'Inserisci una password';
    } elseif (
        isset($_SESSION['utente']['email']) &&
        isset($_SESSION['utente']['password'])
    ) {
        if (
            $email === $_SESSION['utente']['email'] &&
            $password === $_SESSION['utente']['password']
        ) {
            $_SESSION['utente']['loggato'] = true;
            header('Location: home.php');
            exit();
        } else {
            $error = 'Email o password errati';
        }
    } else {
        $error = 'Nessun utente registrato. Effettua prima la registrazione.';
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1>Accedi</h1>

            <?php if (isset($_GET['logout']) && $_GET['logout'] == '1') : ?>
                <div class="success">Logout effettuato con successo. La sessione è stata distrutta.</div>
            <?php endif; ?>

            <?php if (!empty($error)) : ?>
                <div class="alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        value="<?php echo htmlspecialchars($email); ?>"
                    >
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                    >
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <p class="register-link">
                Non hai un account? <a href="register.php">Registrati qui</a>
            </p>
        </div>
    </div>
</body>
</html>
