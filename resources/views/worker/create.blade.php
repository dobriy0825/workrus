@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobile">
        <div class="header-mobile">
            <a href=""><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Создание задания</h2>
        </div>
    </header>
@endsection
@section('content')
    <section class="" style="">

        <form name="createWorker" action="{{ route('worker.store.draft') }}" method="post" id="create_worker_form">
            @method('post')
            @csrf
        </form>

        <h2 class="section__title">Создание анкеты</h2>
        @if ($errors->any())
            <div class="" style="background-color:red; color: white;width: 700px; padding: 7px;margin: 0 auto 10px;border-radius: 5px;">
                {{ $errors->first() }}
            </div>
        @endif
        <article class=" workerStyle size_article700 bgc__createWorker__pc">

            <div class="workerStyle__top">
                <div class="wrap__avatar">
                    <div class="workerStyle__avatar"></div>
                </div>
                <!-- Для мобильных -->
                <div class="workerStyle__name_surname">
                    <div class="block">
                        <span class="workerStyle__prop">Имя</span>
                        <hr class="workerStyle__line">
                        <p>{{ $user->name }}</p>
{{--                        <input class="workerStyle__inputText" type="text" form="createWorker" name="name" placeholder="Введите ваше имя">--}}
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Фамилия</span>
                        <hr class="workerStyle__line">
                        <p>{{ $user->surname }}</p>
{{--                        <input class="workerStyle__inputText" type="text" form="createWorker" placeholder="Введите вашу фамилию">--}}
                    </div>
                </div>
                <!-- Для ПК-->
                <div class="workerStyle__name_surname_sex">
                    <div class="block">
                        <span class="workerStyle__prop">Имя</span>
                        <hr class="workerStyle__line">
                        <p>{{ $user->name }}</p>
{{--                        <input class="workerStyle__inputText" type="text" value="{{ $user->name }}" form="createWorker" name="name" placeholder="Введите ваше имя">--}}
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Фамилия</span>
                        <hr class="workerStyle__line">
                        <p>{{ $user->surname }}</p>
{{--                        <input class="workerStyle__inputText" type="text" value="{{ $user->surname }}" form="createWorker" placeholder="Введите вашу фамилию">--}}
                    </div>
                    <div class="block">
{{--                        <span class="workerStyle__prop">Дата рождения</span>--}}
                        <span class="workerStyle__prop">Возраст:</span>
                        <hr class="workerStyle__line">
                        <p>{{ $user->age }}</p>
                    </div>
                </div>

            </div>
            <!-- Убрать для ПК-->
            <div class="block sex">
                <span class="workerStyle__prop">Дата рождения</span>
                <hr class="workerStyle__line">
                <p>{{ $user->age }}</p>
            </div>

            <div class="block ">
                <span class="workerStyle__prop">Пол</span>
                <hr class="workerStyle__line">
                <p>{{ $user->sex }}</p>
{{--                <div  class="workerStyle__sex_items">--}}
{{--                    <div class="workerStyle__sex_item">--}}
{{--                        <input class="workerStyle__inputRadio" type="radio" form="createWorker" name="sex" value="man" id="radio1" {{ $user->sex == 'Мужской' ? 'checked' : '' }}>--}}
{{--                        <label class="workerStyle__label" for="radio1">Мужской</label>--}}
{{--                    </div>--}}

{{--                    <div class="workerStyle__sex_item">--}}
{{--                        <input class="workerStyle__inputRadio" type="radio" form="createWorker" name="sex" value="woman" id="radio2" {{ $user->sex == 'Женский' ? 'checked' : '' }}>--}}
{{--                        <label class="workerStyle__label" for="radio2">Женский</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>


            <div class="block">
                <span class="workerStyle__prop">Город</span>
                <hr class="workerStyle__line">
                <span class="btn_for_selected btn_show_towns" style="cursor: pointer" >{{ old('city') ? old('city') : 'Выбор города' }}</span>
            </div>


            <div class="block">
                <span class="workerStyle__prop">О себе</span>
                <hr class="workerStyle__line">
                <textarea name="about_me" form="create_worker_form" cols="30" rows="5"
                          placeholder="Введите о себе">{{ old('about_me') }}</textarea>
            </div>


            <div class="block">
                <span class="workerStyle__prop">Виды выполняемых работ</span>
                <hr class="workerStyle__line">
                <button class="btn_show_typeJob__items" style="">Выбрать</button>
                <!-- Модальное окно Выбор вида работ -->
                @include('worker.type')
            </div>


            <div class="block">
                <input type="submit" value="Продолжить" form="create_worker_form">
            </div>
        </article>
    </section>

    <!-- Модальное окно Выбор города -->
    @include('modal_windows.city_selection')
{{--    @include('modal_windows.worker.city_selection_for_mobile')--}}
    <script src="{{ mix('js/worker/create_worker.js') }}"></script>
@endsection
