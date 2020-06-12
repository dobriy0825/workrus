function activeItem(items, element) {
    items.forEach(function (item) {
        if (item.classList.contains('select_value__list_item_active')){
            item.classList.remove('select_value__list_item_active');
        }
    });
    element.classList.add('select_value__list_item_active')
}
export default activeItem;
