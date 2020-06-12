import hideVerifyPhone from '../../common/hide_verify_phone';
import ajaxPost from "../../common/ajaxPOST";

let inputPassword = document.querySelectorAll('.form__input[type=password]');

export default async function(){

    let response = await ajaxPost('/register/de_registration');
    await hideVerifyPhone();
    cleanInputPassword(inputPassword);
    return response;
}

function cleanInputPassword(array) {
    array.forEach(item => {
        item.value = '';
    })
}


