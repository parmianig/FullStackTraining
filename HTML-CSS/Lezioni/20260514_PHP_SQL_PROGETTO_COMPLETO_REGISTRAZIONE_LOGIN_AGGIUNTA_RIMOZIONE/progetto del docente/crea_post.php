<?php

require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/functions.php';

if (!isset($_SESSION['utente']['loggato'])) {
    header('Location: login.php');
    exit();
}

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // RECUPERO DEI DATI PER LA SANIFICAZIONE.
    $titolo = sanifica($link, $_POST['titolo'] ?? '');
    $contenuto = sanifica($link, $_POST['contenuto'] ?? '');
    $utente_id = $_SESSION['utente']['id'];

    if (empty($titolo) || empty($contenuto)) {

        $error = "Tutti i campi devono essere compilati";
    } else {

        // Creazione delle query per salvare il post con l'utente 
        $sql = "INSERT INTO post (titolo, contenuto, utente_id)
               VALUES (?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // ss (stringhe) i (interi)
            mysqli_stmt_bind_param($stmt, "ssi", $titolo, $contenuto, $utente_id);

            if (mysqli_stmt_execute($stmt)) {

                $success = "Post creato con successo!";
                // Rimanda alla pagina home dopo 2secondi
                header("refresh:2; url=home.php");
            } else {

                $error = "Errrore durante il salvataggio del Post";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Post</title>

    <style>
        .container {
            width: 50%;
            margin: auto;
            font-family: sans-serif;
        }

        form {

            display: flex;
            flex-direction: column;
            gap: 15px;

        }

        input,
        textarea {
            padding: 10px;
        }

        textarea {
            height: 150px;
        }

        .msg {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;

        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #8d1f2a
        }

        .btn {
            background-color: rgb(49, 164, 240);
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
    </style>

</head>

<body>

    <div class="container">


        <h2>Crea il tuo post</h2>
        <a href="home.php"> Torna alla home</a>
        <br><br>

        <?php if ($success): ?>
            <div class="msg success">
                <?php echo $success ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="msg error">
                <?php echo $error ?>
            </div>
        <?php endif; ?>

        <form action="crea_post.php" method="POST">

            <input type="text" name="titolo" placeholder="Inserisci il titolo:">
            <textarea name="contenuto" placeholder="Scrivi il tuo post...."></textarea>
            <input type="submit" class="btn" value="Pubblica Post">
        </form>


    </div>
</body>

</html>