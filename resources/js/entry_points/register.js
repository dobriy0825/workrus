import singUp from "../auth/register/sing_up";
import verifyPhone from '../common/verify_phone';
import cancelRegister from '../auth/register/cancel_register';
import resendVerifyCode from "../common/resend_verify_code";

document.querySelector('input[value=Зарегистрироваться').addEventListener('click', async function (e) {
    e.preventDefault();
    await singUp();
});

document.querySelector('.verify_phone_popup .verify_phone_btn').addEventListener('click',  async function (e) {
    e.preventDefault();
    await verifyPhone('/register/verify_phone', document.forms.verify_phone);
});

document.querySelector('.verify_phone_popup .cancel_btn').addEventListener('click',  async function (e) {
    e.preventDefault();
    await cancelRegister();
});

document.querySelector('.verify_phone_popup .resend_code_btn').addEventListener('click', async function (e) {
    e.preventDefault();
    await resendVerifyCode('/register/resend_verify_code');
});

