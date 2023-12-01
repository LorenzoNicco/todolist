<?php
    //Definizione costanti con parametri database
    define("DB_SERVERNAME", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "root");
    define("DB_NAME", "todolist");

    $editFlag = false;

    //Connessione database
    $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Verifica connessione
    if ($conn && $conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    
    include 'create.php';
    include 'read.php';
    include 'edit.php';
?>