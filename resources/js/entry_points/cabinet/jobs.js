let tabs = document.querySelectorAll('.submenu-jobs__link');
let parts = document.querySelectorAll('.tab');
tabs.forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        if (!item.classList.contains('submenu-jobs__link_active')) {
            tabs.forEach(function (item) {
                item.classList.remove('submenu-jobs__link_active');
            });
        }
        item.classList.add('submenu-jobs__link_active');
        let nameClass = item.getAttribute('data-content');

        parts.forEach(function (part) {
            if (!part.classList.contains(nameClass)){
                part.style.display = 'none';
            }
        });
        let content = document.querySelector('.' + nameClass);
        content.style.display = 'block';
    })
});
