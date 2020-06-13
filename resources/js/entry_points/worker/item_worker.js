// Показать \ Скрыть виды работ
document.querySelector('.show_types_of_jobs_btn').addEventListener('click', function () {
    document.querySelector('.types_of_jobs_popup').style.display = 'block';
    document.querySelector('.show_types_of_jobs_btn').innerHTML = 'Скрыть';
});
document.querySelector('.close_types_of_jobs').addEventListener('click', function () {
    document.querySelector('.types_of_jobs_popup').style.display = 'none';
    document.querySelector('.show_types_of_jobs_btn').innerHTML = 'Показать';
});

//
