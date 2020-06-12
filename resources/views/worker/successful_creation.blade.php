@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobile" style="margin-bottom: 15px;">
        <div class="header-mobile">
            <a href="index.html"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Редактирование анкеты</h2>
        </div>
    </header>
@endsection
@section('content')
    <p>Ваша "Анкета" успешно создана и находиться на модерации. Анкета будет доступна через 5-10 минут.</p>
@endsection
