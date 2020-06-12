import ajaxGet from "../../common/ajaxGET";
import renderList from "../../common/renderList";
import renderSubList from "../../common/renderSubList";
import activeItem from "../../common/active_item";
import getItems from "../../common/get_items";
import forBackBtnMobileMode from "../../common/back_btn_for_mobile";

//----------------------------Показать выбор города -----------------------------
let citySelectionPopup = document.querySelector('.city_selection_popup');
let wrapParentList = document.querySelector('.city_selection_popup .wrap_title_parentlist');
let wrapSubList = document.querySelector('.city_selection_popup .wrap_title_sublist');
let elementForRegions = document.querySelector('.city_selection_popup .wrap_title_parentlist .select_value__list');
let elementForCities = document.querySelector('.city_selection_popup .wrap_title_sublist .select_value__list');
let itemRegion = document.querySelector('.city_selection_popup .wrap_title_parentlist .select_value__list_item');
let wrapSearch = document.querySelector('.city_selection_popup .wrap_select_value__search');
let inputSearch = document.querySelector('.city_selection_popup .select_value__search');
let backBtnForMobile = document.querySelector('.city_selection_popup .select_value__btn_back');
let showTownsBtn = document.querySelector('.btn_show_towns');
let closeBtn = document.querySelector('.city_selection_popup .select_value__icon_close');

showTownsBtn.addEventListener('click',  async function () {
    inputSearch.setAttribute('form', 'create_job_form');
    forBackBtnMobileMode(wrapSubList,backBtnForMobile);
    inputSearch.value = '';
    elementForRegions.innerHTML = '';
    if (itemRegion == undefined){
        let regions = await ajaxGet('/job/create/regions');
        renderList(elementForRegions, regions);
        let cities = regions[0].city;
        renderSubList(elementForCities, cities, 1);
    }
    citySelectionPopup.style.display = 'flex';
    inputSearch.focus();
});
//----------------------------Вывод городов при выборе региона -----------------------------
let regions;
let observerRegions = new MutationObserver((mutations) => {
    mutations.forEach(mutation => {
        if (mutation.addedNodes){
            regions = document.querySelectorAll('.wrap_title_parentlist .select_value__list_item');
        }
    });
    regions.forEach(function (item) {
        item.addEventListener('click', async function () {
            activeItem(regions, this);
            let id = item.getAttribute('data-region');
            let cities = await getItems(id, '/job/create/cities');
            renderSubList(elementForCities, cities, id);
            if (window.screen.width < 1024) {
                if (backBtnForMobile.classList.contains('back_in_page')){
                    backBtnForMobile.classList.remove('back_in_page');
                    backBtnForMobile.classList.add('back_in_items');
                }
                wrapParentList.style.display = 'none';
                wrapSubList.style.display = 'block';
            }
        });
    });
    if (window.screen.width < 1024) {
        wrapSearch.addEventListener('click', function (e) {
            let target = e.target;
            if (target.classList.contains('back_in_items')) {
                wrapSubList.style.display = 'none';
                wrapParentList.style.display = 'block';
                backBtnForMobile.classList.remove('back_in_items');
                backBtnForMobile.classList.add('back_in_page');
            }
        })
    }
});

observerRegions.observe(elementForRegions, {
    childList: true,
    attributes: true,
    attributeFilter: ['data-region'],
    attributeOldValue: true
});

//---------------------------------------------------------
let cities;
let observerCities = new MutationObserver((mutations) => {
    mutations.forEach(mutation => {
        if (mutation.attributeName == 'data-region'){
            cities = document.querySelectorAll('.city_selection_popup .wrap_title_sublist .select_value__list_item');
        }
    });
    cities.forEach(function (item) {
        item.addEventListener('click', function() {
            inputSearch.value = this.innerHTML;
            showTownsBtn.innerHTML = this.innerHTML;
            citySelectionPopup.style.display = 'none';
            backBtnForMobile.classList.remove('back_in_items', 'back_in_page');
        })
    });
});

observerCities.observe(elementForCities, {
    childList: true,
    attributes: true,
    attributeFilter: ['data-region'],
    attributeOldValue: true
});
//--------------------------Живой поиск по буквам-------------------------
let relevantCities = document.querySelector('.city_selection_popup .relevant_cities_list');
let columns = document.querySelector('.city_selection_popup .lists_column');
inputSearch.addEventListener('input', async function () {
    if (this.value === '') {
        relevantCities.style.display = 'none';
        columns.style.display = 'flex';
    }else {
        columns.style.display = 'none';
        relevantCities.style.display = 'block';
        let value = this.value;
        let data = new FormData();
        data.append('value', value);
        let request = await fetch('/job/create/city_search', {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            body: data
        });
        if (request.status !== 200) {
            throw new Error('no');
        }
        let response = await request.text();
        let result = JSON.parse(response);
        //----------------------------------
        relevantCities.innerHTML = '';
        result.forEach(function (item) {
            let li = document.createElement('li');
            li.classList.add('relevant_cities_item', 'select_value__list_item');
            li.append(item);
            relevantCities.append(li);
        });
    }
});

