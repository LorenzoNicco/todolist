<?php
    include './db_operations/database.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TODO List</title>

        <!-- Connessione tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <h1 class="text-center text-3xl font-bold my-7">TODO List</h1>

        <!-- Form di inserimento dati -->
        <form method="POST" action="" class="">
            <!-- Input nascosto per l'id -->
            <input type="hidden" name="id" value="<?php echo $oldTask['id']; ?>">

            <input id="task-input" type="text" placeholder="Inserisci un task" name="new-task" value="<?php echo $oldTask['task']; ?>" required>

            <?php if ($editFlag === false) { ?>
                <button type="submit" id="btn-create" name="save" class="bg-cyan-500 text-white">Salva</button>
            <?php }else { ?>
                <button type="submit" id="btn-create" name="update" class="bg-cyan-500 text-white">Modifica</button>
            <?php } ?>
        </form>

        <?php foreach ($taskList as $singleTask) { ?>
            <div>
                <!-- Mostra nome task -->
                <p class="inline-block w-24"><?php echo $singleTask['task']; ?></p>

                <!-- Pulsanti modifica/elimina -->
                <a href="index.php?edit=<?php echo $singleTask['id']; ?>" class="bg-yellow-500 text-white" >Modifica</a>
                <a href="index.php?delete=<?php echo $singleTask['id']; ?>" class="bg-red-500 text-white" >Elimina</a>
            </div>
        <?php } ?>

        <script type="text/javascript" src="script.js"></script>
    </body>
</html>