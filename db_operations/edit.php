<?php
    require_once("database.php");
    
    //Quando clicco sul pulsante modifica, vado a leggere la richiesta get
    if (isset($_GET['edit'])) {
        //Salvo il contenuto della richiesta in una variabile per usarla come riferimento e cambio la flag
        $idTarget = intVal($_GET['edit']);
        $editFlag = true;
        
        //Creo la query e la lancio
        $sql = "SELECT * FROM `tasks` WHERE `id`=$idTarget;";
        $result = $conn->query($sql);

        //Salvo il risultato in una variabile per stamparlo
        if ($result && $result->num_rows == 1) {
            $oldTask = $result->fetch_assoc();
        }
    }

    //Verifico che la richiesta sia update
    if (isset($_POST['update'])) {
        //Prendo il nuovo nome e il riferimento del task
        $taskUpdatedName = $conn->real_escape_string($_POST['new-task']);
        $taskUpdatedId = intVal($_POST['id']);

        if (!empty($taskUpdatedName)) {
            //Lancio la query e ricarico la pagina
            $sql = "UPDATE `tasks` SET `task`='$taskUpdatedName' WHERE `id`=$taskUpdatedId;";
            $conn->query($sql);
            header('location: index.php');
        }
        else {
            echo "Il task non può essere vuoto";
        }
    }
?>