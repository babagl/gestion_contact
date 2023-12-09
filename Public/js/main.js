import { addContact, postFetch } from "./fetch.js";
import { getAllContact } from "./service.js";


console.log("main is workong");
const btnDelete = document.querySelector('#btn_delete');
const filtre = document.querySelector('#filtre');
const prenom = document.querySelector('#prenom');
const nom = document.querySelector('#nom');
const categorie = document.querySelector('#categorie');
const submit = document.querySelector('#submit');


const url = 'http://localhost:8000/contact/';
getAllContact(url+'contact');
btnDelete.addEventListener('click', ()=>{
  addContact();
})
filtre.addEventListener('change', ()=>{
  console.log(filtre.value);
})
submit.addEventListener('click', ()=>{
  if(prenom.value == "" || nom.value == "" || categorie.value == "" ){
    alert('veuiller remplir tous les champs pour pouvoir ajouter un nouveau contact')
  }else{
    console.log({
      "prenom" : prenom.value,
      "nom" : nom.value,
      "categorie" : categorie.value,
    });
    postFetch(url+'add',{
      "prenom" : prenom.value,
      "nom" : nom.value,
      "categorie" : categorie.value,
    })

  }
})
// URL de l'API que vous souhaitez interroger



// Utilisation de la fonction fetch pour effectuer une requête GET

