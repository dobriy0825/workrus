//import csrf from "../../common/get_csrf";

document.querySelector('.show_types_of_jobs_btn').addEventListener('click', function () {
    console.log(7)
    document.querySelector('.types_of_jobs_popup').style.display = 'block';
    document.querySelector('.show_types_of_jobs_btn').innerHTML = 'Скрыть';
});
document.querySelector('.close_types_of_jobs').addEventListener('click', function () {
    document.querySelector('.types_of_jobs_popup').style.display = 'none';
    document.querySelector('.show_types_of_jobs_btn').innerHTML = 'Показать';
});

// function renderCard(job){
//             return `<div style="">
//                     <div class="card">
//                         <div class="data data-height75">
//                             <div class="data__topRow">
//                                 <a href="//localhost:3000/job/${job.id}" class="topRow__name">${job.title}</a>
//                                 <p class="topRow__price">цена: <span>${job.price}</span>р.</p>
//                             </div>
//                             <p class="data__description">${job.description.substr(0, 88)}</p>
//                             <div class="data__bottomRow"><p class="bottomRow__create">создание: ${job.created_at}</p>
//                                 <a href="//localhost:3000/job/${job.id}" class="bottomRow__detailed">Подробнее</a>
//                             </div>
//                         </div>
//                      </div>
//                      <div>
//                         <button style="border: none;border-radius: 3px;color: white;background-color:#009999;width: 130px;padding: 4px 0;font-size: 15px;">Да</button>
//                         <button style="border: none;border-radius: 3px;color: white;background-color:#009999;width: 130px;padding: 4px 0;font-size: 15px;">Нет</button>
//                      </div>
//                 </div>`;
// }
//
//
// async function getModel(url){
//     let query = await fetch(url);
//     if (query.status !== 200){
//         throw new Error('no')
//     }
//     let result = await query.text();
//     return JSON.parse(result);
// }
//
// async function renderProposedJobs(url){
//     let query = await fetch(url);
//     let status = query.status;
//     if (status  !== 200){
//         throw new Error('Запрос не получился');
//     }
//     let result = await query.text();
//     return JSON.parse(result);
// }
//
// console.log(renderProposedJobs('/get_proposed_jobs'));
// //let jobs = JSON.parse(renderProposedJobs('/get_proposed_jobs'))
// function the (){
//
// }
// let j = renderProposedJobs('/get_proposed_jobs');
// console.log(j)
//
//
// let tabs = document.querySelectorAll('.name_section');
// tabs.forEach(function (item) {
//     item.addEventListener('click', async function () {
//
//             if (!item.classList.contains('name_section__active')) {
//                 tabs.forEach( function (item) {
//                     item.classList.remove('name_section__active');
//                 });
//         }
//
//         item.classList.add('name_section__active');
//         let nameClass = item.getAttribute('data-content');
//         let url;
//         if (nameClass === 'part_proposed_jobs'){
//             url = '/get_proposed_jobs';
//         }else if (nameClass === 'part_hired_jobs'){
//             url = '/worker/get_hired_jobs';
//         }else if (nameClass === 'part_your_job'){
//             url = '/worker/get_your_job';
//         }else if (nameClass === 'part_hired_jobs'){
//             url = '/worker/get_hired_jobs';
//         }else if (nameClass === 'part_reviews'){
//             url = '/worker/get_reviews';
//         }
//
//         await renderProposedJobs(url);
//     })
// });
//
// if(document.querySelector('.offer_job_btn')) {
//     document.querySelector('.offer_job_btn').addEventListener('click', async function () {
//         let queryJobs = await fetch('/get_open_jobs');
//         if (queryJobs.status !== 200) {
//             throw new Error('message')
//         }
//         let dataJobs = await queryJobs.text();
//         let jobs = JSON.parse(dataJobs);
//         if (jobs) {
//
//             if (jobs.length < 2) {
//                 let worker_id = window.location.pathname.split('/')[2];
//                 let formData = new FormData();
//                 console.log(worker_id, jobs[0].id);
//                 formData.append('job_id', jobs[0].id);
//                 formData.append('worker_id', worker_id);
//                 let query = await fetch('/proposed_job', {
//                     method: 'post',
//                     headers: {
//                         'X-CSRF-TOKEN': csrf
//                     },
//                     body: formData
//                 });
//                 if (query.status !== 200) {
//                     throw new Error('message')
//                 }
//                 let part = document.createElement('div');
//                 part.classList.add('part');
//                 let cards = document.createElement('div');
//                 cards.classList.add('cards');
//                 let card = renderCard(jobs[0]);
//                 cards.insertAdjacentHTML('beforeend', card);
//                 part.append(cards);
//                 document.querySelector('.wrap_article').append(part);
//             }
//         } else {
//             //
//         }
//
//
//     })
//
// }





document.querySelector('.offer_job_btn').addEventListener('click', function () {
    console.log('Принять задание')
})
