<?php

function sanifica(mysqli $link, string $dati): string
{

    $dati = trim($dati);
    $dati = stripslashes($dati);
    $dati = htmlspecialchars($dati);
    // invio dei dati al DB sanificati
    return mysqli_real_escape_string($link, $dati);
}


// -------- Password Criptazione
function cripta_password(string $password): string
{
    // funzione per criptare la password con una codifica di PHP( PASSWORD_DEFAULT)
    // return restituisce il valore di criptazione SHA 255
    return password_hash($password, PASSWORD_DEFAULT);
}

// crazione della sessione utente, se la sessione non è stata creata la deve creare.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


function campoVuoto(mixed $campo): bool
{

    return !isset($campo) || empty($campo);
}


function validaPassword(string $password)
{

    // lunghezza della stringa
    if (strlen($password) < 8) {
        return "La password deve essere di almeno 8 caratteri";
    }

    // Controlla lettera maiuscola
    if (!preg_match("/[A-Z]/", $password)) {
        return "La password deve avere almeno una lettera maiuscola";
    }

    // Controlla lettera minuscola
    if (!preg_match("/[a-z]/", $password)) {
        return "La password deve avere almeno una lettera minuscola";
    }

    // Controlla i numeri
    if (!preg_match("/[0-9]/", $password)) {
        return "La password deve avere almeno un numero";
    }

    // Controlla i caratteri speciali
    // nei controlli preg_match \W indica qualsiasi carattere che non è una lettera
    // o numero
    if (!preg_match("/[\W]/", $password)) {
        return "La password deve avere almeno un carattere speciale";
    }

    return true;
}
