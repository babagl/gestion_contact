import { getContactById } from "./fetch.js";

 function creatLine(tbody, contact) {
    let tr = document.createElement('tr');
    tr.innerHTML = `
   
    <td>
        <input type="checkbox" name="" id="${contact['id']}">
    </td>
    <td>${contact['prenom']}</td>
    <td>${contact['nom']}</td>
    <td>${contact["libelle"]}</td>
    <td><div class="wrap edit"> <a href="#" class="btn btn-big" id="${contact['id']}">Edit</a></div></td>
`;
    tbody.appendChild(tr);
}

export function createList(data, tbody){
    data.forEach(element => {
        creatLine(tbody, element);
    });
}

function checkContactById(id) {
    alert(id)
}





export function iterationButtons() {    
let editButtons = document.querySelectorAll('.edit')
    editButtons.forEach(element => {
      element.addEventListener('click',(e)=>{
        const idContact = e.target.id;
        console.log(getContactById(idContact));
      })
    });
  }







