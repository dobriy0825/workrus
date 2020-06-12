export default function showVerifyPhone () {
    disableResendCode();
    document.querySelector('.verify_phone_popup').style.display = 'flex';
    document.querySelector('.verify_phone_popup .popup__form_code').value = '';
    document.querySelector('.verify_phone_popup .popup__form_code').focus();
    validationConfirmationCode();
}


function validationConfirmationCode() {
    let inputVerifyCode = document.querySelector('.verify_phone_popup .popup__form_code');

    inputVerifyCode.addEventListener('input', function () {
        let str = inputVerifyCode.value.toString();
        let fieldLenght = str.length;
        if (fieldLenght == 5){
            document.querySelector('.verify_phone_popup .verify_phone_btn').removeAttribute('disabled');
            document.querySelector('.verify_phone_popup .verify_phone_btn').style.backgroundColor = '#ff7400';
        }else {
            document.querySelector('.verify_phone_popup .verify_phone_btn').setAttribute('disabled', '0');
            document.querySelector('.verify_phone_popup .verify_phone_btn').style.backgroundColor = '#b0afaf';
        }
    })
}

function disableResendCode() {
    let resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
    resendCodeBtn.setAttribute('disabled', '9');
    resendCodeBtn.style.color = '#b0afaf';
}
