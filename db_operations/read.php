<?php
    require_once("database.php");

    //Inizializzo la lista dei task
    $taskList = [];

    //Scrivo la query
    $sql = "SELECT * FROM `tasks`;";

    //Lancio la query
    $result = $conn->query($sql);

    //Controllo che $result sia vera e che il numero di righe sia maggiore di zero
    if ($result && $result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $temp; //Variabile temporanea
            $temp['id'] = $row['id'];
            $temp['task'] = $row['task'];
            array_push($data, $temp); //Pushiamo la temporanea in $data
            $taskList[] = $row;
        }
        echo json_encode($data); //Codifichiamo in json $data
    }elseif ($result && $result->num_rows == 0) {
        $data = [];
        echo json_encode($data);
    }elseif (!$result) {
        $response[] = [
            "success" => false,
            "message" => "Errore nella query."
        ];
        echo json_encode($response);
    }
?>