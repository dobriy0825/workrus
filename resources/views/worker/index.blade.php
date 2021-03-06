@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobile" style="margin-bottom: 15px;">
        <div class="header-mobile">
            <a href="index.html"><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>
            <h2 class="header__title">Поиск анкеты</h2>
        </div>
    </header>
@endsection
@section('content')
    <section>
        <h2 class="section__title">Поиск анкет</h2>
        <div class="wrap_article size_article700">
            <div class="wrap_search_param" style="">

                <div class="search">
                    <input class="search__input" type="search">
                    <input class="search__btn" type="button" value="Поиск" style="">
                </div>

                <div class="wrap_param">
                    <div class="select_param">
                        <span class="select_param__property">Выбрать город: <span class="select_param__value">Нижнекамск</span></span>
                    </div>
                    <div class="select_param">
                        <span class="select_param__property">Выбрать категории: <span class="select_param__value">Ремонт и строительство</span></span>
                    </div>
                </div>
            </div>
            <div class="cards">
                @foreach($workers as $worker)
                    <div class="card">
                        <div class="wrapAvatar">
                            <div class="wrapAvatar__avatar"></div>
                        </div>
                        <div class="data">
                            <div class="data__topRow">
                                <a href="" class="topRow__name">{{ $worker->name }}</a>
                                <p class="topRow__rating ">Рейтинг: {{ $worker->rating }}</p>
                            </div>
                            <p class="data__description">{{ $worker->str($worker->about_me) }}</p>
                            <div class="data__bottomRow">
                                <p class="bottomRow__create">создание: {{ $worker->created_at }}</p>
                                <a href="{{ route('worker.item', $worker) }}" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
