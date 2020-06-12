import ajaxPost from "./ajaxPOST";
import showErrors from './errors/show_errors';
import hideVerifyPhone from  '../common/hide_verify_phone';

let errorsVerifyPhone = document.querySelector('.verify_phone_popup .errors_popup');

export default async function(url, form) {
    let result = await ajaxPost(url, form);
    let response = JSON.parse(result);
    if (response.view){
        hideVerifyPhone();
        document.querySelector('section').innerHTML = response.view;
    }
    if (response.phone){
        hideVerifyPhone();
        document.querySelector('.workerStyle__val_phone').innerHTML = response.phone;
    }
    if (response.valid){
        showErrors(response.valid, errorsVerifyPhone);
    }
    if (response.errors){
        showErrors(response.errors, errorsVerifyPhone);
    }
}
