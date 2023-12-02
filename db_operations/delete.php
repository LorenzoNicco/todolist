<?php
    //Verifico che la richiesta sia delete
    if (isset($_GET['delete'])) {
        //Prendo l'id dell'elemento da eliminare
        $idTargetDelete = intVal($_GET['delete']);

        //Scrivo la query e la lancio
        $sql = "DELETE FROM `tasks` WHERE `id`=$idTargetDelete;";
        $conn->query($sql);

        //Ricarico la pagina
        header('location: index.php');
    }

    if (isset($_POST['clear'])) {
        $sql = "DELETE FROM `tasks`";
        $conn->query($sql);
        //Ricarico la pagina
        header('location: index.php');
    }
?>