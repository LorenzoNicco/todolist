let tasks;
let dataSection;

// Faccio comparire la tabella
getData();

// Salvo il form in una variabile
const formElement = document.getElementById("form-element");

// Catturo l'evento di submit
formElement.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Prendo i dati dal form e li salvo nella variabile da mandare
    const formData = new FormData(document.getElementById("form-element"));
    dataToInsert = Object.fromEntries(formData.entries());
    formData.append('data', dataToInsert);

    console.log("formData", formData);
    console.log("data", dataToInsert);
    
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
        console.log('Dati ricevuti', data);
        getData();
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
        console.log('Dati ricevuti', data);

        dataSection = document.getElementById("data-section");

        let rowsContainer = `
            <div class="w-1/2 my-0 mx-auto p-7 rounded-xl bg-slate-200">
                ${rowsGenerator(tasks)}
                
                <form method="POST" class="text-center">
                    <button type="submit" id="btn-clear" name="clear" class="bg-red-500 text-white py-1.5 px-2 rounded">Elimina tutti i task</button>
                </form>
            </div>
        `;

        dataSection.innerHTML = rowsContainer;
        })
    .catch((error) => {
        console.error('Errore: ', error);
    });
}

//Funzione per generare le righe di dati
function rowsGenerator(item) {
    let rows = [];

    if (item.lenght == 0) {
        let singleRow = `
        <p class="text-center">Nessun Task presente</p>
        `;

        rows.push(singleRow);
    }else {
        item.forEach(singleItem => {           
            let singleRow = `
            <div class="flex justify-between items-center mb-3">
                <p class="grow self-stretch ps-1 py-1 rounded border-2 me-2 bg-white border-slate-600">${singleItem.task}</p>
                
                <div>
                    <a href="index.php?edit=${singleItem.id}" class="bg-yellow-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="index.php?delete=${singleItem.id}" class="bg-red-500 text-white py-1.5 px-2 rounded"><i class="fa-solid fa-trash-can"></i></a>
                </div>
            </div>
            `;

            rows.push(singleRow);
        });

    }

    return rows;
}