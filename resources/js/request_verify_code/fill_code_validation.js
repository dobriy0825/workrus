export default function fillCodeValidation ()
{
    let codeInp = document.querySelector('.popup__form_code');
    let bbb = document.querySelector('.popup__form_button');
    codeInp.addEventListener('input', function () {
        let strInp = codeInp.value;
        if (strInp.toString().length == 5){
            bbb.removeAttribute('disabled');

            bbb.style.backgroundColor = '#ff7400';
        }else {
            bbb.setAttribute('disabled', '0');
            bbb.style.backgroundColor = '#b0afaf';
        }
    });
}

