<script>

window.onload = function(){


        let csrf = document.querySelector('meta[name=csrf-token]').getAttribute('content');
        let width = window.screen.width;
        if (width < 1028){
            document.querySelector('.header-for-desktop').remove();
        }else if(width > 1027){
            document.querySelector('.header-for-main-mobile').remove();
        }

        let editBtn = document.querySelectorAll('.edit');
        let forPopup = document.querySelector('.for_popup');
        for(let i = 0; editBtn.length > i; i++){
            editBtn[i].addEventListener('click', function () {

                document.querySelector('.for_popup').style.display = 'flex';
                document.querySelector('body').style.overflow = 'hidden';

                let dataName = this.getAttribute('data-name');
                document.querySelector('.input').setAttribute('name', dataName);
                if (document.querySelector('.input').getAttribute('name') === 'name'){
                    document.querySelector('.popup_title').innerHTML = 'Введите имя:';
                }
                else if (document.querySelector('.input').getAttribute('name') === 'surname'){
                    document.querySelector('.popup_title').innerHTML = 'Введите фамилию:';
                }
                else if (document.querySelector('.input').getAttribute('name') === 'email'){
                    document.querySelector('.popup_title').innerHTML = 'Введите e-mail:';
                }
                else if (document.querySelector('.input').getAttribute('name') === 'phone'){
                    document.querySelector('.popup_title').innerHTML = 'Введите номер телефона:';
                }

                let workerStyleVal = document.querySelectorAll('.workerStyle__val');
                for (let i = 0; workerStyleVal.length > i; i++){
                    if(workerStyleVal[i].getAttribute('data-name') === this.getAttribute('data-name')){
                        document.querySelector('.input').value = workerStyleVal[i].innerText;
                    }
                }
            })
        }

        document.querySelector('.cancel_btn').addEventListener('click', function (e) {
            document.querySelector('body').style.overflow = 'inherit';
            document.querySelector('.for_popup').style.display = 'none';
        });



        document.querySelector('.confirm_phone').addEventListener('click', function (e) {
            e.preventDefault();
            let fff = new FormData(document.forms.ccc);
            let obj = new XMLHttpRequest();
            obj.open('post', '/cabinet/settings/r');
            obj.setRequestHeader('X-CSRF-TOKEN', csrf);
            obj.send(fff);
            obj.onreadystatechange = function () {
                if (obj.readyState == 4){
                    console.log(obj.response);
                    document.querySelector('.wrap_popup').style.display = 'flex';
                    let time = parseInt(obj.response);
                    function f(){
                        time--;
                        let m = Math.floor(time/60);
                        if(m < 10){
                            m = '0' + m;
                        }
                        let s = time%60;
                        if(s < 10){
                            s = '0' +  s;
                        }
                        if ((m == 0 && s == 0) || document.querySelector('.wrap_popup').style.display === 'none'){
                            setTimeout(clearInterval(z));
                            document.querySelector('.btn_send_code').removeAttribute('disabled');
                            document.querySelector('.btn_send_code').style.color = '#006363';
                        }
                        document.querySelector('.minute').innerHTML = m;
                        document.querySelector('.seconds').innerHTML = s;
                    }
                    let z =setInterval(f,1000);
                }
            }
        });


        let codeInp = document.querySelector('.popup__form_code');
        let bbb = document.querySelector('.popup__form_button');
        codeInp.addEventListener('input', function () {
            let strInp = codeInp.value;
            if (strInp.toString().length >= 5 && strInp.toString().length < 6){
                bbb.removeAttribute('disabled');

                bbb.style.backgroundColor = '#ff7400';
            }else {
                bbb.setAttribute('disabled', '0');
                bbb.style.backgroundColor = '#b0afaf';
            }
        });



        document.querySelector('.popup__form_button').addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector('.popup__form_code').setAttribute('hidden', 'hidden');
            let formToken = new FormData(document.forms.code);
            let obj2 = new XMLHttpRequest();
            obj2.open('post', '/cabinet/settings/phone_verify');
            obj2.setRequestHeader('X-CSRF-TOKEN', csrf);
            obj2.send(formToken);
            obj2.onreadystatechange = function () {
                if (obj2.readyState == 4){
                    document.querySelector('.popup__form_code').removeAttribute('hidden');
                    if (obj2.status == 200){
                        if (obj2.getResponseHeader('Content-type') == 'application/json'){
                            let err = JSON.parse(obj2.response);
                            if (err.errors){
                                document.querySelector('.errors_popup').innerHTML = err.errors;
                            }
                        }else {
                            document.querySelector('.errors_popup').innerHTML = '';
                            console.log(obj2.response);
                            document.querySelector('.wrap_popup').style.display = 'none';
                            //document.querySelector("body").append(obj2.response);

                        }

                    }
                }
            }
        });
    }
    </script>
