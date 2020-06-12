<div class="for_popup city_selection_popup item_selection_popup">
    <div class="modal__window">
        {{-- Только для пк --}}
        <div  class="wrap_title_icon_close">
            <span class="select_value__title">Выберете город</span>
            <i class="fas fa-times select_value__icon_close"></i>
        </div>

        <div style="position:relative;">
            <div class="wrap_select_value__search">
                <i class="header_mobile__right-btn fas fa-caret-left icon_white select_value__btn_back"></i>
                <input class="select_value__search" type="search" placeholder="например Москва" name="city"
                       @if(old('city'))
                           value="{{ old('city') }}" form="create_worker_form"
                       @elseif(isset($myWorker))
                            value="{{ $myWorker->city }}" form="create_worker_form"
                       @endif
                >
            </div>
            <div class="relevant_cities" style="position:absolute;background-color:#fff;width: 100%;z-index: 5;">
                <ul class="relevant_cities_list select_value__list" style="background-color: #fff;">
                    {{--<li class="relevant_cities_item select_value__list_item"></li>--}}
                </ul>
            </div>
        </div>

        <div class="lists_column" style="background-color:#fff;">

            <div class="wrap_title_list wrap_title_parentlist wrap_title_list_region">
                <span class="select_value__title">Регион</span>
                <ul class="select_value__list">
                    <!--<li data-region="1" class="select_value__list_item select_value__list_item_active">
                        Астраханская обл.
                        <i class="fas fa-angle-right select_value__icon_right"></i>
                    </li>-->
                </ul>
            </div>

            <div class="wrap_title_list wrap_title_sublist wrap_title_list_city">
                <span class="select_value__title">Город</span>
                <ul class="select_value__list">
                    {{--<li class="select_value__list_item">Астрахаь</li>--}}
                </ul>
            </div>

        </div>

    </div>

</div>
