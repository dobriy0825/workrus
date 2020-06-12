export default function () {
    let input = document.querySelector('.input');
    let inputLabel = document.querySelector('.label');
    let switchEmail = document.querySelector('.switch_email');
    switchEmail.classList.add('active_input');
    let switchPhone = document.querySelector('.switch_phone');
    switchPhone.classList.add('hide_input');

    switchPhone.addEventListener('click', function () {
        input.setAttribute('placeholder', 'Введите номер телефона:');
        input.setAttribute('name', 'phone');
        inputLabel.innerHTML = 'Номер телефона';
        switchEmail.classList.remove('active_input');
        switchEmail.classList.add('hide_input');
        switchPhone.classList.remove('hide_input');
        switchPhone.classList.add('active_input');
    });
    switchEmail.addEventListener('click', function () {
        input.setAttribute('placeholder', 'Введите e-mail');
        input.setAttribute('name', 'email');
        inputLabel.innerHTML = 'E-mail:';
        switchPhone.classList.remove('active_input');
        switchPhone.classList.add('hide_input');
        switchEmail.classList.remove('hide_input');
        switchEmail.classList.add('active_input');
    })
}
