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

        <h2 class="section__title">Профиль</h2>
        <div class="menu-personal-area-mobile">
            <i class="fas fa-caret-left strelki-menu"></i>
            <ul class="menu-personal-area-mobile__items">
                <li class="menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link center a1" href="">Профиль</a>
                </li>
                <li class="menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link right b1" href="">Отзывы</a>
                </li>
                <li class=" menu-personal-area-mobile__item">
                    <a class=" menu-personal-area-mobile__link left c1" href="">Заглушка</a>
                </li>
            </ul>
            <i class="fas fa-caret-right strelki-menu"></i>
        </div>
        <hr class="menu-personal-area-mobile__line">

        <div class="wrap_article size_article700" style="position: relative;">
            <div style="position: absolute; top: 222px;left: 111px;">
                <button class="btn_prev">prev</button>
                <button class="btn_next">next</button>
            </div>
            <div class="part show_part">
                <div class="wrap_status_views">
                    <span class="status_online">На сайте</span>
                    <div class="views">
                        <i class="far fa-eye views_icon"></i>
                        <span class="views_number">63</span>
                    </div>
                </div>
                <article class="workerStyle my_worker">
                    <span class="worker-id">Профиль № {{ $user->id }}</span>
                    <div class="workerStyle__top">
                        <div>
                            <div class="workerStyle__avatar"></div>
                        </div>
                        <!-- Для мобильных -->
                        <div class="workerStyle__name_surname">
                            <div class="block">
                                <span class="workerStyle__prop">Имя</span>
                                <hr class="workerStyle__line">
                                <a href="" class="workerStyle__val">{{ $user->name }}</a>
                            </div>
                            <div class="block">
                                <span class="workerStyle__prop">Фамилия</span>
                                <hr class="workerStyle__line">
                                <div style="" class="ddd">
                                    <span class="workerStyle__val">{{ $user->surname }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Для ПК-->
                        <div class="workerStyle__name_surname_sex">
                            <div class="block">
                                <span class="workerStyle__prop">Имя</span>
                                <hr class="workerStyle__line">
                                <a href="" class="workerStyle__val">{{ $user->name }}</a>
                            </div>
                            <div class="block">
                                <span class="workerStyle__prop">Фамилия</span>
                                <hr class="workerStyle__line">
                                <span class="workerStyle__val">{{ $user->surname }}</span>
                            </div>
                            <div class="block">
                                <span class="workerStyle__prop">Пол</span>
                                <hr class="workerStyle__line">
                                <span class="workerStyle__val">{{ $user->sex }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Убрать для ПК-->
                    <div class="block sex">
                        <span class="workerStyle__prop">Пол</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val">{{ $user->sex }}</span>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Возраст</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val italic">{{ $user->age }}</span>
                    </div>

                    <div class="block">
                        <span class="workerStyle__prop">Номер телефон</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val" style="font-weight: 700;color: #099999;">Подтверждён</span>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">E-mail</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val" style="font-weight: 700;color: red;">Не подтверждён</span>


                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Анкета</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val"
                              style="font-weight: 700;color: {{ $user->isWorker() ? '#009999' : 'red' }};">{{ $user->isWorker() ? 'Да' : 'Нет' }}</span>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Задания</span>
                        <hr class="workerStyle__line">
                        <p class="workerStyle__val italic">{{ $user->jobs->count() }}</p>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Рейтинг</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val italic ">4.5</span>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Создано</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val italic">{{ $user->created_at }}</span>
                    </div>
                </article>
            </div>
            <div>
                <div>
                    <div class="wrap_name_section">
                        <span class="name_section">Отзывы (3)</span>
                    </div>
                    <div class="line_section"></div>
                </div>
            </div>
            <div class="part part_reviews_for_profile">
                <div class="wrap_reviews">
                    <div class="review">
                        <div class="wrap_avatar_name_type">
                            <div class="review__avatar_reviewer"></div>
                            <a href="" class="review__name_reviewer">Дмитрий</a>
                            <span class="review__type_user">(Исполнитель)</span>
                        </div>
                        <div class="wrap_name_title_job">
                            <span class="review__name_section">Задание:</span>
                            <a href="" class="review__title_job">Вскопать огород</a>
                        </div>

                        <div>
                            <span class="review__name_section">Отзыв:</span>
                            <p class="review__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>


                        <div class="wrap_stars_pubdate">
                            <div>
                                <span class="review__name_section">Оценка:</span>
                                <div class="fa-stars">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                            <time class="review__pubdate italic">24.07.2019</time>
                        </div>
                    </div>
                    <div class="review">
                        <div class="wrap_avatar_name_type">
                            <div class="review__avatar_reviewer"></div>
                            <a href="" class="review__name_reviewer">Дмитрий</a>
                            <span class="review__type_user">(Исполнитель)</span>
                        </div>
                        <div class="wrap_name_title_job">
                            <span class="review__name_section">Задание:</span>
                            <a href="" class="review__title_job">Вскопать огород</a>
                        </div>

                        <div>
                            <span class="review__name_section">Отзыв:</span>
                            <p class="review__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>


                        <div class="wrap_stars_pubdate">
                            <div>
                                <span class="review__name_section">Оценка:</span>
                                <div class="fa-stars">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                            <time class="review__pubdate italic">24.07.2019</time>
                        </div>
                    </div>
                </div>
                <span class="part__warning_text">Доступно только для авторизованных пользователей.</span>
            </div>

        </div>
    </section>
@endsection
