import ajax from "../auth/register/ajax_request_register";
import fillCodeValidation from "./fill_code_validation";
if (document.querySelector('.confirm_phone')){

}
let confirmPhone = document.querySelector('.confirm_phone');
let sendBtn = document.querySelector('.captcha_btn');


function requestVerifyCode(url, e) {
    e.preventDefault();
    ajax(url );
    fillCodeValidation();
    document.querySelector('.wrap_popup').style.display = 'flex';
}

export function requestVerifyCodeRegister()
{
    sendBtn.addEventListener('click', function (e) {
        requestVerifyCode('/register/request', e);
    });
}

export function requestVerifyCodeSettings()
{
    if (confirmPhone != undefined){
        confirmPhone.addEventListener('click', function (e) {
            requestVerifyCode('/cabinet/settings/requestPhoneVerifyCode', e)
        });
    }
}



