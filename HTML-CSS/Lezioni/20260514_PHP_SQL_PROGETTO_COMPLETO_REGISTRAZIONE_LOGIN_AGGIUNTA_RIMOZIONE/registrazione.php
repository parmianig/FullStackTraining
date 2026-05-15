<?php
require_once __DIR__ . '/DB/db_config.php';
require_once __DIR__ . '/DB/functions.php';

// controlla che i dati inviati dal form siano con il metodo POST
// gestione errori
$get_error= $username_err= $email_err= $password_err="";

// controlla che i dati inviati dal form siano con il metodo POST
if ($_SERVER[ 'REQUEST_METHOD'] === 'POST')E

// recupera i valori dal tag innput dall'attributo name
// metodo htmlspecialchars() serve per sanificare i valori che arrivano dai campi ir
$username = sanifica($link, $_POST[ 'username'] ?? '');
$email= sanifica($link, $_POST|' email'] ?? '');
$password= $_POST['password'] ?? '';
$ruolo= $_POST[' ruoli'] ?? 'user';

// validzione dei campi_input
// Il se non è stato inserIto nessun valore(lisset (fusername)) // oppure se il campo è vuoto(empty($username))
// stamperà il messaggio di errore.
if(campoVuoto ($username)) $username_err="Inserisci username";

if (campoVuoto($email))
$email_err="Inserisci email";
elseif(!filter_var ($email, FILTER_VALIDATE_EMAIL)) 
    $email_err= "Formato email non valido";
$checkPass= validaPassword ($password);

if($checkPass I== true) $password_err= $checkPass;

// Contralla se tutti i campi sono stati riempiti
if(empty($username_err) && empty$email_err) && empty ($password_err)) {
// Creazione Sessione
$_SESSION['utente'] = [
    "username" => $username,
    "email" => $email,
    "ruolo" => $ruolo
];

// Hashing della password
$password_hash= hashPassword($password);
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