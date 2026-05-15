<?php

<?php
require_once __DIR__ . '/DB/db_config.php';
require_once __DIR__ . '/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $error = validateLoginData($email, $password);
    if ($error !== '') {
        renderLoginPage($error, $email);
        exit;
    }

    $user = getUserByEmail($link, $email);
    if (!$user) {
        renderLoginPage('Nessun account trovato con questa email', $email);
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        renderLoginPage('Password errata', $email);
        exit;
    }

    loginUser($user);
    header('Location: home.php');
    exit;
}

renderLoginPage($error);
exit;

function validateLoginData(string $email, string $password): string
{
    if ($email === '' || $password === '') {
        return 'Compila tutti i campi';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Email non valida';
    }

    return '';
}

function getUserByEmail(mysqli $link, string $email): ?array
{
    $sql = "SELECT * FROM utenti WHERE email = ?";
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        return null;
    }

    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result) ?: null;
    mysqli_stmt_close($stmt);

    return $user;
}

function loginUser(array $user): void
{
    $_SESSION['utente'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'ruolo' => $user['ruoli'],
        'loggato' => true,
    ];
}

function renderLoginPage(string $error = '', string $email = ''): void
{
    include __DIR__ . '/login_form.php';
}
?>
