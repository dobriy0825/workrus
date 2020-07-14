@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobile" style="margin-bottom: 15px;">
        <div class="header-mobile">
            <a href="index.html"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Анкеты</h2>
        </div>
    </header>
@endsection
@section('content')
    <section>
        <h2 class="section__title">Анкета</h2>
        <div class="menu-personal-area-mobile">
            <i class="fas fa-caret-left strelki-menu"></i>
            <ul class="menu-personal-area-mobile__items">
                <li class="menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link center a1" href="">Анкета</a>
                </li>
                <li class="menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link right b1" href="">Предложенные задания</a>
                </li>
                <li class=" menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link left c1" href="">Отзывы</a>
                </li>
            </ul>
            <i class="fas fa-caret-right strelki-menu"></i>
        </div>
        <hr class="menu-personal-area-mobile__line">

        <div class="wrap_article size_article700" id="app">

            <div style="position: fixed; top: 222px;left: 111px;">
                <button class="btn_prev">prev</button>
                <button class="btn_next">next</button>
            </div>

            <div class="part show_part">
                <div class="wrap_status_views">
                    @if($user->isOnline())
                        <span class="status_online">На сайте</span>
                        @else
                        <span class="" style="color: red;">Был на сайте:</span>
                    @endif
                    <div class="views">
                        <i class="far fa-eye views_icon"></i>
                        <span class="views_number">{{ $worker->views }}</span>
                    </div>
                </div>
                <article class="workerStyle my_worker">
                    <span class="worker-id">Анкета № {{ $worker->id }}</span>


                    <div class="workerStyle__top">
                        <div>
                            <div class="workerStyle__avatar"></div>
                        </div>
                        <!-- Для мобильных -->
                        <div class="workerStyle__name_surname">
                            <div class="block">
                                <span class="workerStyle__prop">Имя</span>
                                <hr class="workerStyle__line">
                                <a href="" class="workerStyle__val">{{ $worker->name }}</a>
                            </div>
                            <div class="block">
                                <span class="workerStyle__prop">Фамилия</span>
                                <hr class="workerStyle__line">
                                <div style="" class="ddd">
                                    <span class="workerStyle__val">{{ $worker->surname }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Для ПК-->
                        <div class="workerStyle__name_surname_sex">
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
                            <div class="block">
                                <span class="workerStyle__prop">Пол</span>
                                <hr class="workerStyle__line">
                                <span class="workerStyle__val">{{ $worker->sex }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Убрать для ПК-->
                    <div class="block sex">
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
                        <p class="workerStyle__val">{{ $worker->about_me }}</p>
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
                </article>
                @auth
                    @if(isset(Auth::user()->worker) && Auth::user()->worker->is($worker))
                        <button class="edit_worker_btn">Редактировать анкету</button>
                    @else
{{--                        <button class="proposed_job_btn">Предложить задание</button>--}}
                        <proposed-job-btn></proposed-job-btn>
                    @endif
                @endauth

                @guest
                    <span class="authorization_warning">Предложить своё Задание могут только авторизованные пользователи !</span>
                @endguest
            </div>
            @auth()
                <worker-component v-bind:authenticated-user="{{ Auth::user() }}"
                                  v-bind:worker="{{ $worker }}"></worker-component>
            @endauth
        </div>
    </section>


{{--    <script src="{{ mix('js/worker/item_worker.js') }}"></script>--}}
@endsection

