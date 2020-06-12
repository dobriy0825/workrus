@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobil">
        <div class="header-mobile">
            <a href="{{ route('main') }}"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Личный кабинет</h2>
        </div>
    </header>
@endsection
@section('content')
    <section>
        <h2 class="section__title">Личный кабинет</h2>
        @include('cabinet.cabinet_menu')


        <!--  Анкета в Личном кабинете -->
        <article class="workerStyle size_article700">
            @if($user->isWorker($user))
                <div class="workerStyle__top">
                    <div class="wrap__avatar">
                        <div class="workerStyle__avatar"></div>
                    </div>
                    <!-- Для мобильных -->
                    <div class="workerStyle__name_surname">
                        <div class="block">
                            <span class="workerStyle__prop">ID</span>
                            <hr class="workerStyle__line">
                            <span class="workerStyle__val italic">{{ $worker->id }}</span>
                        </div>
                        <div class="block">
                            <span class="workerStyle__prop">Имя</span>
                            <hr class="workerStyle__line">
                            <a href="" class="workerStyle__val">{{ $worker->name }}</a>
                        </div>
                    </div>
                    <!-- Для ПК-->
                    <div class="workerStyle__name_surname_sex">
                        <div class="block">
                            <span class="workerStyle__prop">ID</span>
                            <hr class="workerStyle__line">
                            <span class="workerStyle__val italic">{{ $worker->id }}</span>
                        </div>
                        <div class="block">
                            <span class="workerStyle__prop">Имя</span>
                            <hr class="workerStyle__line">
                            <a href="" class="workerStyle__val">{{ $worker->name }}</a>
                        </div>
                        <div class="block">
                            <span class="workerStyle__prop">Фамилия</span>
                            <hr class="workerStyle__line">
                            <span class="workerStyle__val">{{ $worker->surname }}</span>
                        </div>
                    </div>
                </div>
                <!-- Убрать для ПК-->
                <div class="block sex">
                    <span class="workerStyle__prop">Фамилия</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val">Раздобреева</span>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Возраст</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val italic">{{ $worker->age }}</span>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Пол</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val">{{ $worker->sex }}</span>
                </div>

                <div class="block">
                    <span class="workerStyle__prop">Город</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val ">{{ $worker->city }}</span>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Выполнено заданий</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val italic">{{ $worker->tasks_completed }}</span>


                </div>
                <div class="block">
                    <span class="workerStyle__prop">Рейтинг</span>
                    <hr class="workerStyle__line">
                    <div class="ddd">
                        <span class="workerStyle__val italic">{{ $worker->rating }}</span>
                    </div>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">О себе</span>
                    <hr class="workerStyle__line">
                    <p class="workerStyle__val">
                        {{ $worker->about_me }}
                    </p>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Виды выполняемых работ</span>
                    <hr class="workerStyle__line">
                    <button class="show_types_of_jobs_btn">Показать</button>
                    @include('worker.types_jobs')
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Создано</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val italic">{{ $worker->formatDate($worker->created_at) }}</span>
                </div>




            @else
                <div style="display: flex;flex-direction: column;">
                    <p style="color:#4d4d4d;">У Вас не создана «Анкета»! </p>
                    <a href="{{ route('worker.create') }}" style="display:flex;color:#ffff;background-color: #009999;font-size: 16px; padding: 10px 20px;margin-top: 15px;border-radius: 5px;">Создать анкету</a>
                </div>
            @endif

        </article>

    </section>
    <script src="{{ mix('js/cabinet/my_worker.js') }}"></script>
@endsection
