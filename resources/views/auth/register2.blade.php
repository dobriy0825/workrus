@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
@endsection
@section('content')
    <section class="" name="registration">
        <h2 class="section__title">Регистрация2</h2>
        <form class="form" name="form_register" method="post">
            @method('post')
            <div class="errors"></div>
            <div class="form__fields">
                <div class="field">
                    <label class="form__label" for="phone">Номер телефона:</label>
                    <input class="form__input" type="text" name="phone" placeholder="Введите номер телефона" value="{{ old('phone') }}">
                </div>
                <div class="field">
                    <label class="form__label" for="password">Пароль:</label>
                    <input class="form__input"type="password" name="password" placeholder="Введите пароль">
                </div>
                <div class="field">
                    <label class="form__label" for="password2">Подтверждение пароля:</label>
                    <input class="form__input" type="password" name="password2" placeholder="Введите пароль ещё раз">
                </div>
            </div>
            <p class="agreement">Нажимая «Регистрация» Вы соглашаетесь с <a href="" class="agreement__link">Правилами работы сервиса</a></p>
            <input class="form__input" type="submit" value="Зарегистрироваться">
            <a href="{{ route('login') }}" class="form__input__link form__input">Уже зарегистрирован</a>
        </form>
        <div class="ooo"></div>
    </section>
   <div class='captcha' style="position: absolute;top: 50%;left: 50%;display:none;">
       <form name="ccc">
           <button style="padding: 111px;" class="btn_send">ok</button>
       </form>

    </div>
    <div class="wrap_popup" style="display: none;">
        <div class="popup">
            <h3 class="popup__title" >Код подтверждения</h3>
            <p class="popup__description" >На указаный Вами номер выслано СМС-сообщение с кодом подтверждения из 5х цифр. Введите его.</p>
            <form action="" class="popup__form" name="code" method="post">
                @method('post')

                <div class="errors_popup" style="color:red;font-size: 14px;"></div>
                <input style="font-size: 20px;width: 90px;padding: 6px;" type="text" class="popup__form_code" name="code">
                <diiv style="display:flex;margin-top: 8px;">
                    <div style="color:#5b5b5b;margin-right: 8px;">
                        <span class="minute">00</span>
                        <span class="">:</span>
                        <span class="seconds">00</span>
                    </div>
{{--                    <a href=""  style="font-size: 14px;color:#b0afaf;text-decoration: underline;">Выслать код повторно</a>--}}
                    <button class="btn_send_code" style="border:none;font-size: 15px;color:#b0afaf;background-color: #ffffff" disabled >Выслать код повторно</button>
                </diiv>
                <input disabled="1" style="background-color:#b0afaf;" type="submit" value="Подтвердить" class="popup__form_button" name="push">
            </form>
            <input type="button" value="Отменить" class="popup__form_button" form="code" >
        </div>
        <div class="wrap_popup__overlay"></div>
    </div>
@endsection
<script>
    //'use strict';

    window.onload = function () {
        let csrf = document.querySelector('meta[name=csrf-token]').getAttribute('content');
        let registerBtn = document.querySelector('input[value="Зарегистрироваться"');
        registerBtn.addEventListener('click', function (e) {
            e.preventDefault();
            let form = new FormData(document.forms.form_register);
            let xhr = new XMLHttpRequest();
            xhr.open('post', 'register');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
            xhr.send(form);
            let errorsDiv = document.querySelector('.errors');
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4){
                    if(xhr.status == 422){
                        let a = JSON.parse(xhr.response);
                        errorsDiv.style.display = 'block';
                           errorsDiv.innerHTML = a.errors.phone;
                    }else{
                        errorsDiv.style.display = 'none';
                        errorsDiv.innerHTML = '';
                        //document.querySelector('.captcha').style.display = 'block';
                    }
                }
            };

        });

        document.querySelector('.btn_send').addEventListener('click', function (e) {
            e.preventDefault();
            let fff = new FormData(document.forms.ccc);
            let obj = new XMLHttpRequest();
            obj.open('post', '/register/c');
            obj.setRequestHeader('X-CSRF-TOKEN', csrf);
            obj.send(fff);
            obj.onreadystatechange = function () {
                if (obj.readyState == 4){
                    document.querySelector('.captcha').style.display = 'none';
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
            obj2.open('post', '/register/t');
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
                            document.querySelector('.captcha').remove();
                            document.querySelector('.wrap_popup').style.display = 'none';
                            document.querySelector("section").innerHTML = obj2.response;
                            //document.querySelector("body").append(obj2.response);

                        }

                    }
                }
            }
        })


        document.querySelector('.btn_send_code').addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector('.btn_send_code').setAttribute('disabled','0');
            document.querySelector('.btn_send_code').style.color = '#b0afaf';
            let fff = new FormData(document.forms.ccc);
            let obj3 = new XMLHttpRequest();
            obj3.open('post', '/register/c');
            obj3.setRequestHeader('X-CSRF-TOKEN', csrf);
            obj3.send(fff);
            obj3.onreadystatechange = function () {
                if (obj3.readyState == 4){
                    document.querySelector('.captcha').style.display = 'none';
                    document.querySelector('.wrap_popup').style.display = 'flex';
                    let time = parseInt(obj3.response);

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
    }


</script>
