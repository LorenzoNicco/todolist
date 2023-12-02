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
        <!-- Connessione FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <h1 class="text-center text-3xl font-bold my-7">TODO List</h1>

        <!-- Form di inserimento dati -->
        <form method="POST" action="" class="w-1/2 text-center my-0 mx-auto mb-5">
            <!-- Input nascosto per l'id -->
            <input type="hidden" name="id" value="<?php echo $oldTask['id']; ?>">

            <input id="task-input" class="w-1/2 ps-1 py-1 rounded border-2 me-2" type="text" placeholder="Inserisci un task" name="new-task" value="<?php echo $oldTask['task']; ?>" required>

            <?php if ($editFlag === false) { ?>
                <button type="submit" id="btn-create" name="save" class="bg-cyan-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-floppy-disk"></i></button>
            <?php }else { ?>
                <button type="submit" id="btn-create" name="update" class="bg-emerald-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-check"></i></button>
            <?php } ?>
        </form>

        <div class="w-1/2 my-0 mx-auto p-7 rounded-xl bg-slate-200">
            <?php foreach ($taskList as $singleTask) { ?>
                <div class="flex justify-between items-center mb-3">
                    <!-- Mostra nome task -->
                    <p class="grow self-stretch ps-1 py-1 rounded border-2 me-2 bg-white border-slate-600"><?php echo $singleTask['task']; ?></p>
    
                    <!-- Pulsanti modifica/elimina -->
                    <div>
                        <a href="index.php?edit=<?php echo $singleTask['id']; ?>" class="bg-yellow-500 text-white py-1.5 px-2 rounded" ><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="index.php?delete=<?php echo $singleTask['id']; ?>" class="bg-red-500 text-white py-1.5 px-2 rounded" ><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <script type="text/javascript" src="script.js"></script>
    </body>
</html>