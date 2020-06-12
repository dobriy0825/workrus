<!-- Выдвигающее меню -->
<div class="moveMenu  hide_menu">
    <div class="loginReg-menu authenticationMenu">
        <div class="loginReg authentication">
            @guest()
            <!-- Для не  авторизованного пользователя -->
            <div class="outin showAthentication aaa">
                <ul class="loginReg__items authentication__items">
                    <li class="loginReg__item authentication__item">
                        <a href="{{ route('login') }}" class="loginReg__link authentication__link">Вход</a>
                    </li>
                    <li class="loginReg__item authentication__item">
                        <a href="{{ route('create') }}" class="loginReg__link authentication__link">Регистрация</a>
                    </li>
                </ul>
                <p class="loginReg__attention authentication__attention">Вы не авторизовались! Пожалуйста авторизуйтесь!</p>
            </div>
            @endguest;
            @auth()
            <!-- Для авторизованного пользователя -->
            <div class="login">
                <ul class="loginReg__items authentication__items">
                    <li class="loginReg__item authentication__item"><a href="{{ route('cabinet.worker') }}" class="loginReg__link authentication__link">Моя анкета</a></li>
                    <li class="loginReg__item authentication__item"><a href="personal_area_jobs.html" class="loginReg__link authentication__link">Задания</a></li>
                </ul>
                <div class="wrapAvatar"  style="width: 100%;">
                    <div class="wrapAvatar__avatar"  style="width: 80px; height: 80px; margin-right: 10px;"></div>
                    <a href="personalArea.html" style="text-align: center; color: #fff;">Василий</a>
                </div>
                <ul class="loginReg__items authentication__items">
                    <li class="loginReg__item authentication__item"><a href="{{ route('cabinet.settings') }}" class="loginReg__link authentication__link">Настройки</a></li>
                    <li class="loginReg__item authentication__item"><a href="{{ route('logout') }}" class="loginReg__link authentication__link">Выйти</a></li>
                </ul>
            </div>
            @endauth;
        </div>
        <div class="menu">
            <div class="titleMenu">
                <h3 class="menu__titleMenu">Меню</h3>
            </div>
            <ul class="menu__items">
                <li class="menu__item"><a href="{{ route('main') }}" class="menu__link">Главная</a></li>
                <li class="menu__item"><a href="" class="menu__link">Анкеты</a></li>
                <li class="menu__item"><a href="" class="menu__link">Задания</a></li>
                <li class="menu__item"><a href="" class="menu__link">Отзызы</a></li>
                <li class="menu__item"><a href="" class="menu__link">О нас</a></li>
            </ul>
        </div>
    </div>
    <div class="overlay hide_opacity"></div>
</div>
