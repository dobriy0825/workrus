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
    <section class="" >
    <form id="create_worker_form" action="{{ route('worker.edit.at.creation') }}" method="post">
        @method('post')
        @csrf
    </form>

    <h2 class="section__title">Редактирование анкеты</h2>
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
                    {{ $myWorker->name }}
{{--                    <input class="workerStyle__inputText"--}}
{{--                           type="text"--}}
{{--                           form="createWorker"--}}
{{--                           name="name"--}}
{{--                           value="{{ $myWorker->name }}"--}}
{{--                           placeholder="Введите ваше имя"--}}
{{--                    >--}}
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Фамилия</span>
                    <hr class="workerStyle__line">
                    {{ $myWorker->surname }}
{{--                    <input class="workerStyle__inputText" type="text" form="createWorker" --}}
{{--                           placeholder="Введите вашу фамилию" --}}
{{--                           value="Раздобреев"--}}
{{--                    >--}}
                </div>
            </div>
            <!-- Для ПК-->
            <div class="workerStyle__name_surname_sex">
                <div class="block">
                    <span class="workerStyle__prop">Имя</span>
                    <hr class="workerStyle__line">
                    <p>{{ $user->name }}</p>
{{--                    <input class="workerStyle__inputText" type="text" form="createWorker" name="name" --}}
{{--                           value="{{ $myWorker->name }}" --}}
{{--                           placeholder="Введите ваше имя"--}}
{{--                    >--}}
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Фамилия</span>
                    <hr class="workerStyle__line">
                    <p>{{ $user->surname }}</p>
{{--                    <input class="workerStyle__inputText" type="text" form="createWorker" --}}
{{--                           placeholder="Введите вашу фамилию" --}}
{{--                           value="{{ $user->worker->surname }}"--}}
{{--                    >--}}
                </div>
                <div class="block ">
                    <span class="workerStyle__prop">Дата рождения</span>
                    <hr class="workerStyle__line">
                    <p>{{ $user->age }}</p>
{{--                    <div class="workerStyle__selectItems">--}}
{{--                        <div class="wrap__select">--}}
{{--                            <p class="workerStyle__titleFieLd">Год:</p>--}}
{{--                            <select name="" id="">--}}
{{--                                @for($i = 1980; $i < 2020; $i++)--}}
{{--                                    <option value="{{ $i }}" {{ $i == $date->year ? 'selected' : ''}}>{{ $i }}</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="wrap__select">--}}
{{--                            <p class="workerStyle__titleFieLd">Месяц:</p>--}}
{{--                            <select name="" id="">--}}
{{--                                @for($i = 1; $i <= 12; $i++)--}}
{{--                                    <option value="{{ $i }}" {{ $i == $date->month ? 'selected' : ''}}>{{ $i }}</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="wrap__select">--}}
{{--                            <p class="workerStyle__titleFieLd">День:</p>--}}
{{--                            <select name="" id="">--}}
{{--                                @for($i = 1; $i < 33; $i++)--}}
{{--                                    <option value="{{ $i }}" {{ $i == $date->day ? 'selected' : ''}}>{{ $i }}</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                </div>
            </div>

        </div>
        <!-- Убрать для ПК-->
        <div class="block sex">
            <span class="workerStyle__prop">Дата рождения</span>
            <hr class="workerStyle__line">
            <div class="workerStyle__selectItems">
                <div class="wrap__select">
                    <p class="workerStyle__titleFieLd">Год:</p>
                    <select name="" id="">
                    </select>
                </div>
                <div class="wrap__select">
                    <p class="workerStyle__titleFieLd">Месяц:</p>
                    <select name="" id="">
                        <option value="">Январь</option>
                        <option value="">Февраль</option>
                        <option value="">Март</option>
                        <option value="">Апрель</option>
                        <option value="">Май</option>
                    </select>
                </div>
                <div class="wrap__select">
                    <p class="workerStyle__titleFieLd">День:</p>
                    <select name="" id="">
                    </select>
                </div>
            </div>
        </div>
        <div class="block ">
            <span class="workerStyle__prop">Пол</span>
            <hr class="workerStyle__line">
            <p>{{ $user->sex }}</p>
{{--            <div  class="workerStyle__sex_items">--}}
{{--                <div class="workerStyle__sex_item">--}}
{{--                    <input class="workerStyle__inputRadio" type="radio" form="createWorker" name="sex" value="Мужской"--}}
{{--                           id="radio1"--}}
{{--                           {{ $myWorker->sex == 'Мужской' ? 'checked' : ''}}--}}
{{--                    >--}}
{{--                    <label class="workerStyle__label" for="radio1">Мужской</label>--}}
{{--                </div>--}}
{{--                <div class="workerStyle__sex_item">--}}
{{--                    <input class="workerStyle__inputRadio" type="radio" form="createWorker" name="sex" value="Женский"--}}
{{--                           id="radio2"--}}
{{--                        {{ $myWorker->sex == 'Женский' ? 'checked' : ''}}--}}
{{--                    >--}}
{{--                    <label class="workerStyle__label" for="radio2">Женский</label>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

        <div class="block">
            <span class="workerStyle__prop">Город</span>
            <hr class="workerStyle__line">
            <span class="btn_for_selected btn_show_towns" >{{ $user->worker->city }}</span>
        </div>

        <div class="block">
            <span class="workerStyle__prop">О себе</span>
            <hr class="workerStyle__line">
            <textarea form="create_worker_form"
                      name="about_me"
                      cols="30"
                      rows="5"
                      placeholder="Введите о себе">{{ $user->worker->about_me }}</textarea>
        </div>

        <div class="block">
            <span class="workerStyle__prop">Виды выполняемых работ</span>
            <hr class="workerStyle__line">
            <button class="btn_show_typeJob__items" style="">Выбрать</button>

            <!-- Модальное окно Выбор вида работ -->
            @include('worker.type')
        </div>

        <div class="block">
            <input form="create_worker_form" type="submit" value="Продолжить" class="">
            <button class="">Отмена</button>
        </div>
    </article>

</section>
    @include('modal_windows.city_selection')
    <script src="{{ mix('js/worker/edit_worker.js') }}"></script>
@endsection
