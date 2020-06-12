@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
@endsection
@section('content')
    <section class="">
        <h2 class="section__title">Восстановление пароли</h2>
        <form action="{{ route('send.link.reset.password') }}" class="form" method="post">
            @method('POST')
            @CSRF
            <div class="switcher">
                <div class="switch_item switch_email">E-mail</div>
                <div class="switch_item switch_phone">Номер телефона</div>
            </div>
            @if($errors->any())
            <div class="errors">
                {{ $errors->first() }}
            </div>
            @endif
            <div class="form__fields">
                <div class="field">
                    <label class="form__label label">E-mail</label>
                    <input class="form__input input" type="text" name="email" placeholder="Введите e-mail" value="{{ old('phone') }}">
                </div>
            </div>
            <input class="form__input "type="submit" value="Отправить ссылку для сброса пароля">
        </form>
    </section>
    <script src="{{ mix('js/login.js') }}"></script>
@endsection

