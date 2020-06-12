import ajaxPost from '../../common/ajaxPOST';
import Timer from "../../common/timer";
import showErrors from "../../common/errors/show_errors";
import showVerifyPhone from "../../common/show_verify_phone";
import hideErrors from '../../common/errors/hide_errors';

let errorsRegister = document.querySelector('.errors_register');

export default async function () {
    let result = await ajaxPost('/register', document.forms.form_register);
    let response = JSON.parse(result);
    if (response.time) {
        let elem1 = document.querySelector('.minutes');
        let elem2 = document.querySelector('.seconds');
        let timer = new Timer(response.time, elem1, elem2);
        timer.start();
        showVerifyPhone();
        hideErrors(errorsRegister);
    }
    if (response.valid){
        document.querySelector('input[name=phone]').focus();
        showErrors(response.valid, errorsRegister);
    }
}