//-------------------------------------------------
let foundCities;
let observerFound = new MutationObserver(function (mutations) {
    mutations.forEach(function (item) {
        if (item.type == 'childList'){
            foundCities = document.querySelectorAll('.city_selection_popup .relevant_cities_item');
        }
    });
    foundCities.forEach(function (item) {
        item.addEventListener('click', function () {
            foundCities.forEach(function (item) {
                if (item.classList.contains('select_value__list_item_active')){
                    item.classList.remove('select_value__list_item_active');
                }
            });
            item.classList.add('select_value__list_item_active');
            inputSearch.value = this.innerHTML;
            showTownsBtn.innerHTML = this.innerHTML;
            citySelectionPopup.style.display = 'none';
            columns.style.display = 'flex';
            relevantCities.style.display = 'none';
            relevantCities.innerHTML = '';
        })
    })
});
observerFound.observe(relevantCities, {
    childList: true,
    attributes: false
});
//----------------------------Скрыть выбор города для пк ---------------------------
closeBtn.addEventListener('click', function () {
    citySelectionPopup.style.display = 'none';
});
//----------------------------Скрыть выбор города для мобильных ---------------------------
wrapSearch.addEventListener('click', function (e) {
    let target = e.target;
    if (target.classList.contains('back_in_page')) {
        citySelectionPopup.style.display = 'none';
        backBtnForMobile.classList.remove('back_in_page');
    }
});




//----------------------------Показать выбор вида работы -----------------------------
let showTypJobBtn = document.querySelector('.btn_show_typeJob__items');
let elementForCategories = document.querySelector('.types_of_jobs_selection_popup .wrap_title_parentlist .select_value__list');
let elementForSubCategories = document.querySelector('.types_of_jobs_selection_popup .wrap_title_sublist .select_value__list');
let wrapParentListTypeJob = document.querySelector('.types_of_jobs_selection_popup .wrap_title_parentlist');
let wrapSubListTypeJob = document.querySelector('.types_of_jobs_selection_popup .wrap_title_sublist');
let backBtnForMobileTypeJob = document.querySelector('.types_of_jobs_selection_popup .select_value__btn_back');
let itemCategory; //= document.querySelector('.types_of_jobs_selection_popup .wrap_title_parentlist .select_value__list_item');
let typeOfJobsSelection = document.querySelector('.types_of_jobs_selection_popup');
showTypJobBtn.addEventListener('click', async function () {

    forBackBtnMobileMode(wrapSubListTypeJob, backBtnForMobileTypeJob);

    if (itemCategory == null){
        let categories = await ajaxGet('/job/create/categories');
        renderList(elementForCategories, categories);
        //let subCategories = categories[0].sub_categories;
        //renderSubList(elementForSubCategories, subCategories, 1);
        // showTypJobBtn.innerHTML = categories[0].name;
    }
    typeOfJobsSelection.style.display = 'flex';
});

