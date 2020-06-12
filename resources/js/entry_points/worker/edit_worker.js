
//----------------------------Показать выбор города -----------------------------
import forBackBtnMobileMode from "../../common/back_btn_for_mobile";
import ajaxGet from "../../common/ajaxGET";
import renderList from "../../common/renderList";
import renderSubList from "../../common/renderSubList";
import activeItem from "../../common/active_item";
import getItems from "../../common/get_items";
import csrf from "../../common/get_csrf";

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
    inputSearch.setAttribute('form', 'create_worker_form');
    forBackBtnMobileMode(wrapSubList,backBtnForMobile);
    inputSearch.value = '';
    elementForRegions.innerHTML = '';
    if (itemRegion == undefined){
        let regions = await ajaxGet('/worker/create/regions');
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
            let cities = await getItems(id, '/worker/create/cities');
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
        let request = await fetch('/worker/create/city_search', {
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



//-----------------------Анимация выбора работ--------------------------
let typeJobItem = document.querySelectorAll('.typeJob__item__title');
typeJobItem.forEach(function (item) {
    item.addEventListener('click', function () {
        this.parentNode.classList.toggle('typeJob__item__show');
        this.classList.toggle('typeJob__item__title__green');
        console.log(this.nextElementSibling);
        this.nextElementSibling.classList.toggle('typeJob__item__subItems');
        this.firstElementChild.classList.toggle('typeJob__item__icon__up');
    })
});
//----------------------Показать выбор типа работ для мобильных -------------------------
document.querySelector('.btn_show_typeJob__items').addEventListener('click', function () {
    document.querySelector('.jobs_selection_popup').style.display = 'block';
});
//----------------------Скрыть выбор типа работ для мобильных -------------------------
document.querySelector('.jobs_selection_popup .close_btn').addEventListener('click', function () {
    document.querySelector('.jobs_selection_popup').style.display = 'none';
});


