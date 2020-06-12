<div class="for_popup types_of_jobs_selection_popup item_selection_popup">
    <div class="modal__window">

        <div  class="wrap_title_icon_close">
            <span class="select_value__title">Выберете вид работы</span>
            <i class="fas fa-times select_value__icon_close"></i>
        </div>
        <div class="header-for-mobile">
            <div class="header-mobile">
                <i class="header-mobile__right-btn fas fa-caret-left icon_white  select_value__btn_back"></i>
                <h2 class="header__title">Выберете категорию</h2>
            </div>
        </div>

        <!--<div style="position:relative;">
            <div class="wrap_select_value__search">
                <i class="header_mobile__right-btn fas fa-caret-left icon_white select_value__btn_back"></i>
{{--                <input class="select_value__search"  type="search" placeholder="например Москва" form="create_worker_form" name="city">--}}
            </div>
{{--            <div class="relevant_cities" style="position:absolute;background-color:#fff;width: 100%;z-index: 5;">--}}
{{--                <ul class="relevant_cities_list select_value__list" style="background-color: #fff;">--}}
{{--                    <li class="relevant_cities_item select_value__list_item"></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div> -->

        <div class="lists_column" style="background-color:#fff;">

            <div class="wrap_title_list wrap_title_parentlist wrap_title_list_parent_category">
{{--                <span class="select_value__title">1</span>--}}
                <ul class="select_value__list"></ul>
            </div>

            <div class="wrap_title_list wrap_title_sublist wrap_title_list_category">
{{--                <span class="select_value__title">3</span>--}}
                <ul class="select_value__list">
{{--                    @foreach($regions->find(1)->city as $city)--}}
{{--                    <li class="select_value__list_item">{{ $city->name }}</li>--}}
{{--                    @endforeach--}}

                </ul>
            </div>

        </div>

    </div>

</div>
