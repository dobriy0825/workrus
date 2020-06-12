import ajaxPost from "../common/ajaxPOST";

export default function (regions) {

    regions.forEach(function (item) {
        // Клик по региону
        item.addEventListener('click', async function () {

            // добавить  стили активного региона
            regions.forEach(function (item) {
                if (item.classList.contains('select_value__list_item_active')){
                    item.classList.remove('select_value__list_item_active');
                }
            });
            item.classList.add('select_value__list_item_active');


            // запрос на города
            let id = item.getAttribute('data-region');
            let result = await ajaxPost('/worker/create/region', id);
            let cities = JSON.parse(result);


            // вывод городов
            document.querySelector('.wrap_title_list_city .select_value__list').innerHTML = '';
            cities.forEach(function (item) {
                let li = document.createElement('li');
                li.className = 'select_value__list_item';
                li.append(item.name);
                document.querySelector('.wrap_title_list_city .select_value__list').append(li);
            });

            // изменение атрибута
            document.querySelector('.wrap_title_list_city .select_value__list').setAttribute('data-region', id);
        })
    });
}
