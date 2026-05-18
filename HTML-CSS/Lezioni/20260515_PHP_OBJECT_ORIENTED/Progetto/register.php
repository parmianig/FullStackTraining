<?php

declare(strict_types=1);

require_once __DIR__ . '/persona.php';
require_once __DIR__ . '/post.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$validRoles = ['user', 'editor', 'admin'];

function sanitizeInput(?string $value): string
{
    return trim((string) $value);
}

function filterRoles(array $roles, array $validRoles): array
{
    $filtered = array_filter(array_map('trim', $roles), static function (string $role) use ($validRoles): bool {
        return in_array($role, $validRoles, true);
    });

    return array_values(array_unique($filtered));
}

function addFlashMessage(string $message): void
{
    $_SESSION['flash_message'] = $message;
}

function redirectToIndex(string $message, int $statusCode = 303): void
{
    addFlashMessage($message);
    header('Location: index.php', true, $statusCode);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectToIndex('Richiesta non valida.');
}

$action = trim((string) ($_POST['action'] ?? ''));

if ($action === 'register') {
    $nome = sanitizeInput($_POST['nome'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $ruoli = filterRoles((array) ($_POST['ruoli'] ?? []), $validRoles);

    if ($nome === '') {
        redirectToIndex('Il nome è obbligatorio.');
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirectToIndex('L\'email non è valida.');
    }

    if ($ruoli === []) {
        redirectToIndex('Devi selezionare almeno un ruolo valido.');
    }

    try {
        $persona = new Persona($nome, $email, $ruoli);
        $_SESSION['utente_creato'] = $persona;
        redirectToIndex('Utente creato con successo.');
    } catch (InvalidArgumentException $exception) {
        redirectToIndex($exception->getMessage());
    }
}

if ($action === 'publish_post') {
    $persona = $_SESSION['utente_creato'] ?? null;

    if (!$persona instanceof Persona) {
        redirectToIndex('Devi prima registrarti prima di creare un post.');
    }

    if (!$persona->hasRole('admin') && !$persona->hasRole('editor')) {
        redirectToIndex('Non hai i permessi per creare un post.');
    }

    $titolo = sanitizeInput($_POST['titolo'] ?? '');
    $contenuto = sanitizeInput($_POST['contenuto'] ?? '');

    if ($titolo === '') {
        redirectToIndex('Il titolo del post è obbligatorio.');
    }

    if ($contenuto === '') {
        redirectToIndex('Il contenuto del post è obbligatorio.');
    }

    $post = new Post($titolo, $contenuto, $persona);
    $_SESSION['ultimo_post'] = [
        'titolo' => $post->getTitolo(),
        'contenuto' => $post->getContenuto(),
    ];

    redirectToIndex('Il post è stato pubblicato.');
}

redirectToIndex('Azione non valida.');

