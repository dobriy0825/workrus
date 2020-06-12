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
{{--        <div class="menu-personal-area-mobile">--}}
{{--            <i class="fas fa-caret-left strelki-menu"></i>--}}
{{--            <ul class="menu-personal-area-mobile__items">--}}
{{--                <li class="menu-personal-area-mobile__item">--}}
{{--                    <a class=" menu-personal-area-mobile__link center a1" href="">Моя анкета</a>--}}
{{--                </li>--}}
{{--                <li class="menu-personal-area-mobile__item">--}}
{{--                    <a class=" menu-personal-area-mobile__link right b1" href="">Задания</a>--}}
{{--                </li>--}}
{{--                <li class=" menu-personal-area-mobile__item">--}}
{{--                    <a class=" menu-personal-area-mobile__link left c1" href="">Настройки</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <i class="fas fa-caret-right strelki-menu"></i>--}}
{{--        </div>--}}


        <hr class="menu-personal-area-mobile__line" style="margin-bottom: 10px;">


{{--        <div class="menu-personal-area-desktop">--}}
{{--            <ul class="menu-personal-area-desktop__items">--}}
{{--                <li class=" menu-personal-area-desktop__item">--}}
{{--                    <a href="#" class="menu-personal-area-desktop__link">Моя анкета</a>--}}
{{--                </li>--}}
{{--                <li class="  menu-personal-area-desktop__item">--}}
{{--                    <a href="personalAreaJobs.html" class="menu-personal-area-desktop__link menu-personal-area-desktop__link_active">Задание</a>--}}
{{--                </li>--}}
{{--                <li class=" menu-personal-area-desktop__item">--}}
{{--                    <a href="personalAreaSetting.html" class="menu-personal-area-desktop__link">Настройки</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <li class=" menu-personal-area-desktop__item">--}}
{{--                <a href="#" class="menu-personal-area-desktop__link">Выйти</a>--}}
{{--            </li>--}}
{{--        </div>--}}





        <!--<div class="submenu">
            <i class="fas fa-caret-left"></i>
            <ul class="submenu__items">
                <li class="submenu__item "><a href="personalAreaMyWorker.html" class="submenu__link center a1">Моя анкета</a></li>
                <li class="submenu__item "><a href="personalAreaJobs.html" class="submenu__link right b1">Задание</a></li>
                <li class="submenu__item "><a href="personalAreaSetting.html" class="submenu__link left c1">Настройки</a></li>
            </ul>
            <li class="submenu__item"><a href="#" class="submenu__link">Выйти</a></li>
            <i class="fas fa-caret-right"></i>
        </div>-->

        <article class="personalArea-jobs size_article700">
            <div class="submenu-jobs">
                <ul class="submenu-jobs__items">
                    <li class="submenu-jobs__item">
                        <a class="submenu-jobs__link submenu-jobs__link_active" data-content="my_jobs" href="">Мои({{ $user->jobs->count() }})</a>
                    </li>
                    <li class="submenu-jobs__item">
                        <a class="submenu-jobs__link"
                           data-content="completed_jobs"
                           href="">Выполненo({{ $user->worker ? $user->worker->completedJobs->count() : '0' }})</a>
                    </li>
                </ul>
            </div>
            <div class="line_section" style="margin-bottom: 10px;background-color: #c3c3c3;"></div>

            <div class="my_jobs tab">
                <div class="status-seclection">
                    <span class="status-seclection__title">Отобрать по статусу:</span>
                    <select class="status-seclection__items" name="" id="">
                        <option class="status-seclection__item" value="" style="margin-bottom: 22px;">Все</option>
                        <option class="status-seclection__item" value="">Открыто</option>
                        <option class="status-seclection__item" value="">В работе</option>
                        <option class="status-seclection__item" value="">Выполнено</option>
                    </select>
                </div>
                @if($user->jobs->isNotEmpty())
                <div class="cards">
                    @foreach($user->jobs as $job)
                        <div class="card">
                            <div class="data">
                                <div class="data__topRow">
                                    <a href="" class="topRow__name">{{ $job->title }}</a>
                                    <p class="topRow__price">цена: <span>{{ $job->price }}</span>р.</p>
                                </div>
                                <p class="data__description">{{ $job->str($job->description) }}</p>
                                <div class="data__bottomRow">
                                    <p class="bottomRow__create">создание: {{ $job->created_at }}</p>
                                    <a href="{{ route('job.show', $job->id) }}" class="bottomRow__detailed">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                <span>Нет заданий.</span>
                @endif
            </div>


            <div class="completed_jobs tab" style="display:none;">
                @if($user->worker)
                    @if($user->worker->completedJobs->isNotEmpty())
                    <div class="cards">
                        @foreach($user->worker->completedJobs as $job)
                            <div class="card">
                                <div class="data">
                                    <div class="data__topRow">
                                        <a href="" class="topRow__name">{{ $job->title }}</a>
                                        <p class="topRow__price">цена: <span>{{ $job->price }}</span>р.</p>
                                    </div>
                                    <p class="data__description">{{ $job->str($job->description) }}</p>
                                    <div class="data__bottomRow">
                                        <p class="bottomRow__create">создание: {{ $job->created_at }}</p>
                                        <a href="{{ route('job.show', $job->id) }}" class="bottomRow__detailed">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <span>Нет выполненных заданий.</span>
                    @endif
                @else
                    <span>Нет заданий.</span>
                @endif

            </div>
        </article>
    </section>
    <script src="{{ mix('js/cabinet/jobs.js') }}"></script>
@endsection
