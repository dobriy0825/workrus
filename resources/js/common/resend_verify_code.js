import ajaxPost from './ajaxPOST';
import Timer from "./timer";
import showErrors from "./errors/show_errors";

export default async function (url, form) {
    let resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
    resendCodeBtn.setAttribute('disabled', '9');
    resendCodeBtn.style.color = '#b0afaf';

    let result = await ajaxPost(url, form);
    let response = JSON.parse(result);
    if (response.time){
        let elem1 = document.querySelector('.minutes');
        let elem2 = document.querySelector('.seconds');
        let timer = new Timer(response.time, elem1, elem2);
        timer.start();
    }
    if (response.errors){
        showErrors(response.errors, document.querySelector('.verify_phone_popup .errors_popup'));
    }


}
