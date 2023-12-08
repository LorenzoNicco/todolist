<?php
    require_once("database.php");

    if ($_POST['flag'] == 0) {
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
    }elseif ($_POST['flag'] == 1) {
        $sql = "DELETE FROM `tasks`";
        if ($conn->query($sql)) {
            $response[] = [
                "success" => true,
                "message" => "Tutti i Task eliminati"
            ];
            echo json_encode($response);
        }else {
            $response[] = [
                "success" => false,
                "message" => "Problemi durante l'eliminazione dei Task."
            ];
            echo json_encode($response);
        }
    }
?>