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

        <div class="wrap_article size_article700">

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
                        <button class="offer_job_btn">Предложить задание</button>
                    @endif
                @endauth

                @guest
                    <span class="authorization_warning">Предложить своё Задание могут только авторизованные пользователи !</span>
                @endguest
            </div>

            @auth
            <div>
                <div class="wrap_name_section">
                    @if(isset(Auth::user()->worker) && Auth::user()->worker->is($worker))
                        <span class="name_section name_section__active" data-content="part_proposed_jobs">Предложенные задания (1)</span>
                        <span class="name_section" data-content="part_hired_jobs">Принятое задание</span>
                    @else
                        <span class="name_section name_section__active" data-content="part_your_job">Ваше задание</span>
                    @endif
                        <span class="name_section" data-content="part_reviews">Отзывы ({{ $worker->reviews->count() }})</span>
                </div>

                <div class="line_section" style="margin-bottom: 10px;"></div>
            </div>
            @endauth



{{--            @if(isset(Auth::user()->worker) && Auth::user()->worker->is($worker))--}}
{{--                <div class="part part_proposed_jobs show_parte tab">--}}
{{--                    <div class="cards">--}}
{{--                    </div>--}}
{{--                    <span class="part__warning_text">Нет предложенных заданий.</span>--}}
{{--                </div>--}}
{{--                <div class="part part_hired_jobs show_parte tab">--}}
{{--                    <div class="cards">--}}
{{--                    </div>--}}
{{--                    <span class="part__warning_text">Нет принятых заданий.</span>--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <div class="part part_your_job show_parte tab">--}}
{{--                    <div class="cards">--}}
{{--                    </div>--}}
{{--                    <span class="part__warning_text">Ваше задание.</span>--}}
{{--            </div>--}}
{{--            @endif--}}

{{--            <div class="part part_reviews tab" style="display: none;">--}}
{{--                @if($worker->reviews->isNotEmpty())--}}
{{--                <div class="wrap_reviews">--}}

{{--                    @foreach($worker->reviews as $review)--}}
{{--                    <div class="review">--}}
{{--                        <div class="wrap_avatar_name_type">--}}
{{--                            <div class="review__avatar_reviewer"></div>--}}
{{--                            <a href="{{ route('user.show', $review->job->user->id) }}"--}}
{{--                               class="review__name_reviewer">{{ $review->job->user->name }}</a>--}}
{{--                            <span class="review__type_user">(Заказчик)</span>--}}
{{--                        </div>--}}
{{--                        <div class="wrap_name_title_job">--}}
{{--                            <span class="review__name_section">Задание:</span>--}}
{{--                            <a href="{{ route('job.show', $review->job->id) }}" class="review__title_job">{{ $review->job->title }}</a>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <span class="review__name_section">Отзыв:</span>--}}
{{--                            <p class="review__text">{{ $review->text }}.</p>--}}
{{--                        </div>--}}


{{--                        <div class="wrap_stars_pubdate">--}}
{{--                            @if($review->assessment != null)--}}
{{--                            <div>--}}
{{--                                <span class="review__name_section">Оценка:</span>--}}
{{--                                <div class="fa-stars">--}}
{{--                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endif--}}
{{--                            <time class="review__pubdate italic">{{ $review->created_at }}</time>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                @else--}}
{{--                <span class="part__warning_text">Нет отзывов.</span>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            @endauth--}}
        </div>
    </section>


    @auth
    <div class="popup_offer_jobs"
         style="width: 100%;height: 100%;background-color:#000;display: none;justify-content: center;align-items: center;position:fixed;top: 0;left: 0;">
        <div style="background-color:#fff;padding: 20px;border-radius: 5px;">
        <div>
            <h3 style="color: #006363;font-size: 20px;">Выбор задания</h3>
        </div>
        <div style="margin-top: 20px;display:flex;justify-content: space-between" >
            <span style="font-size: 18px;color: #006363;font-weight: 700;">Мои задания ({{ Auth::user()->jobs()->statusOpen()->count() }})</span>
            <a href="{{ route('job.create') }}" style="font-size: 18px;color: #009999;">+  Создать задание</a>
        </div>
        <div style="height: 2px;background-color:#000;margin-bottom: 15px;"></div>
        <div>
            <div class="app">

                <div class="cards">
{{--                    @foreach(Auth::user()->jobs()->statusOpen()->get() as $item)--}}
{{--                        <div style="display:flex; align-items: center;">--}}
{{--                            <input type="radio" style="width: 22px;height: 22px;margin-right: 15px;" name="job_id" value="{{ $item->id }}">--}}
{{--                            <div class="card">--}}
{{--                                <div class="data data-height75">--}}
{{--                                    <div class="data__topRow">--}}
{{--                                        <a href="" class="topRow__name">{{ $item->title }}</a>--}}
{{--                                        <p class="topRow__price">цена: <span>{{ $item->price }}</span>р.</p>--}}
{{--                                    </div>--}}
{{--                                    <p class="data__description">{{ $item->str($item->description) }}</p>--}}
{{--                                    <div class="data__bottomRow">--}}
{{--                                        <p class="bottomRow__create">создание: {{ $item->created_at }}</p>--}}
{{--                                        <a href="{{ route('job.show', $item->id) }}" class="bottomRow__detailed">Подробнее</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                </div>

                <div style="display: flex;justify-content: flex-end">
                    <button style="background-color: gray;color:white;border: none;border-radius: 2px;padding: 4px 22px;
                                font-size: 16px;cursor: pointer">Выбрать</button>
                </div>

            </div>
        </div>
    </div>
    </div>
    @endauth

    <script src="{{ mix('js/worker/item_worker.js') }}"></script>
@endsection

