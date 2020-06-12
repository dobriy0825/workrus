import deletingClasses from "./deleting_classes";

let classes = ['edit_phone_btn', 'add_email_btn', 'edit_email_btn'];
let element = document.querySelector('.edit_input_popup .edit_input_btn');
export default function(value, name, nameClass){
    deletingClasses(classes, element);
    document.querySelector('.edit_input_popup .popup_title').innerHTML = 'Введите ' + value;
    document.querySelector('.edit_input_popup label').innerHTML = value;
    document.querySelector('.edit_input_popup .input').setAttribute('name', name);
    document.querySelector('.edit_input_popup .input').value = '';
    document.querySelector('.edit_input_popup').style.display = 'flex';
    document.querySelector('.edit_input_popup .edit_input_btn').classList.add(nameClass);
    inputFocus();
}

function inputFocus() {
    document.querySelector('.edit_input_popup .input').focus();
}


