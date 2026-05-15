<?php
session_start();
require_once __DIR__ . '/DB/db_config.php';
require_once __DIR__ . '/functions.php';

if (!isset($_SESSION['utente']['loggato']) || $_SESSION['utente']['loggato'] !== true) {
    header('Location: login.php');
    exit();
}

$success = '';
$error = '';
$titolo = '';
$contenuto = '';

/**
 * Valida i dati del post
 */
function validaPost($titolo, $contenuto) {
    if (empty($titolo) || empty($contenuto)) {
        return "Tutti i campi devono essere compilati";
    }
    return '';
}

/**
 * Salva il post nel database
 */
function salvaPost($link, $titolo, $contenuto, $utente_id) {
    $sql = "INSERT INTO post (titolo, contenuto, utente_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        return "Errore nella preparazione della query";
    }

    mysqli_stmt_bind_param($stmt, "ssi", $titolo, $contenuto, $utente_id);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return "Errore durante il salvataggio del Post";
    }

    mysqli_stmt_close($stmt);
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titolo = sanifica($link, $_POST['titolo'] ?? '');
    $contenuto = sanifica($link, $_POST['contenuto'] ?? '');
    $utente_id = $_SESSION['utente']['id'];

    $error = validaPost($titolo, $contenuto);

    if ($error === '') {
        $error = salvaPost($link, $titolo, $contenuto, $utente_id);
    }

    if ($error === '') {
        $success = "Post creato con successo!";
        $titolo = '';
        $contenuto = '';
    }

    mysqli_close($link);
}

include __DIR__ . '/crea_post_form.php';
