<header class="header-for-main-mobile">
    <div class="header-main_mobile">
        <i class="fas fa-bars header__bars icon_green"></i>
        <img src="{{ asset('images/logo.png') }}" alt="" class="header__logo">
        <div class="createBtn">
            <button class="createBtn__btn" href="index.html">Создать анкету</button>
            <button class="createBtn__btn">Создать задание</button>
        </div>
    </div>
</header>

<!-- Шапка главной страницы для ПК -->
<header class="header-for-desktop">
    <div class="header-main">
        <nav class="loginReg-menu">
            <ul class="menu__items">
                <li class="menu__item"><a href="{{ route('main') }}" class="menu__link">Главная</a></li>
                <li class="menu__item"><a href="search_workers.html" class="menu__link">Анкеты</a></li>
                <li class="menu__item"><a href="" class="menu__link">Задания</a></li>
                <li class="menu__item"><a href="" class="menu__link">Отзызы</a></li>
                <li class="menu__item"><a href="" class="menu__link">О нас</a></li>
            </ul>
        @guest()
            <!-- Для не авторизованного пользователя -->
                <div class="outin showAthentication">
                    <ul class=" authentication__items">
                        <li class="loginReg__item authentication__item"><a href="{{ route('show.form.login') }}" class="loginReg__link authentication__link">Вход</a></li>
                        <li class="loginReg__item authentication__item"><a href="{{ route('create') }}" class="loginReg__link authentication__link">Регистрация</a></li>
                    </ul>
                </div>
        @endguest
        @auth()
            <!-- Для авторизованного пользователя -->
                <div class="login">
                    <a href="personalAreaMyWorker.html">
                        <div class="authentication__items">
                            <div class="authentication__avatar">
                            </div>
                            <div>
                                <span class="authentication__userName">{{ \Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Выпадающее меню -->
                    <div class="personalAreaMenu">
                        <ul class="personalAreaMenu__items">
                            <li class="personalAreaMenu__item"><a href="personal_area_my_worker.html" class="personalAreaMenu__link">Моя анкета</a></li>
                            <li class="personalAreaMenu__item"><a href="personal_area_jobs.html" class="personalAreaMenu__link">Задания</a></li>
                            <li class="personalAreaMenu__item"><a href="{{ route('cabinet.settings') }}" class="personalAreaMenu__link">Настройки</a></li>
                            <li class="personalAreaMenu__item"><a href="{{ route('logout') }}" class="personalAreaMenu__link personalAreaMenu__exit">Выйти</a></li>
                        </ul>
                    </div>
                </div>
            @endauth
        </nav>


        <img src="{{ asset('images/logo.png') }}" alt="" class="header__logo">
        <div class="sloganCreateBtn">
            <div class="slogan">
                <h1 class="slogan__ask">Ищите работу?</h1>
                <p class="slogan__answer">Мы Вам поможем в этом!</p>
            </div>
            <div class="createBtn">
                <button class="createBtn__btn">Создать анкету</button>
                <button class="createBtn__btn">Создать задание</button>
            </div>
        </div>
    </div>
</header>
