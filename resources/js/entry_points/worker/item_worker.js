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
import csrf from "../../common/get_csrf";

async function getProposedJob(url, nameClass,){
    let form = new FormData();
    form.append('worker_id', '1');
    let query = fetch(url, {
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        body: form
    }).then(function (response) {
        return response.json()
    }).then(function (y) {
        if (y.length > 0) {
            let the;
            y.forEach(function (item) {
                the = html(item);
                document.querySelector(nameClass).insertAdjacentHTML('beforeend', the);
            });
        }else {
            let span = '<span class="part__warning_text">Нет заданий.</span>';
            document.querySelector(nameClass).insertAdjacentHTML('beforeend', span);
        }
    })
}
function getHiredJob() {
    let form = new FormData();
    form.append('worker_id', '1');
    let query = fetch('/get_hired_jobs', {
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        body: form
    }).then(function (response) {
        return response.json()
    }).then(function (y) {
        if (y.length > 0) {
            let the;
            y.forEach(function (item) {
                the = html(item);
                document.querySelector('.part_hired_jobs .cards').insertAdjacentHTML('beforeend', the);
            });
        }else {
            let span = '<span class="part__warning_text">Нет принятых заданий.</span>';
            document.querySelector('.part_hired_jobs .cards').insertAdjacentHTML('beforeend', span);
        }
    })
}
function html(item) {
    return `
        <div class="card">
            <div class="data data-height75">
                <div class="data__topRow">
                    <a href="" class="topRow__name">${item.title}</a>
                    <p class="topRow__price">цена: <span>${item.price}</span>р.</p>
                </div>
                <p class="data__description">${item.description.substr(0, 88)}</p>
                <div class="data__bottomRow">
                    <p class="bottomRow__create">создание: ${item.created_at}</p>
                    <a href="workrus.loc/job/${item.id}" class="bottomRow__detailed">Подробнее</a>
                </div>
            </div>
        </div>
    `
}
////getProposedJob('/get_proposed_jobs', '.part_proposed_jobs .cards');


//
// let nameSections = document.querySelectorAll('.name_section');
//
// nameSections.forEach(function (section) {
//     section.addEventListener('click', function () {
//         nameSections.forEach(function (section) {
//             if (section.classList.contains('name_section__active')){
//                 section.classList.remove('name_section__active');
//             }
//             let attribute = section.getAttribute('data-content');
//         });
//         section.classList.add('name_section__active');
//
//         document.querySelectorAll('.tab').forEach(function (item) {
//             if (item.classList.contains('.' + attribute)){
//
//             }
//         })
//     })
// });
export function ff() {
    let proposedJobBtn = document.querySelector('.proposed_job_btn');
    proposedJobBtn.addEventListener('click', async function () {
;
    });
}


