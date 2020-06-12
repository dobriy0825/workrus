import ajaxPost from "../common/ajaxPOST";

export default function (items, url, element) {

    items.forEach(function (item) {
        // Клик по региону
        item.addEventListener('click', async function () {

            // добавить  стили активного региона
            items.forEach(function (item) {
                if (item.classList.contains('select_value__list_item_active')){
                    item.classList.remove('select_value__list_item_active');
                }
            });
            item.classList.add('select_value__list_item_active');

            // запрос на города
            let id = item.getAttribute('data-region');
            let result = await ajaxPost(url, id);
            let subItems = JSON.parse(result);

            // вывод городов
            element.innerHTML = '';
            subItems.forEach(function (item) {
                let li = document.createElement('li');
                li.className = 'select_value__list_item';
                li.append(item.name);
                element.append(li);
            });
            if (window.screen.width < 1024) {
                if (document.querySelector('.city_selection_popup .select_value__btn_back').classList.contains('back_in_worker')){
                    document.querySelector('.city_selection_popup .select_value__btn_back').classList.remove('back_in_worker');
                    document.querySelector('.city_selection_popup .select_value__btn_back').classList.add('back_in_regions');
                }
                document.querySelector('.city_selection_popup .wrap_title_list1').style.display = 'none';
                document.querySelector('.city_selection_popup .wrap_title_list2').style.display = 'block';

                document.querySelector('.city_selection_popup .wrap_select_value__search').addEventListener('click', function (e) {
                    if (e.target.classList.contains('back_in_regions')) {
                        document.querySelector('.city_selection_popup .wrap_title_list2').style.display = 'none';
                        document.querySelector('.city_selection_popup .wrap_title_list1').style.display = 'block';
                        document.querySelector('.city_selection_popup .select_value__btn_back').classList.remove('back_in_regions');
                        document.querySelector('.city_selection_popup .select_value__btn_back').classList.add('back_in_worker');
                    }
                })
            }

            // изменение атрибута
            element.setAttribute('data-region', id);
        })
    });
}



