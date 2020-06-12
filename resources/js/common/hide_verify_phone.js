import hideErrors from "./errors/hide_errors";
export default function() {
    document.querySelector('.verify_phone_popup').style.display = 'none';
    disableResendCode();
    hideErrors(document.querySelector('.verify_phone_popup .errors_popup'));
}


function disableResendCode() {
    let resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
    resendCodeBtn.setAttribute('disabled', '9');
    resendCodeBtn.style.color = '#b0afaf';
}
