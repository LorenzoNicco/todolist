<?php
    require_once("database.php");
    
    $idTargetUpdate = intVal($_POST['id']);
    
    //Creo la query e la lancio
    $sql = "SELECT * FROM `tasks` WHERE `id`=$idTargetUpdate;";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_assoc();
        echo json_encode($data); //Rimando indietro il task bersaglio
    }else {
        $response[] = [
            "success" => false,
            "message" => "Task non trovato"
        ];
        echo json_encode($response);
    }

    //Verifico che la richiesta sia update
    // if (isset($_POST['update'])) {
    //     //Prendo il nuovo nome e il riferimento del task
    //     $taskUpdatedName = $conn->real_escape_string($_POST['new-task']);
    //     $taskUpdatedId = intVal($_POST['id']);

    //     if (!empty($taskUpdatedName)) {
    //         //Lancio la query e ricarico la pagina
    //         $sql = "UPDATE `tasks` SET `task`='$taskUpdatedName' WHERE `id`=$taskUpdatedId;";
    //         $conn->query($sql);
    //         header('location: index.php');
    //     }
    //     else {
    //         echo "Il task non può essere vuoto";
    //     }
    // }
?>