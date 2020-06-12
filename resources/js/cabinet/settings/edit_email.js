import ajaxPost from "../../common/ajaxPOST";
import showErrors from "../../common/errors/show_errors";
import hideEditInput from "./hide_edit_input";

let errorsEditInput = document.querySelector('.edit_input_popup .edit_input_errors');

export default async function () {
    let result = await ajaxPost('/cabinet/settings/edit_email', document.forms.edit_input);
    let response = JSON.parse(result);
    if (response.valid){
        showErrors(response.valid, errorsEditInput);
    }
    if (response.id){
        hideEditInput();
        document.querySelector('.about_check_email').style.display = 'flex';
    }
}
