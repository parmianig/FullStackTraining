<?php
// -- dati di connnessione al database --
$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'Libreria';

// --creazione della connessione al database --
define('DB_HOST', $host);
define('DB_USERNAME', $username);
define('DB_PASSWORD', $password);
define('DB_NAME', $dbname);

// --  chiamata al DB per le query
$link= mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, 8889);

function getDbConnection(): mysqli
{
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$link) {
        $error = 'Errore di connessione: ' . mysqli_connect_error();
        die($error);
    }

    if (!empty(mysqli_error($link))) {
        $error = "errore di connessione" . mysqli_error($link);
        die($error);
    }

    return $link;
}

// -- chiamata alla funzione di connessione al database --
function sanifica(mysqli $link, string $data): string
{
    // pulisco i dati da spazi bianchi, backslash e caratteri speciali
    $data = trim($data);
    // rimuove i backslash
    $data = stripslashes($data);
    // converte i caratteri speciali in entità HTML
    $data = htmlspecialchars($data);
    // invio i dati al database in modo sicuro e sanificati
    $data = mysqli_real_escape_string($link, $data);
    return $data;
}

// -- password hashing --
function hashPassword(string $password): string
{
    // utilizzo bcrypt per l'hashing della password
    return password_hash($password, PASSWORD_DEFAULT);
}

// -- creazione della sessione utente --
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
