@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
@endsection
@section('content')
    <section>
        <h2 class="section__title">Последние добавленные</h2>
        <div class="workers-jobs">
            <div class="workers">
                <a href="{{ route('worker.index') }}" class="searchBtn" style="display:block;text-align: center">Анкеты</a>
                <div class="cards">
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Алексей</a>
                                <p class="topRow__rating ">Рейтинг: 4.9</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ipsum ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lineCenter"></div>
            <div class="jobs">
                <a href="{{ route('job.index') }}" class="searchBtn" style="display:block;text-align: center">Задания</a>
                <div class="cards">
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                                <p class="topRow__price">цена: <span>20000</span>р.</p>
                            </div>
                            <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                                <a href="" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modal_windows.main.menu_main_mobile')

    <script src="{{ mix('js/main.js') }}" ></script>
@endsection
