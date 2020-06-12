
//renderProposedJobs('/get_open_jobs');

import csrf from "../resources/js/common/get_csrf";

async function f(form){
    let query = await fetch('/worker/proposed_job', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        body: form
    })
}
document.querySelector('.offer_job_btn').addEventListener('click', async function () {
    let jobs = await getOpenJobs();
    if (jobs.length > 1) {
        jobs.forEach(function (job) {
            let div = `<div style="display:flex; align-items: center;"><input type="radio" style="width: 22px;height: 22px;margin-right: 15px;" name="job_id" value=""><div class="card"><div class="data data-height75"><div class="data__topRow"><a href="//localhost:3000/job/${job.id}" class="topRow__name">${job.title}</a><p class="topRow__price">цена: <span>${job.price}</span>р.</p></div><p class="data__description">${job.description.substr(0, 88)}</p><div class="data__bottomRow"><p class="bottomRow__create">создание: ${job.created_at}</p><a href="//localhost:3000/job/${job.id}" class="bottomRow__detailed">Подробнее</a></div></div></div></div>`;
            document.querySelector('.popup_offer_jobs .cards').insertAdjacentHTML('beforeend', div);
            document.querySelector('.popup_offer_jobs').style.display = 'flex';
        });
    }else {
        let job = jobs[0];
        let formData = new FormData();
        formData.append('id', job.id);
        console.log(window.location.pathname.split('/')[2]);
        let workerId = window.location.pathname.split('/')[2]
        formData.append('worker_id', workerId);
        await f(formData);
        let card = `<div style="">
                    <div class="card">
                        <div class="data data-height75">
                            <div class="data__topRow">
                                <a href="//localhost:3000/job/${job.id}" class="topRow__name">${job.title}</a>
                                <p class="topRow__price">цена: <span>${job.price}</span>р.</p>
                            </div>
                            <p class="data__description">${job.description.substr(0, 88)}</p>
                            <div class="data__bottomRow"><p class="bottomRow__create">создание: ${job.created_at}</p>
                                <a href="//localhost:3000/job/${job.id}" class="bottomRow__detailed">Подробнее</a>
                            </div>
                        </div>
                     </div>
                     <div>
                        <button style="border: none;border-radius: 3px;color: white;background-color:#009999;width: 130px;padding: 4px 0;font-size: 15px;">Взять задание</button>
                     </div>

                    </div>`;
        document.querySelector('.part_proposed_jobs .cards').insertAdjacentHTML('beforeend', card);
    }
});

document.querySelector('.popup_offer_jobs').addEventListener('click', function (e) {
    if (e.target.classList.contains('popup_offer_jobs')) {
        this.style.display = 'none';
    }
});





class Job {
    render(){

    }
}

let card = document.createElement('div');
card.classList.add('card');
let data = document.createElement('div');
data.classList.add('data', 'data-height75');
let data_topRow = document.createElement('div');
data_topRow.classList.add('data__topRow');
let topRow__name = document.createElement('a');
topRow__name.classList.add('topRow__name');
let topRow__price = document.createElement('p');
topRow__name.classList.add('topRow__price');
let data__description = document.createElement('p');
data__description.classList.add('data__description');



