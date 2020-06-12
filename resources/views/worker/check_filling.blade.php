@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobile" style="margin-bottom: 15px;">
        <div class="header-mobile">
            <a href="index.html"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Проверка заполнения</h2>
        </div>
    </header>
@endsection
@section('content')
    <section>
    <h2 class="section__title">Анкета</h2>
    <article class="workerStyle my_worker size_article700 bgc_check_worker_filling_pc">
        <div class="workerStyle__top">
            <div>
                <div class="workerStyle__avatar"></div>
            </div>
            <!-- Для мобильных -->
            <div class="workerStyle__name_surname">
                <div class="block">
                    <span class="workerStyle__prop">Имя</span>
                    <hr class="workerStyle__line">
                    <a href="" class="workerStyle__val">{{ $user->worker->name }}</a>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Фамилия</span>
                    <hr class="workerStyle__line">
                    <div style="" class="ddd">
                        <span class="workerStyle__val">{{ $user->worker->surname }}</span>
                    </div>
                </div>
            </div>
            <!-- Для ПК-->
            <div class="workerStyle__name_surname_sex">
                <div class="block">
                    <span class="workerStyle__prop">Имя</span>
                    <hr class="workerStyle__line">
                    <a href="" class="workerStyle__val">{{ $user->worker->name }}</a>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Фамилия</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val">{{ $user->worker->surname }}</span>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Пол</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val">{{ $user->worker->sex }}</span>
                </div>
            </div>
        </div>
        <!-- Убрать для ПК-->
        <div class="block sex">
            <span class="workerStyle__prop">Пол</span>
            <hr class="workerStyle__line">
            <span class="workerStyle__val">{{ $user->worker->sex }}</span>
        </div>
        <div class="block">
            <span class="workerStyle__prop">Возраст</span>
            <hr class="workerStyle__line">
            <span class="workerStyle__val italic">{{ $user->worker->age }}</span>
        </div>

        <div class="block">
            <span class="workerStyle__prop">Город</span>
            <hr class="workerStyle__line">
            <span class="workerStyle__val ">{{ $user->worker->city }}</span>
        </div>
        <div class="block">
            <span class="workerStyle__prop">О себе</span>
            <hr class="workerStyle__line">
            <p class="workerStyle__val">{{ $user->worker->about_me }}</p>
    </div>
    <div class="block">
        <span class="workerStyle__prop">Виды выполняемых работ</span>
        <hr class="workerStyle__line">
        <button class="show_types_of_jobs_btn">Показать</button>
        @include('worker.types_jobs')

        </div>
        <form action="{{ route('worker.create.after.check') }}" method="post">
            @method('post')
            @csrf
            <input type="submit" value="Опубликовать">
        </form>
        <a href="{{ route('worker.edit') }}">Редактировать</a>
    </article>
</section>
    <script src="{{ mix('js/worker/item_worker.js') }}"></script>
@endsection
