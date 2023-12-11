let tasks;
let dataSection = document.getElementById("data-section");

// Faccio comparire la tabella
getData();

//Inizializzo una flag per la modifica
let editFlag = 0;

//Inizializzo una flag per l'eliminazione
let deleteFlag = 0;

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

        let rowsContainer = `
            <div class="w-1/2 my-0 mx-auto p-7 rounded-xl bg-slate-200 text-center">
                ${rowsGenerator(tasks)}
            </div>
        `;

        dataSection.innerHTML = rowsContainer;
        //Prendo il pulsante per eliminare tutti i task
        let btnClear = document.getElementById("btn-clear");
        
        //Evento cancella tutto
        if (btnClear) {
            btnClear.addEventListener('click', (e)=>{
                e.preventDefault();
                deleteAll();
            });
        }

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
    formData.append('flag', editFlag);
    
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
        btnEdit.dataset.val = data.id;

        btnCreate.classList.add("hidden");
        btnEdit.classList.remove("hidden");
        btnCancel.classList.remove("hidden");

        editFlag = 1;
    })
    .catch((error) => {
        console.error('Errore: ', error);
    });    
}

//Evento modifica
btnEdit.addEventListener('click', (e) =>{
    e.preventDefault();
    taskId = btnEdit.dataset.val;
    editFlag = 1;

    // Prendo i dati dal form e li salvo nella variabile da mandare
    const formData = new FormData(document.getElementById("form-element"));
    dataToInsert = Object.fromEntries(formData.entries());
    formData.append('data', dataToInsert);
    formData.append('id', taskId);
    formData.append('flag', editFlag);
    
    // Fetch dei dati per la CREATE
    fetch('./db_operations/edit.php', {
        method: 'POST',
        header: {
            'Content-Type': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        getData();
        clearInput();
    })
    .catch((error) => {
        console.error('Errore: ', error);
    });
});

//Evento annulla
btnCancel.addEventListener('click', (e) =>{
    e.preventDefault();
    clearInput();
});

// Funzione azzera input
function clearInput() {
    mainInput.value = '';
    btnCreate.classList.remove("hidden");
    btnEdit.classList.add("hidden");
    btnCancel.classList.add("hidden");
    editFlag = 0;
}

//Funzione elimina una riga
function deleteTask(e) {
    let taskId = e.currentTarget.dataset.val;
    console.log("Task eliminato: ", taskId);
    
    const formData = new FormData(formElement);
    formData.append('id', taskId);
    formData.append('flag', deleteFlag);

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

//Funzione elimina tutto
function deleteAll(e) {
    deleteFlag = 1;
    
    const formData = new FormData(formElement);
    formData.append('flag', deleteFlag);

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
        deleteFlag = 0;
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
            <button id="btn-clear" class="bg-red-500 text-white py-1.5 px-2 mt-5 rounded">Elimina tutti i task</button>
        `;

        rows.push(clearBtn);
    }

    return rows;
}