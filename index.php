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
        <form id="form-element" method="POST" action="" class="w-1/2 text-center my-0 mx-auto mb-5">
            <!-- Input nascosto per l'id -->
            <!-- <input id="id-input" type="hidden" name="id"> -->

            <input id="task-input" class="w-1/2 ps-1 py-1 rounded border-2 me-2" type="text" placeholder="Inserisci un task" name="new-task" required>

                <button type="submit" id="btn-create" name="save" class="bg-cyan-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-floppy-disk"></i></button>
<!--      
                <button type="submit" id="btn-edit" name="update" class="bg-emerald-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-check"></i></button>
                <a href="index.php" class="bg-red-400 text-white py-1.5 px-2 rounded inline-block" ><i class="fa-solid fa-xmark"></i></a> -->

        </form>

        <div id="data-section"></div>

        <script type="text/javascript" src="script.js"></script>
    </body>
</html>