function renderSubList(element, items, id) {
    element.innerHTML = '';
    items.forEach(function (item) {
        let li = document.createElement('li');
        li.className = 'select_value__list_item';
        li.append(item.name);
        element.append(li);
        element.setAttribute('data-region', id);
    })
}
export default renderSubList;
