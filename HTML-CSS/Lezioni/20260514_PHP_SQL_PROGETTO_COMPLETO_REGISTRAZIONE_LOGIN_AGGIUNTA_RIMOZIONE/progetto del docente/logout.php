<?php

session_start();
// rimuve le variabili all'interno della sessione
session_unset();
// distrugge la sessione sul server
session_destroy();

header("Location: register.php");
exit();
