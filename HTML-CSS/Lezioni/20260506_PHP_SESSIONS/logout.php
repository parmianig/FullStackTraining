<?php
session_start();

$_SESSION = [];
session_unset();
session_destroy();

session_start();
$_SESSION['flash'] = 'Hai effettuato il logout con successo.';

header('Location: register.php');
exit();
?>