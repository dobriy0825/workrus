import csrf from "../../common/get_csrf";
//
// document.querySelector('.proportion_btn').addEventListener('click', function (e) {
//     e.preventDefault();
//     let fdd =  new FormData();
//     fdd.append('id',document.querySelector('.uuu').value);
//     let result = fetch('/job/ooo', {
//         method: 'post',
//         headers: {
//             'X-CSRF-TOKEN': csrf
//         },
//         body: fdd
//     });
//     console.log(result);
// });
document.querySelector('body').style.position = 'relative';


let tabs = document.querySelectorAll('.name_section');
let parts = document.querySelectorAll('.tab');
tabs.forEach(function (item) {
    item.addEventListener('click', function () {
        if (!item.classList.contains('name_section__active')) {
            tabs.forEach(function (item) {
                item.classList.remove('name_section__active');
            });
        }
        item.classList.add('name_section__active');
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

document.querySelector('.not_performed_btn').addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.popup_review_not_performed').style.display = 'flex';
});

document.querySelector('.performed_btn').addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.popup_review_performed').style.display = 'flex';
});

