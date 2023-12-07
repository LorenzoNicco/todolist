let tasks;
let dataSection;

// Faccio comparire la tabella
getData();

// Salvo il form in una variabile
const formElement = document.getElementById("form-element");

//Prendo l'input principale
let mainInput = document.getElementById("task-input");

//Prendo i pulsanti del form
let btnCreate = document.getElementById("btn-create");
let btnEdit = document.getElementById("btn-edit");
let btnCancel = document.getElementById("btn-cancel");

// Catturo l'evento di submit
formElement.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Prendo i dati dal form e li salvo nella variabile da mandare
    const formData = new FormData(document.getElementById("form-element"));
    dataToInsert = Object.fromEntries(formData.entries());
    formData.append('data', dataToInsert);
    
    // Fetch dei dati per la CREATE
    fetch('./db_operations/create.php', {
        method: 'POST',
        header: {
            'Content-Type': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        getData();
        mainInput.value = '';
    })
    .catch((error) => {
        console.error('Errore: ', error);
    });
});

// Funzione per generare la tabella
function getData() {
    // Fetch dei dati per la READ
    fetch('./db_operations/read.php', {
        method: 'POST',
        header: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        tasks = data;

        dataSection = document.getElementById("data-section");

        let rowsContainer = `
            <div class="w-1/2 my-0 mx-auto p-7 rounded-xl bg-slate-200">
                ${rowsGenerator(tasks)}
            </div>
        `;

        dataSection.innerHTML = rowsContainer;

        // Prendo i pulsanti modifica ed elimina e aggiungo gli eventi
        let editBtns = document.querySelectorAll(".edit-task");
        let deleteBtns = document.querySelectorAll(".delete-task");

        for (let i = 0; i < editBtns.length; i++) {
            editBtns[i].addEventListener('click', editTask);
        }

        for (let i = 0; i < deleteBtns.length; i++) {
            deleteBtns[i].addEventListener('click', deleteTask);
        }
        })
    .catch((error) => {
        console.error('Errore: ', error);
    });
}

//Funzione attivazione edit
function editTask(e) {
    let taskId = e.currentTarget.dataset.val;
    console.log("Task modificato: ", taskId);
    
    const formData = new FormData(formElement);
    formData.append('id', taskId);
    
    // Fetch dei dati per la trovare il task da modificare
    fetch('./db_operations/edit.php', {
        method: 'POST',
        header: {
            'Content-Type': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        mainInput.value = data.task;

        btnCreate.classList.add("hidden");
        btnEdit.classList.remove("hidden");
        btnCancel.classList.remove("hidden");
    })
    .catch((error) => {
        console.error('Errore: ', error);
    });
    
}

//Evento annulla
btnCancel.addEventListener('click', (e) =>{
    e.preventDefault();

    mainInput.value = '';
    btnCreate.classList.remove("hidden");
    btnEdit.classList.add("hidden");
    btnCancel.classList.add("hidden");
});

//Funzione elimina
function deleteTask(e) {
    let taskId = e.currentTarget.dataset.val;
    console.log("Task eliminato: ", taskId);

    const formData = new FormData(formElement);
    formData.append('id', taskId);

    // Fetch dei dati per la DELETE
    fetch('./db_operations/delete.php', {
        method: 'POST',
        header: {
            'Content-Type': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        getData();
    })
    .catch((error) => {
        console.error('Errore: ', error);
    });
}

//Funzione per generare le righe di dati
function rowsGenerator(item) {
    let rows = [];

    if (item.length == 0) {
        let singleRow = `
        <p class="text-center mb-3">Nessun Task presente</p>
        `;

        rows.push(singleRow);
    }else {
        item.forEach(singleItem => {       
            let singleRow = `
            <div class="flex justify-between items-center mb-3">
                <p class="grow self-stretch ps-1 py-1 rounded border-2 me-2 bg-white border-slate-600">${singleItem.task}</p>
                
                <div>
                    <button data-val="${singleItem.id}" class="edit-task bg-yellow-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button data-val="${singleItem.id}" class="delete-task bg-red-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-trash-can"></i></button>
                </div>
            </div>
            `;

            rows.push(singleRow);
        });

        let clearBtn = `
        <form method="POST" class="text-center">
            <button type="submit" id="btn-clear" name="clear" class="bg-red-500 text-white py-1.5 px-2 rounded">Elimina tutti i task</button>
        </form>
        `;

        rows.push(clearBtn);
    }

    return rows;
}