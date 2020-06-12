import ajaxPost from '../../../common/ajaxPOST';
import showErrors from "../../../common/errors/show_errors";
import Timer from "../../../common/timer";
import showVerifyPhone from "../../../common/show_verify_phone";
import hideEditInput from "../hide_edit_input";

let a = document.querySelector('.edit_phone_popup .edit_phone_popup');
let errorsEditInput = document.querySelector('.edit_input_popup .edit_input_errors');

export default async function() {
    let response = await ajaxPost( '/cabinet/settings/edit_phone', document.forms.edit_input);

    let result = JSON.parse(response);
    console.log(result,3)
    if (result.time) {
        hideEditInput();
        let elem1 = document.querySelector('.minutes');
        let elem2 = document.querySelector('.seconds');
        let timer = new Timer(result.time, elem1, elem2);
        timer.start();
        showVerifyPhone();
    } else {
        showErrors(result.errors, errorsEditInput);
    }
}












function activateResendCode() {
    document.querySelector('.verify_phone_popup .resend_code_btn').removeAttribute('disabled');
    document.querySelector('.verify_phone_popup .resend_code_btn').style.color = '#006363';
}


























