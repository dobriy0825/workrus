let moveMenu = document.querySelector('.moveMenu');
let overlay = document.querySelector('.overlay');

if (window.screen.width > 1028){
    moveMenu.remove();
}

// Показать выдвигаемое меню
document.querySelector('.header__bars').addEventListener('click', function () {
    moveMenu.classList.remove('hide_menu');
    moveMenu.classList.add('show_menu');

    overlay.classList.remove('hide_opacity');
    overlay.classList.add('show_opacity');
});


//Скрыть выдвигаемое меню
document.querySelector('.overlay').addEventListener('click', function () {
    moveMenu.classList.remove('show_menu');
    moveMenu.classList.add('hide_menu');


    overlay.classList.remove('show_opacity');
    overlay.classList.add('hide_opacity');
});
