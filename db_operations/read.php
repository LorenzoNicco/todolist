<?php
    //Inizializzo la lista dei task
    $taskList = [];

    //Scrivo la query
    $sql = "SELECT * FROM `tasks`;";

    //Lancio la query
    $result = $conn->query($sql);

    //Controllo che $result sia vera e che il numero di righe sia maggiore di zero
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $taskList[] = $row;
        }
    }elseif ($result) {
        echo "Nessun contenuto";
    }else {
        echo "Errore nella query: " . $conn->error;
    }
?>