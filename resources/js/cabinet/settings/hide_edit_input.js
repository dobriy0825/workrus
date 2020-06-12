import hideErrors from "../../common/errors/hide_errors";
import deletingClasses from "./deleting_classes";


let classes = ['edit_phone_btn', 'add_email_btn', 'edit_email_btn'];
let element = document.querySelector('.edit_input_popup .edit_input_btn');

export default function(){
    document.querySelector('.edit_input_popup .popup_title').innerHTML = '';
    document.querySelector('.edit_input_popup label').innerHTML = '';
    document.querySelector('.edit_input_popup .input').removeAttribute('name');
    document.querySelector('.edit_input_popup .input').value = '';
    document.querySelector('.edit_input_popup').style.display = 'none';
    hideErrors(document.querySelector('.edit_input_popup .edit_input_errors'));
    deletingClasses(classes, element);
};

