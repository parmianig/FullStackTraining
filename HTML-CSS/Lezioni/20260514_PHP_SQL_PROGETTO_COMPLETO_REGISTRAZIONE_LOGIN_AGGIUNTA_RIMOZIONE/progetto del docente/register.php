<?php
// -- creazione della sessione 
// - il protocollo HTTP senza la sessione sarebbe stateless(senza memoria)
// - ogni volta che invii i dati per il server saresti uno sconosciuto.
// - Quando crei la sessione i dati inviati vengono memorizzati $_SESSION[nome_chiave]
// - e il nostro server può inviare i dati salvati nelle pagine successive.

// -- collegamento hai file per il database e le funzioni
require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/functions.php';

// gestione errori
$get_error = $username_err = $email_err = $password_err = "";

// controlla che i dati inviati dal form siano con il metodo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // recupera i valori dal tag innput dall'attributo name
    // metodo htmlspecialchars() serve per sanificare i valori che arrivano dai campi input
    $username = sanifica($link, $_POST['username'] ?? '');
    $email = sanifica($link, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $ruolo = sanifica($link, $_POST['ruoli'] ?? 'user');

    // validzione dei campi input
    // se non è stato inserito nessun valore(!isset($username)) 
    // oppure se il campo è vuoto(empty($username))
    // stamperà il messaggio di errore.
    if (campoVuoto($username)) $username_err = "Inserisci username";

    if (campoVuoto($email)) $email_err = "Inserisci email";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $email_err = "Formato email non valido";

    // validazione password:
    $checkPass = validaPassword($password);
    if ($checkPass !== true) $password_err = $checkPass;

    // Contralla se tutti i campi sono stati riempiti
    if (empty($username_err) && empty($email_err) && empty($password_err)) {

        // cripta password
        $pass_criptata = cripta_password($password);

        // inserisci i valori nel DB
        $sql = "INSERT INTO utenti (username, email, password, ruoli)
               VALUES (?,?,?,?)";

        // $stmt: istruttore prt la preparazione dei dati.
        // mysqli_prepare($link, $sql): legge la connessione e contralla i segna-posto 
        if ($stmt = mysqli_prepare($link, $sql)) {
            //  mysqli_stmt_bind_param() chiede i campi del DB, il tipo di valori sa inserire es.(s= string, i= int)
            //  e come ultimo parametro passiamo tutte le variabili create.
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $pass_criptata, $ruolo);

            // salva i dati nel DB
            if (mysqli_stmt_execute($stmt)) {

                // recupera ID dell'utente appena creato
                $sql = "SELECT * FROM utenti WHERE email = ?";

                if ($stmt = mysqli_prepare($link, $sql)) {

                    // colleghiamo il valore dell'email (s= Stringa)
                    mysqli_stmt_bind_param($stmt, 's', $email);

                    // esgui la query 
                    if (mysqli_stmt_execute($stmt)) {

                        $result = mysqli_stmt_get_result($stmt);

                        // verifica se esiste l'utente
                        if ($user = mysqli_fetch_assoc($result)) {

                            // Login ricevuto! salviamo i dati nella sessione
                            // Creazione Sessione
                            $_SESSION['utente'] = [
                                'id' => $user['id'],
                                'username' => $username,
                                'email' => $email,
                                'ruolo' => $ruolo,
                                'password' => $password,
                                'loggato' => true,
                            ];

                            // Reindirizzare alla pagina profilo.
                            header('Location: home.php');
                            exit();
                        }
                    }
                } else {
                    $get_error = "Ops! Qualcosa è andato storto. Riprova più tardi.";
                }

                mysqli_stmt_close($stmt);
            }
        }
    }

    mysqli_close($link);
}

?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<style>
    .container {
        width: 60%;
        margin: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    form {
        display: flex;
        flex-direction: column;

    }

    .error {
        border-left: 3px solid red;
        background-color: #f7efef;
        font-weight: bold;
        padding: 10px;
    }
</style>

<body>

    <div class="container">

        <h2>Registrati</h2>
        <form action="register.php" method="post">
            <span class="<?php echo !empty($get_error) ? 'error' : '' ?>"> <?php echo $get_error; ?></span>
            <input type="text" name="username" placeholder="Inserisci username*">
            <span class="<?php echo !empty($username_err) ? 'error' : '' ?>"> <?php echo $username_err; ?></span>
            <input type="email" name="email" placeholder="Inserisci email*">
            <span class="<?php echo !empty($email_err) ? 'error' : '' ?>"> <?php echo $email_err; ?></span>
            <input type="password" name="password" placeholder="inserisci password*" required>
            <span class="<?php echo !empty($password_err) ? 'error' : '' ?>"> <?php echo $password_err; ?></span>
            <select name="ruoli">
                <option value="admin">ADMIN</option>
                <option value="user">USER</option>
                <option value="editor">EDITOR</option>

            </select>
            <input type="submit" class="btn" value="Invia">
        </form>
        <p>Hai già un account? <a href="login.php">Accedi</a></p>

        <table border>
            <tr>
                <th>Chiave</th>
                <th>Valore</th>
            </tr>
            <?php foreach ($_SERVER as $key => $value): ?>
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>