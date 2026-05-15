<?php

// creazione della sessione
session_start();

if (!isset($_SESSION['utente'])) {
    // se non hai fatto la registrazione non puoi 
    // accedere alla pagina home
    header("Location: register.php");
    exit();
}

// se sei loggato recupera la sessione utente con l'array associativo
$user = $_SESSION['utente'];
// eliminalo in fase di produzione
print_r($user)

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - <?php echo strtoupper($user['username']) ?></title>

    <style>
        .post {
            padding: 10px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;

        }
    </style>
</head>

<body>

    <h1>Benvenuto <?php echo $user['username'] ?> </h1>
    <p>La tua email: <?php echo $user['email'] ?> </p>
    <p>Il tuo ruolo: <?php echo $user['ruolo'] ?> </p>

    <hr>
    <a href="logout.php">Esci (Distruggi la sessione) </a>

    <hr>
    <h3>Gestione dei post</h3>
    <a href="crea_post.php" class="post"> + Crea Nuovo Post</a>


</body>

</html>