//----------------------------Вывод виды работ при выборе категории -----------------------------
// let categories;
// let nameCat;
// let observerCategory = new MutationObserver((mutations) => {
//     mutations.forEach(mutation => {
//         console.log(mutation);
//         if (mutation.type == 'childList'){
//             itemCategory = document.querySelector('.types_of_jobs_selection_popup .wrap_title_parentlist .select_value__list_item');
//             categories = document.querySelectorAll('.types_of_jobs_selection_popup .wrap_title_parentlist .select_value__list_item');
//         }
//     });
//     categories.forEach(function (item) {
//         item.addEventListener('click', async function () {
//             activeItem(categories, this);
//             let id = item.getAttribute('data-region');
//             console.log(id)
//             let subCategories = await getItems(id, '/job/create/sub_categories');
//             console.log(subCategories);
//             renderSubList(elementForSubCategories, subCategories, id);
//             if (window.screen.width < 1024) {
//                 if (backBtnForMobileTypeJob.classList.contains('back_in_page')){
//                     backBtnForMobileTypeJob.classList.remove('back_in_page');
//                     backBtnForMobileTypeJob.classList.add('back_in_items');
//                 }
//                 wrapParentListTypeJob.style.display = 'none';
//                 wrapSubListTypeJob.style.display = 'block';
//             }
//             nameCat = item.innerText;
//             //document.querySelector('.worker_category__input').value = item.innerText;
//             // showTypJobBtn.innerHTML = item.innerText;
//             // console.log(showTypJobBtn.innerText)
//         });
//     });
//     if (window.screen.width < 1024) {
//         document.querySelector('.types_of_jobs_selection_popup .header-for-mobile').addEventListener('click', function (e) {
//             let target = e.target;
//             if (target.classList.contains('back_in_items')) {
//                 wrapSubListTypeJob.style.display = 'none';
//                 wrapParentListTypeJob.style.display = 'block';
//                 backBtnForMobileTypeJob.classList.remove('back_in_items');
//                 backBtnForMobileTypeJob.classList.add('back_in_page');
//             }
//         })
//     }
// });
//
// observerCategory.observe(elementForCategories, {
//     childList: true,
//     attributes: true,
//     attributeFilter: ['data-region'],
//     attributeOldValue: true
// });
//
// //---------------------------------------------------------
// let subCategories;
// let nameSubCat;
// let observerSubCategory = new MutationObserver((mutations) => {
//     mutations.forEach(mutation => {
//         if (mutation.attributeName == 'data-region'){
//             subCategories = document.querySelectorAll('.types_of_jobs_selection_popup .wrap_title_sublist .select_value__list_item');
//         }
//     });
//     subCategories.forEach(function (item) {
//         item.addEventListener('click', function() {
//             activeItem(subCategories, this);
//             console.log(item);
//             if (elementForSubCategories.getAttribute('data-region') == 1){
//             }
//             typeOfJobsSelection.style.display = 'none';
//             backBtnForMobileTypeJob.classList.remove('back_in_items', 'back_in_page');
//             document.querySelector('.worker_subCategory__input').value = item.innerText;
//
//             nameSubCat = item.innerText;
//             let ww = document.querySelector('.worker_category__input').value  + ' ' + '▶' + ' ' + document.querySelector('.worker_subCategory__input').value;
//             showTypJobBtn.innerHTML = nameCat;
//         })
//     });
// });
//
// observerSubCategory.observe(elementForSubCategories, {
//     childList: true,
//     attributes: true,
//     attributeFilter: ['data-region'],
//     attributeOldValue: true
// });


document.querySelector('.types_of_jobs_selection_popup .select_value__icon_close').addEventListener('click',function () {
    typeOfJobsSelection.style.display = 'none';
    //showTypJobBtn.innerHTML = 'Выбрать вид задания';
});
document.querySelector('.types_of_jobs_selection_popup .header-for-mobile').addEventListener('click', function (e) {
    let target = e.target;
    if (target.classList.contains('back_in_page')) {
        typeOfJobsSelection.style.display = 'none';
        backBtnForMobileTypeJob.classList.remove('back_in_page');
    }
});














//---------------------------Календарь-------------------------------
import Calendar from "../../create_job/cal";
import ajaxPost from "../../common/ajaxPOST";
import csrf from "../../common/get_csrf";

let calendar = new Calendar();
document.querySelector('.wrap_period').addEventListener('click', function (e) {
    let element = e.target;
    if (element.classList.contains('date_time__datepicker')){
        calendar.overlay();
        calendar.html(element.parentElement);
    }
    if (element.classList.contains('calendar_next_btn')){
        calendar.nextMonth();
    }
    if (element.classList.contains('calendar_prev_btn')){
        calendar.prevMonth();
    }
});

document.querySelectorAll('.wrap_date').forEach(function (item) {
    item.addEventListener('click', function (e) {
        let element = e.target;
        if (element.classList.contains('remaining_days')){
            let number = element.innerHTML;
            let datepicker = item.children[1];
            calendar.selectDate(number, datepicker);
        }
    })
});
document.querySelector('body').addEventListener('click', function (e) {
    let element = e.target;
    if (element.classList.contains('overlay')){
        calendar.hide();
        element.remove();
    }
});







let selectCategory = document.querySelector('.select_category');
let selectSubCategory = document.querySelector('.select_sub_category');
selectCategory.addEventListener('change', async function () {
    let value = selectCategory.value;
    console.log(value)
    let subCategories = await getItems(value, '/job/create/sub_categories');
    //console.log(subCategories)
    // let options = document.querySelector('.yyy');
    // console.log(options)
    // if (options) {
    //     options.forEach(function (item) {
    //         item.remove();
    //     });
    // }
    selectSubCategory.innerHTML = '';

    subCategories.forEach(function (item) {
        let option = document.createElement('option');
        option.setAttribute('value', item.name);
        option.classList.add('yyy');
        option.append(item.name);
        selectSubCategory.append(option);
    })

});




//-------------------------Маска времени --------------------------
let input = document.querySelector('.date_time__time');

