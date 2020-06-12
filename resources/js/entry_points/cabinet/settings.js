import editPhone from '../../cabinet/settings/edit_phone/edit_phone';
import showEditInput from '../../cabinet/settings/showEditInput';
import hideEditInput from '../../cabinet/settings/hide_edit_input';
import verifyPhone from "../../common/verify_phone";
import cancelChangePhone from "../../cabinet/settings/edit_phone/cancel_change_phone";
import resendVerifyCode from "../../common/resend_verify_code";
import addEmail from "../../cabinet/settings/add_email/add_email";
import editEmail from "../../cabinet/settings/edit_email";

// Показать модальное окно для изменения номера телефона
document.querySelector('.phone_edit_btn').addEventListener('click', function (e) {
    e.preventDefault();
    showEditInput('номер телефона', 'phone', 'edit_phone_btn');
});
// Скрыть модальные окна для изменения
document.querySelector('.edit_input_popup .cancel_edit_input_btn').addEventListener('click', hideEditInput);

//---------------------При нажатии на эту кнопку -------------------
document.querySelector('.edit_input_popup .edit_input_btn').addEventListener('click', async function (e) {
    e.preventDefault();
    // Изменяет телефон
    if (e.target.classList.contains('edit_phone_btn')){
        await editPhone();
    }// Добавляет e-mail
    if (e.target.classList.contains('add_email_btn')){
        await addEmail();
    }//Изменяет e-mail
    if (e.target.classList.contains('edit_email_btn')){
        await editEmail();
    }
});
// Отмена изменения номера телефона
document.querySelector('.verify_phone_popup .cancel_btn').addEventListener('click', cancelChangePhone
);
// Подтверждение номера телефона
document.querySelector('.verify_phone_popup .verify_phone_btn').addEventListener('click', async function (e) {
    e.preventDefault();
    await verifyPhone('/cabinet/settings/verify_phone', document.forms.verify_phone);
});
// Повторно отправить код подтверждения
document.querySelector('.verify_phone_popup .resend_code_btn').addEventListener('click', async function (e) {
    e.preventDefault();
    await resendVerifyCode('/cabinet/settings/resend_verify_code');
});


try {
    document.querySelector('.fa-plus-circle').addEventListener('click', function () {
        showEditInput('E-mail', 'email', 'add_email_btn');
    });
}catch (e) {

}

// document.querySelector('.edit_input_popup .cancel_edit_input_btn').addEventListener('click', hideEditInput);
document.querySelector('.edit_input_popup .edit_input_btn').addEventListener('click', async function(e){
     e.preventDefault();

});


document.querySelector('.email_edit_btn').addEventListener('click', function (e) {
    e.preventDefault();
    showEditInput('E-mail', 'email', 'edit_email_btn');
});

import {showEditPassword, hideEditPassword, changePassword} from "../../cabinet/settings/edit_password";
import csrf from "../../common/get_csrf";

document.querySelector('.workerStyle__change_password').addEventListener('click', function (e) {
    showEditPassword();
});
document.querySelector('.cancel_edit_password_btn').addEventListener('click', function (e) {
    hideEditPassword();
});

document.querySelector('.edit_password_popup .edit_password_btn').addEventListener('click', async function (e) {
    e.preventDefault();
    await changePassword();
});

document.querySelectorAll('.workerStyle__answer').forEach(function (item) {
    item.addEventListener('click', async function () {
        let form = new FormData();


        if (this.hasAttribute('checked')){
            this.removeAttribute('checked');
            form.append(item.getAttribute('name'), 0);
            let result = await fetch('/cabinet/settings/toggle_check', {
                method:'post',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                body: form
            });
            let status = result.status;
            if (status !== 200){
                throw new Error('no');
            }
            return await result.text();
        }else {
            this.setAttribute('checked', '0');
            form.append(item.getAttribute('name'), 1);
            let result = await fetch('/cabinet/settings/toggle_check', {
                method:'post',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                body: form
            });
        }
    })
});
