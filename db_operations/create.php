<?php
    require_once("database.php");

    //Salvataggio nuovo task in una variabile, prevenendo sql injection
    $newTask = $conn->real_escape_string($_POST['new-task']);

    //Verifico che il task non sia vuoto
    if (!empty($newTask)) {
        //Scrivo la mia query
        $sql = "INSERT INTO `tasks` (task) VALUES ('$newTask');";
        if ($conn->query($sql) === true) {
            $response[] = [
                "success" => true,
                "message" => "Task inserito"
            ];
            echo json_encode($response);
        }else {
            $response[] = [
                "success" => false,
                "message" => "Errore nell'inserimento del task"
            ];
            echo json_encode($response);
        }
    }
    else {
        $response[] = [
            "success" => false,
            "message" => "Il task non può essere vuoto."
        ];
        echo json_encode($response);
    }
?>