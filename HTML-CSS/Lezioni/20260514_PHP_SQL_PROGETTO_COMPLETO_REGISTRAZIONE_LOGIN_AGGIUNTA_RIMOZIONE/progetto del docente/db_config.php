<?php

// ------------- Connessione al DB
// -- creazione delle costanti per la connessione al DB
define('DB_SERVER', 'localhost'); // 127.0.0.1(localhost)
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', 'root');
define('DB_NAME', 'blog_system');

// --  chiamata al DB per le query
$link= mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// -- Controllo della connessione
if($link === false){

    die("Errore: Impossibile connettersi ". mysqli_connect_error());

}

?>

