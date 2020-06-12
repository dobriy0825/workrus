function calendar(year, month, day, calendar) {

    let currentDate = new Date(year, month, day);

    let currentDay = currentDate.getDate();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    //calendar.firstElementChild.firstElementChild.nextElementSibling.firstElementChild.innerHTML = nameMonths[currentMonth];


    let daysInPrevMonth = new Date(currentYear, currentMonth, 0).getDate();
    let daysInCurrentMonth = new Date(currentYear, currentMonth+1, 0).getDate();
    let daysInNextMonth = new Date(currentYear, currentMonth+2, 0).getDate();

    let firstDayMonth = new Date(currentYear, currentMonth, 1).getDay();
    if (firstDayMonth == 0) {
        firstDayMonth = 7;
    }

    let result = daysInPrevMonth - firstDayMonth;
    if (firstDayMonth != 1 ) {
        for (let i = result+2; i <= daysInPrevMonth; i++) {
            let div = document.createElement('div');
            div.classList.add('calendar_number', 'calendar_number__last_day');
            //div.append(i);
            //console.log(calendar, 4);
            calendar.lastElementChild.lastElementChild.append(div);
        }
    }

    for (let i = 1; i <= daysInCurrentMonth; i++) {
        let div = document.createElement('div');
        div.classList.add('calendar_number');
        let d = new Date(year, month, i).getDay();
        if (d == 0) {
            d = 7;
        }
        if (d > 5) {
            div.classList.add('calendar_number__weekend');
        }
        if (new Date().getDate() > i && new Date().getMonth() == month) {
            div.classList.remove('calendar_number__weekend');
            div.classList.add('calendar_number__last_day');
        }
        if (!div.classList.contains('calendar_number__last_day')){
            div.classList.add('remaining_days');
        }
        div.setAttribute('data-number', i);
        div.append(i);
        calendar.lastElementChild.lastElementChild.append(div);
    }

    let lastDayMonth = new Date(currentYear, currentMonth + 1, 0).getDay();
    let s = 7 - lastDayMonth;
    for (let i = 1; i <= s; i++) {
        let div = document.createElement('div');
        if (s > 7){
            div.classList.add('calendar_number');
            div.append(i);
            document.querySelector('.calendar_numbers').append(div);
        }
    }
}

export default calendar;
