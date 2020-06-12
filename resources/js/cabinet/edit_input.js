export function showEditField() {
        let editBtn = document.querySelectorAll('.edit');
        let forPopup = document.querySelector('.for_popup');
        let input = document.querySelector('.input');
        let inputTitle = document.querySelector('.popup_title');

        for(let i = 0; editBtn.length > i; i++){
            editBtn[i].addEventListener('click', function () {
                document.querySelector('.edit_input_errors').innerHTML = '';
                document.querySelector('.for_popup').style.display = 'flex';
                document.querySelector('body').style.overflow = 'hidden';

                let dataName = this.getAttribute('data-name');
                input.setAttribute('name', dataName);

                if (input.getAttribute('name') === 'name'){
                    inputTitle.innerHTML = 'Введите имя:';
                }
                else if (input.getAttribute('name') === 'surname'){
                    inputTitle.innerHTML = 'Введите фамилию:';
                }

                let workerStyleVal = document.querySelectorAll('.workerStyle__val');
                for (let i = 0; workerStyleVal.length > i; i++){
                    if(workerStyleVal[i].getAttribute('data-name') === this.getAttribute('data-name')){
                        input.value = workerStyleVal[i].innerText;
                    }
                }
            })
        }
    }

export function hideEditField()
{
    document.querySelector('.cancel_btn').addEventListener('click', function () {
        document.querySelector('body').style.overflow = 'inherit';
        document.querySelector('.for_popup').style.display = 'none';
    });
}


