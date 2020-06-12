@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header  style="margin-bottom:15px" class="header-for-mobile" >
        <div class="header-mobile">
            <a href="{{ route('main') }}"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Вход</h2>
        </div>
    </header>
@endsection
@section('content')
    <section class="">
        <h2 class="section__title">Вход</h2>
        <form action="{{ route('login') }}" class="form" method="post">
            @method('POST')
            @CSRF
            @if (session('error'))
                <div class="errors" style="padding: 10px;background-color: red;color: white;font-size: 14px;width:300px;border-radius: 5px;margin-bottom: 15px;">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="errors" style=" padding: 10px;background-color: red;color: white;font-size: 14px;width:300px;border-radius: 5px;margin-bottom: 15px;">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="switcher">
                <div class="switch_item switch_email">E-mail</div>
                <div class="switch_item switch_phone">Номер телефона</div>
            </div>
            <div class="form__fields">
                <div class="field">
                    <label class="form__label label">E-mail:</label>
                    <input class="form__input input" type="text" name="email" placeholder="Введите e-mail" value="{{ old('phone') }}">
                </div>
                <div class="field">
                    <label class="form__label">Пароль:</label>
                    <input class="form__input"type="password" name="password" placeholder="Введите пароль">
                </div>
            </div>
            <div class="form__RememberRestorePassword">
                <div class="remember">
                    <input id="checkbox" class="remember__checkbox" type="checkbox" name="remember_me">
                    <label class="remember__label" for="checkbox">Запомнить</label>
                </div>
                <a href="{{ route('show.forgot.password') }}" class="restorePassword">Забыли пароль?</a>
{{--                <button class="restorePassword" type="button">Забыли пароль?</button>--}}
            </div>
            <input class="form__input "type="submit" value="Войти">
            <a href="{{ route('create') }}" class="form__input__link form__input">Зарегистрироваться</a>
        </form>
    </section>
    <script src="{{ mix('js/login.js') }}"></script>
@endsection

