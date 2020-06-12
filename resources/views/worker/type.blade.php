<div class="for-popup jobs_selection_popup">
    <div class="modal__window">
        <header class="header-for-mobile" >
            <div class="header-mobile">
                <i class="header-mobile__right-btn fas fa-times icon_white close_btn"></i>
                <h2 class="header__title">Выбрать виды работ</h2>
            </div>
        </header>
        <div class="typeJob__items" >
            @foreach($categories as $category)
                <div class="typeJob__item">
                    <div class="typeJob__item__title">
                        {{ $category->name }}
                        <i class="typeJob__item__icon fas fa-angle-down"></i>
                    </div>
                    <ul class="typeJob__item__subItems">
                        @foreach($category->subCategories as $subCategory)
                            <li class="typeJob__item__subItem">
                                <input class="typeJob__item__subItem__input"
                                       type="checkbox"
                                       name="subCategory[]"
                                       id="{{ $subCategory->id }}"
                                       value="{{ $subCategory->id }}"
                                       form="create_worker_form"
                                        @if(old('subCategory'))
                                            {{ in_array($subCategory->id, old('subCategory')) ? 'checked' : ''}}
                                        @endif

                                       @if(isset($idSubCategories))
                                            {{ in_array($subCategory->id, $idSubCategories) ? 'checked' : ''}}
                                       @endif>

                                <label class="typeJob__item__subItem__label" for="{{ $subCategory->id }}">{{ $subCategory->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="block btn_for_selected">
            <button class="кнопка для выбора">Выбрать</button>
        </div>
    </div>
</div>
