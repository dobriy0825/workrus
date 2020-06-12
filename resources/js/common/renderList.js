function renderList(element, items) {
    items.forEach(function (item) {
        let li = document.createElement('li');
        li.classList.add('select_value__list_item');
        //defaultChoice(item.id, 1, li);
        li.setAttribute('data-region', item.id);
        let iTag = document.createElement('i');
        iTag.classList.add('fas', 'fa-angle-right', 'select_value__icon_right');
        li.append(item.name, iTag);
        element.append(li);
    })
}

function defaultChoice(value1, value2, element) {
    if (value1 == value2){
        element.classList.add('select_value__list_item_active');
    }
}
export default renderList;
