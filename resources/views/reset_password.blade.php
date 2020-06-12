@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
@endsection
@section('content')
    <section class="" name="registration">
        <h2 class="section__title">Восстановление пароля</h2>
        <form class="form" action="{{ route('change.password') }}" name="form_reset_password" method="post" id="a">
            @method('post')
            @csrf
            @if($errors->any())
                <div class="errors_reset_password" style="padding: 10px;background-color: red;color: white;font-size: 14px;
            width:300px;border-radius: 5px;margin-bottom: 5px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="form__fields">
                <div class="field">
                    <label class="form__label" for="password">Новый пароль:</label>
                    <input class="form__input"type="password" name="new_password" placeholder="Введите пароль">
                </div>
                <div class="field">
                    <label class="form__label" for="password2">Подтверждение пароля:</label>
                    <input class="form__input" type="password" name="new_password2" placeholder="Введите пароль ещё раз">
                </div>
                <input type="hidden" id="g-recaptcha-response" name="recaptcha" value="">
            </div>
            <input class="form__input" type="submit" value="Сохранить">
{{--            <a href="{{ route('show.form.login') }}" class="form__input__link form__input">Уже зарегистрирован</a>--}}
        </form>
        <div class="ooo"></div>
    </section>




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

@endsection
