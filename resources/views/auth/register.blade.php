@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')

    <header  style="margin-bottom:15px" class="header-for-mobile" >
        <div class="header-mobile">
            <a href="{{ route('main') }}"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Регистрация</h2>
        </div>
    </header>
@endsection
@section('content')

    <section class="" name="registration">
        <h2 class="section__title">Регистрация</h2>
        <form class="form" name="form_register" method="post" id="a">
            @method('post')
            <div class="errors_register" style="display:none;padding: 10px;background-color: red;color: white;font-size: 14px;
            width:300px;border-radius: 5px;margin-bottom: 5px;"></div>
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
                <input type="hidden" id="g-recaptcha-response" name="recaptcha" value="">
            </div>
            <p class="agreement">Нажимая «Регистрация» Вы соглашаетесь с <a href="" class="agreement__link">Правилами работы сервиса</a></p>
            <input class="form__input" type="submit" value="Зарегистрироваться" form="a">
            <a href="{{ route('show.form.login') }}" class="form__input__link form__input">Уже зарегистрирован</a>
        </form>
        <div class="ooo"></div>
    </section>
    @include('modal_windows.verify_phone')




{{--    <script src="https://www.google.com/recaptcha/api.js?render={{ $sk }}"></script>--}}
{{--    <script>--}}
{{--        window.addEventListener('load', function () {--}}
{{--            grecaptcha.ready(function () {--}}
{{--                grecaptcha.execute("{{ $sk }}").then(function (token) {--}}
{{--                    document.querySelector('input[type=hidden]').value = token;--}}
{{--                })--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
    <script src="{{ mix('js/register.js') }}"></script>


@endsection
