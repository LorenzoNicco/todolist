<?php
    global $conn;

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

    if (isset($_POST['update'])) {
        //Prendo il nuovo nome e il riferimento del task
        $taskUpdatedName = $_POST['new-task'];
        $taskUpdatedId = intVal($_POST['id']);

        //Lancio la query e ricarico la pagina
        $sql = "UPDATE `tasks` SET `task`='$taskUpdatedName' WHERE `id`=$taskUpdatedId;";
        header('location: index.php');

        //Verifico che la modifica sia andata a buon fine
        if ($conn->query($sql) === true) {
            echo "Task aggiornato con successo!";
        }else {
            echo "Errore nell'aggiornamento del task: " . $conn->error;
        }
    }
?>