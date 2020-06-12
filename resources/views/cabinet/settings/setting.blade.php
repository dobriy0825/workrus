@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobile">
        <div class="header-mobile">
            <a href="{{ route('main') }}"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Личный кабинет</h2>
        </div>
    </header>
@endsection



@section('content')

@include('cabinet.settings.section_settings')
@if(!$user->name)
    @include('modal_windows.cabinet.settings.fill_data')
@endif
@include('modal_windows.cabinet.settings.about_check_email')
@include('modal_windows.cabinet.settings.edit_input')
@include('modal_windows.verify_phone')
@include('modal_windows.cabinet.settings.edit_password')


<script src="{{ mix('js/cabinet/settings.js') }}"></script>
<script>
    window.addEventListener('load', function () {
        document.querySelector('.workerStyle__avatar').addEventListener('mouseover', function () {
            document.querySelector('.edit_avatar').style.display = 'block';
        });
        document.querySelector('.workerStyle__avatar').addEventListener('mouseout', function () {
            document.querySelector('.edit_avatar').style.display = 'none';
        })

    })
</script>
@endsection
