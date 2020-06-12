import ajaxPost from "../../common/ajaxPOST";
import showErrors from "../../common/errors/show_errors";
import hideErrors from "../../common/errors/hide_errors";
export function showEditPassword() {
    document.querySelector('.edit_password_popup').style.display = 'flex';
}
let divErrors = document.querySelector('.edit_password_popup .edit_password_errors');
export function hideEditPassword() {
    document.querySelector('.edit_password_popup').style.display = 'none';
    hideErrors(divErrors);
}

export async function changePassword() {
    let result = await ajaxPost('/cabinet/settings/change_password', document.forms.edit_password);
    let response = JSON.parse(result);
    console.log(response);
    if (response.errors){
        showErrors(response.errors, divErrors);
    }else {
        hideEditPassword();
    }
}
