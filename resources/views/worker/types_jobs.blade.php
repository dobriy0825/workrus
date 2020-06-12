<div class="for-popup types_of_jobs_popup" style="display:none;">
    <div class="modal__window">

        <header class="header-for-mobile">
            <div class="header-mobile">
                <i class="fas fa-times icon_white header-mobile__right-btn close_types_of_jobs"></i>
                <h2 class="header__title">Виды работ</h2>
            </div>
        </header>

        <ul class="items_categories">
            @foreach($categories as $category)
                <li class="item_category_jobs">
                    {{ $category['name'] }}
                    <ul>
                        @foreach($subCategories as $subCategory)
                            <li class="item_job">{{ $subCategory['category_id'] == $category['id'] ? $subCategory['name'] : ''}}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>

    </div>
</div>


