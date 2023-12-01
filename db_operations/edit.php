<?php
    global $conn;

    if (isset($_GET['edit'])) {
        $idTarget = intVal($_GET['edit']);
        $editFlag = true;

        $sql = "SELECT `task` FROM `tasks` WHERE `id`=$idTarget;";

        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $oldTask = $result->fetch_assoc();
        }
    }
?>