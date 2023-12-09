import { createList, iterationButtons } from "./function.js";


const tbody = document.querySelector("tbody");
let contacts = [];


export async function getFetch(url) {
    try {
        const response = await fetch(url);
        const data = await response.json();
        contacts = data["data"];
        console.log(data);
       return contacts;

    } catch (error) {
        console.log(error);
        alert(error['message']);
    }
}


export async function displayContact(url) {
    const contactes = await getFetch(url);
    tbody.innerHTML = "";
    createList(contactes, tbody);
    iterationButtons()
    console.log(contactes);
    contacts = contactes
}



export function addContact() {
    contacts.unshift({
        id: 22,
        prenom: "fghj",
        "nom": "hjk",
        libelle: 1
    });
    console.log(contacts);
}

export function filtreContact(value) {

}

export function postFetch(url,donnees) {
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        
        },
        body: JSON.stringify(donnees) 
    })
        .then(response =>  response.json())
        .then(data => {
            // Faire quelque chose avec les données de la réponse
            console.log(data);
            contacts.unshift(data["data"][0]);
            tbody.innerHTML = "";
            createList(contacts, tbody);
            iterationButtons()

        })
        .catch(error => {
            // Gérer les erreurs
            console.error('Erreur lors de la requête:', error);
            alert(error['message']);
        });

}


export function getContactById(id){
    const contact = contacts.filter(e => e.id == id);

    return contact[0];
}


