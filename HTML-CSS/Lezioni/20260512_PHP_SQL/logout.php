<?php
require_once __DIR__ . '/DB/db_config.php';

session_unset();
session_destroy();

if (isset($link)) {
    mysqli_close($link);
}

header('Location: login.php');
exit();
?>

<?php
mysqli_close($link);
?>