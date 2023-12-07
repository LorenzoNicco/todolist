<?php
    require_once("database.php");
    
    //Prendo l'id dell'elemento da eliminare
    $idTargetDelete = intVal($_POST['id']);

    //Scrivo la query e la lancio
    $sql = "DELETE FROM `tasks` WHERE `id`=$idTargetDelete;";
    if ($conn->query($sql) === true) {
        $response[] = [
            "success" => true,
            "message" => "Task eliminato"
        ];
        echo json_encode($response);
    }else {
        $response[] = [
            "success" => false,
            "message" => "Problemi durante l'eliminazione del Task."
        ];
        echo json_encode($response);
    }


    //Verifico che POST sia impostato su clear
    // if (isset($_POST['clear'])) {
    //     $sql = "DELETE FROM `tasks`";
    //     $conn->query($sql);
    //     //Ricarico la pagina
    //     header('location: index.php');
    // }
?>