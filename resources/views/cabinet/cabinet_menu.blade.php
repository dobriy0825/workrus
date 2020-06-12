
    <div class="menu-personal-area-mobile" style="background-color: rgba(0,0,0,0.08);padding: 10px 10px 0 10px;">
        <i class="fas fa-caret-left strelki-menu"></i>
        <ul class="menu-personal-area-mobile__items">
            <li class="menu-personal-area-mobile__item">
                <a class=" menu-personal-area-mobile__link center a1" href="{{ route('cabinet.worker') }}">Моя анкета</a>
            </li>
            <li class="menu-personal-area-mobile__item">
                <a class=" menu-personal-area-mobile__link right b1" href="">Задания</a>
            </li>
            <li class=" menu-personal-area-mobile__item">
                <a class="menu-personal-area-mobile__link left c1" href="{{ route('cabinet.settings') }}">Настройки</a>
            </li>
        </ul>
        <i class="fas fa-caret-right strelki-menu"></i>

    </div>


{{--<hr class="menu-personal-area-mobile__line" style="margin-bottom: 10px;">--}}


<div class="menu-personal-area-desktop">
    <ul class="menu-personal-area-desktop__items">
        <li class=" menu-personal-area-desktop__item">
            <a href="{{ route('cabinet.worker') }}" class="menu-personal-area-desktop__link">Моя анкета</a>
        </li>
        <li class="menu-personal-area-desktop__item">
            <a href="{{ route('cabinet.job') }}" class="menu-personal-area-desktop__link menu-personal-area-desktop__link_active">Задание</a>
        </li>
        <li class=" menu-personal-area-desktop__item">
            <a href="{{ route('cabinet.settings') }}" class="menu-personal-area-desktop__link">Настройки</a>
        </li>
    </ul>
    <li class=" menu-personal-area-desktop__item">
        <a href="#" class="menu-personal-area-desktop__link">Выйти</a>
    </li>
</div>
