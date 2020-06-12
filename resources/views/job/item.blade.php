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
    <section style="margin-bottom: 111px;">
        <h2 class="section__title">Задание</h2>
        <div class="menu-personal-area-mobile">
            <i class="fas fa-caret-left strelki-menu"></i>
            <ul class="menu-personal-area-mobile__items">
                <li class="menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link center a1" href="">Задание</a>
                </li>
                <li class="menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link right b1" href="">Предложенные анкеты</a>
                </li>
                <li class="menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link right b1" href="">Нанятые анкеты</a>
                </li>
                <li class=" menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link left c1" href="">Отзывы</a>
                </li>
            </ul>
            <i class="fas fa-caret-right strelki-menu"></i>
        </div>
        <hr class="menu-personal-area-mobile__line">

        <div class="wrap_article size_article700">
            <div class="part show_part">
                <div class="wrap_status_views">
                    <span class="status_online" style="color:#747473;">статус: <span style="color:{{ $job->status == 'Открыто' ? '#009999' : 'red' }};">{{ $job->status }}</span></span>
                    <div class="views">
                        <i class="far fa-eye views_icon"></i>
                        <span class="views_number">{{ $job->views }}</span>
                    </div>
                </div>
                <article class="workerStyle my_worker">
                    <span class="worker-id">Задание № {{ $job->id }}</span>
                    <div class="block">
                        <span class="workerStyle__prop">Навание</span>
                        <hr class="workerStyle__line">
                        <a href="" class="workerStyle__val">{{ $job->title }}</a>
                    </div>
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
                        <span class="workerStyle__val italic">{{ $job->price }}</span>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Заказчик</span>
                        <hr class="workerStyle__line">
                        <a href="{{ route('user.show', $job->user_id) }}" class="workerStyle__val" style="color:#009999;">{{ $job->user->name }}</a>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Описание</span>
                        <hr class="workerStyle__line">
                        <p class="workerStyle__val">{{ $job->description }}</p>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Создано</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val italic">{{ $job->created_at }}</span>
                    </div>
                </article>
                @auth
                    @if($userAuth->authenticatedUserJob($job, $userAuth->jobs))
                        <a href="{{ route('job.edit', $job->id) }}" class="proportion_btn"
                           style="background-color: #009999;
                           color: white;
                           width: 100%;
                           display:block;
                           text-align: center;
                           padding: 6px 0;border-radius: 5px;margin-top: 12px;">Редактировать задание</a>
                    @else
                        <form action="{{ route('job.offer.worker', $job->id) }}" method="post">
                            @method('post')
                            @csrf
                            <input type="submit"
                                   value="Предложить анкету"
                                   {{ $job->isProposedWorker($userAuth->worker, $job->offerWorkers) ? 'disabled' : '' }}>
                        </form>
                    @endif
                @endauth

                @guest
                    <span class="authorization_warning">Предложить свою Анкету  могут только авторизованные пользователи !</span>
                @endguest
            </div>


            @auth
                <div>
                    <div class="wrap_name_section">
                        @if($userAuth->authenticatedUserJob($job, $userAuth->jobs))
                        <span class="name_section name_section__active" data-content="part_hired_worker">Принятые анкеты({{ count($job->hiredWorkers) }})</span>
                        <span class="name_section" data-content="part_proposed_jobs">Предложенные анкеты({{ count($job->offerWorkers) }})</span>
                        @else
                        <span class="name_section name_section__active" data-content="part_your_worker">Ваша анкета</span>
                        @endif
                    </div>
                    <div class="line_section" style="margin-bottom: 10px;background-color: #c3c3c3;"></div>
                </div>


                @if($userAuth->authenticatedUserJob($job, $userAuth->jobs))
                    {{-- Вкладка Нанятые анкеты --}}
                    <div class="part part_hired_worker tab" style="display:block;">
                        @if($job->hiredWorkers->isNotEmpty())
                            @foreach($job->hiredWorkers as $worker)
                                <div>
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
                                                <a href="{{ route('worker.item', $worker->id) }}" class="bottomRow__detailed">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between;width: 270px;">
                                        <button class="not_performed_btn" style="display: block;background-color: darkorange;color:#fff;border: none;border-radius: 2px;padding: 4px 0;width: 130px;font-size: 15px;cursor: pointer">Не выполнено</button>
                                        <button class="performed_btn" type="submit" style="display: block;background-color: #009999;color:#fff;border: none;border-radius: 2px;padding: 4px 0;width: 130px;font-size: 15px;cursor: pointer;">Выполнено</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="part__warning_text">Нанятых анкет нет</span>
                        @endif
                    </div>
                    {{-- Вкладка Предложенные анкеты --}}
                    <div class="part part_proposed_jobs tab" style="display:none;">
                        @if($job->offerWorkers->isNotEmpty())
                        <div>
                            <div class="cards">
                                @foreach($job->offerWorkers as $worker )
                                    <div>
                                        <div class="card">
                                            <div class="wrapAvatar">
                                                <div class="wrapAvatar__avatar"></div>
                                            </div>
                                            <div class="data">
                                                <div class="data__topRow">
                                                    <a href="{{ route('worker.item', $worker->id ) }}" class="topRow__name">{{ $worker->name }}</a>
                                                    <p class="topRow__rating ">Рейтинг: {{ $worker->rating }}</p>
                                                </div>
                                                <p class="data__description">{{ $worker->str($worker->about_me) }}</p>
                                                <div class="data__bottomRow">
                                                    <p class="bottomRow__create">создание: {{ $worker->created_at }}</p>
                                                    <a href="{{ route('worker.item', $worker->id) }}" class="bottomRow__detailed">Подробнее</a>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('job.hired_worker', [$job->id, $worker->id]) }}" method="post">
                                            @method('post')
                                            @csrf
                                            <button type="submit" {{ $job->isProposedWorker($worker, $job->hiredWorkers) ? 'disabled' : '' }}
                                                    style="display: block;background-color: {{ $job->isProposedWorker($worker, $job->hiredWorkers) ? 'gray' : '#009999' }};color:#fff;
                                                            border: none;border-radius: 2px;padding: 4px 0;width: 130px;
                                                            font-size: 15px;cursor: pointer;">Нанять анкету</button>
                                        </form>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                            <span class="part__warning_text">Нет предложенных анкет.</span>
                        @endif
                    </div>



                @else
                    <div class="part part_your_worker tab" style="display:block;">
                        @if($job->isProposedWorker($userAuth->worker, $job->offerWorkers))
                        <div>
                            <div class="card">
                                <div class="wrapAvatar">
                                    <div class="wrapAvatar__avatar"></div>
                                </div>
                                <div class="data">
                                    <div class="data__topRow">
                                        <a href="" class="topRow__name">{{ $userAuth->worker->name }}</a>
                                        <p class="topRow__rating ">Рейтинг: {{ $userAuth->worker->rating }}</p>
                                    </div>
                                    <p class="data__description">{{ $userAuth->worker->str($userAuth->worker->about_me) }}</p>
                                    <div class="data__bottomRow">
                                        <p class="bottomRow__create">создание: {{ $userAuth->worker->created_at }}</p>
                                        <a href="{{ route('worker.item', $userAuth->worker->id) }}" class="bottomRow__detailed">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('job.delete.worker', $job->id) }}" method="post">
                                @method('post')
                                @csrf
                                <button type="submit">Отозвать анкету</button>
                            </form>
                        </div>
                        @else
                    <span class="part__warning_text">Анкета не предложена</span>
                    @endif
                </div>
                @endif

            @endauth



        </div>
    </section>
    @if(session('popup'))
    <div style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;display:flex;justify-content: center;align-items: center;background-color:#000;">
        <div style="width: 300px;background-color:#fff;padding: 20px;">
            <p style="margin-bottom: 22px;display:block;">Вы не являетесь Анкетой</p>
            <div style="display:flex;justify-content: space-between;width: 100%;">
                <form action="{{ route('job.cancel', $job->id) }}" method="get">
                    @method('get')
                    <button type="submit">Отмена</button>
                </form>

                <a href="{{ route('worker.create') }}" style="display:block;">Создать анкету</a>
            </div>
        </div>
    </div>
    @endif
    <div class="popup_review_not_performed"
         style="width: 100%;
         height: 100vh;
         background-color:#000;
         position:absolute;top: 0;left: 0;display: none;justify-content: center;align-items: center;overflow: hidden;">
        <div style="padding: 30px;width: 300px;background-color: white;">
            <h4 style="text-align: center; margin-bottom: 22px;">Не выполнено</h4>
{{--            <label for="">--}}
{{--                Причина не выполнения:--}}
{{--                <input type="text">--}}
{{--                <select name="" id="">--}}
{{--                    <option value="">-- Причина --</option>--}}
{{--                    <option value="">Не явился на задание</option>--}}
{{--                    <option value="">Отказался</option>--}}
{{--                    <option value="">Уважительная причина</option>--}}
{{--                    <option value="">Свой вариант</option>--}}
{{--                </select>--}}
{{--            </label>--}}
{{--            <div>Оценка:--}}
{{--                <label for=""><input type="radio">1--}}
{{--                </label>--}}
{{--                <label for=""><input type="radio">2--}}
{{--                </label>--}}
{{--                <label for=""><input type="radio">3--}}
{{--                </label>--}}
{{--                <label for=""><input type="radio">4--}}
{{--                </label>--}}
{{--                <label for=""><input type="radio">5--}}
{{--                </label>--}}
{{--            </div>--}}
            <form action="{{ route('worker.review.store', $job->id) }}" method="post">
                @method('post')
                @csrf
                <div>
                    <label for="">Отзыв:
                        <textarea name="text" rows="4" cols="6" style=";border: 1px solid #555656"></textarea>
                    </label>
                </div>
                <div>
                    <button class="" type="submit">Отправить</button>
                </div>
            </form>
        </div>
    </div>
    <div class="popup_review_performed"
         style="width: 100%;
         height: 100vh;
         background-color:#000;
         position:absolute;top: 0;left: 0;display: none;justify-content: center;align-items: center;overflow: hidden;">
        <div style="padding: 20px;width: 300px;background-color: white;">
            <h4 style="text-align: center; margin-bottom: 22px;">Оцените выполнение</h4>
            <form action="{{ route('worker.review.store', $job->id) }}" method="post">
                @method('post')
                @csrf
                <div>
                    <label for="">
                        <span style="margin-bottom: 6px;display:block;">Отзыв:</span>
                        <textarea name="text" rows="4" cols="6" style=";border: 1px solid #555656"></textarea>
                    </label>
                </div>
                <div style="margin: 15px 0;">
                    <span style="margin-bottom: 6px;display:block;">Оценка:</span>
                    <div style="width: 170px;display:flex;justify-content: space-between;">
                        <label for=""><input style="margin-right: 5px;" type="radio" value="1" name="assessment" checked>1
                        </label>
                        <label for=""><input style="margin-right: 5px;" type="radio" value="2" name="assessment">2
                        </label>
                        <label for=""><input style="margin-right: 5px;" type="radio" value="3" name="assessment">3
                        </label>
                        <label for=""><input style="margin-right: 5px;" type="radio" value="4"  name="assessment">4
                        </label>
                        <label for=""><input style="margin-right: 5px;" type="radio" value="5" name="assessment">5
                        </label>
                    </div>
                </div>
                <div>
                    <button class="" style="width: 100%;padding: 5px 0;" type="submit">Отправить</button>
                </div>

            </form>
        </div>
    </div>
    <script src="{{ mix('js/job/item_job.js') }}"></script>
@endsection
