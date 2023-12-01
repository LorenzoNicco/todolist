<?php
    //Verifico che la richiesta sia create
    if (isset($_POST['save'])) {
        //Salvataggio nuovo task in una variabile, prevenendo sql injection
        $newTask = $conn->real_escape_string($_POST['new-task']);
    
        //Verifico che il task non sia vuoto
        if (!empty($newTask)) {
            //Scrivo la mia query e la salvo in una variabile
            $sql = "INSERT INTO `tasks` (task) VALUES ('$newTask');";
            $conn->query($sql);
        }
        else {
            echo "Il task non può essere vuoto";
        }
    }
?>