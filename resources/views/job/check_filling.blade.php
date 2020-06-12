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
        <article class="workerStyle my_worker size_article700 bgc_check_worker_filling_pc">
            <div class="block">
                <span class="workerStyle__prop">Навание</span>
                <hr class="workerStyle__line">
                <span class="workerStyle__val">{{ $job->title }}</span>
{{--                <a href="" class="workerStyle__val"></a>--}}
            </div>
{{--            <div class="block">--}}
{{--                <span class="workerStyle__prop">Вид задания</span>--}}
{{--                <hr class="workerStyle__line">--}}
{{--                <span class="workerStyle__val">{{ $job->category  .' '. $job->sub_category }}</span>--}}
{{--            </div>--}}
            <div style="display: flex; justify-content: space-between;">
                <div class="block" style="width: 47%;">
                    <span class="workerStyle__prop">Подкатегория</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val">{{ $job->sub_category }}</span>
                </div>
                <div class="block" style="width: 47%;">
                    <span class="workerStyle__prop">Категория</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val">{{ $job->category }}</span>
                </div>
            </div>
            <div class="block">
                <span class="workerStyle__prop">Местоположение</span>
                <hr class="workerStyle__line">
                <span class="workerStyle__val">{{ $job->address }}</span>
            </div>

            <div class="block">
                <span class="workerStyle__prop">Нужно людей</span>
                <hr class="workerStyle__line">
                <span class="workerStyle__val italic">{{ $job->need_people }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <div class="block" style="width: 47%;">
                    <span class="workerStyle__prop">Начать</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val italic">{{ $job->start }}</span>
                </div>
                <div class="block" style="width: 47%;">
                    <span class="workerStyle__prop">Завершить</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val italic">{{ $job->finish }}</span>
                </div>
            </div>
            <div class="block">
                <span class="workerStyle__prop">Цена</span>
                <hr class="workerStyle__line">
                <span class="workerStyle__val italic">{{ $job->price }}<span>р.</span></span>
            </div>
            <div class="block">
                <span class="workerStyle__prop">Заказчик</span>
                <hr class="workerStyle__line">
                <a href="#" class="workerStyle__val" style="color: #009999">{{ $job->user->name }}</a>
            </div>
            <div class="block">
                <span class="workerStyle__prop">Описание</span>
                <hr class="workerStyle__line">
                <p class="workerStyle__val">{{ $job->description }}</p>
            </div>
            <form action="{{ route('job.confirm', $job->id) }}" method="post">
                @method('put')
                @csrf
                <input type="submit" value="Опубликовать">
            </form>
            <a href="{{ route('job.create.edit', $job->id) }}">Редактировать</a>
        </article>
    </section>
@endsection
