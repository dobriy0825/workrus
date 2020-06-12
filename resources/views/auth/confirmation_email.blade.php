@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
@endsection
@section('content')
    <section class="">
        <h2 class="section__title">Подтверждение пароля</h2>
        <div style="color: white;background-color:red;font-size: 16px;padding: 10px;margin: 0 auto;width: 990px;border-radius: 5px;">
            На указанный Вами e-mail(сам адрес) выслано письмо со ссылкой, для подтверждения регистрации Вашего аккаута!
        </div>
    </section>
@endsection
