function Calendar() {
    this.nameMonths = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    this.currentDate = new Date();
    this.currentYear = this.currentDate.getFullYear();
    this.currentMonth = this.currentDate.getMonth();

    this.renderDays = function (numbers) {
        let numberOfDays = new Date(this.currentYear, this.currentMonth, 0).getDate();
        let dayOfTheOfDays = new Date(this.currentYear, this.currentMonth, 1).getDay();
        if (dayOfTheOfDays == 0){
            dayOfTheOfDays = 7;
        }
        let g = numberOfDays - dayOfTheOfDays;
        for (let i = g + 2; i <= numberOfDays; i++){
            let number = document.createElement('div');
            number.classList.add('calendar_number', 'calendar_number__last_day');
            //number.append(i);
            numbers.append(number);
        }
        let numberOfDaysInCurrentMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
        for (let i = 1; i <= numberOfDaysInCurrentMonth; i++){
            let day = new Date(this.currentYear, this.currentMonth, i).getDay();
            let number = document.createElement('div');
            number.classList.add('calendar_number');
            this.calculateWeekend(day, number);
            this.pastDays(i, number);
            this.remainingDay(i, number);
            number.append(i);
            numbers.append(number);
        }
    };
    this.html = function (node) {
        let divCalendar = document.createElement('div');
        divCalendar.classList.add('calendar');

        let divTop = document.createElement('div');
        divTop.classList.add('calendar_top');

        let prevBtn = document.createElement('div');
        prevBtn.classList.add('calendar_arrow_btn', 'calendar_prev_btn', 'calendar_arrow_btn__disable');

        let wrapMonthYear = document.createElement('div');
        wrapMonthYear.classList.add('wrap_month_year');

        let month = document.createElement('div');
        month.classList.add('calendar_month');

        let year = document.createElement('div');
        year.classList.add('calendar_year');

        let nextBtn = document.createElement('div');
        nextBtn.classList.add('calendar_arrow_btn', 'calendar_next_btn');

        let divBottom = document.createElement('div');
        divBottom.classList.add('calendar_bottom');

        let weekDays = document.createElement('div');
        weekDays.classList.add('calendar_days-of-the-week');

        let numbers = document.createElement('div');
        numbers.classList.add('calendar_numbers');

        this.renderDays(numbers);

        prevBtn.append('◀');
        nextBtn.append('▶');
        month.append(this.nameMonths[this.currentMonth]);
        year.append(this.currentYear);
        let week = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
        for (let i = 0; i < week.length; i++){
            let weekDay = document.createElement('div');
            weekDay.classList.add('calendar_day-of-the-week');
            if (i >= 5){
                weekDay.classList.add('calendar_day-of-the-week__weekend');
            }
            weekDay.append(week[i]);
            weekDays.append(weekDay);
        }
        divBottom.append(weekDays);
        divBottom.append(numbers);
        wrapMonthYear.append(month, year);
        divTop.append(prevBtn, wrapMonthYear, nextBtn);
        divCalendar.append(divTop, divBottom);
        divCalendar.style.position = 'absolute';
        divCalendar.style.top = '27px';
        divCalendar.style.zIndex = '9';
        node.append(divCalendar);
    };


    this.selectDate = function (number, element) {
        element.value = this.formatDate(number);
        this.hide();
        document.querySelector('.overlay').remove();

    };
    this.cleanNumbers = function () {
        document.querySelector('.calendar_numbers').innerHTML = '';
    };
    this.nextMonth = function () {
        this.cleanNumbers();
        this.currentMonth++;
        if (this.currentMonth == 12){
            this.currentMonth = 0;
            this.currentYear++;
        }
        this.renderDays(document.querySelector('.calendar_numbers'));
        this.renderMonth(this.nameMonths[this.currentMonth]);
        document.querySelector('.calendar_year').innerHTML = this.currentYear;
        if (this.currentMonth > this.currentDate.getMonth()){
            document.querySelector('.calendar_prev_btn').classList.remove('calendar_arrow_btn__disable');
        }

    };

    this.renderMonth = function () {
        document.querySelector(".calendar_month").innerHTML = this.nameMonths[this.currentMonth];
    };
    this.prevMonth = function () {
        if (this.currentMonth != this.currentDate.getMonth()){
            this.cleanNumbers();
            this.currentMonth--;
            if (this.currentMonth == -1){
                this.currentMonth = 11;
                this.currentYear--;
            }
            this.renderDays(document.querySelector('.calendar_numbers'));
            this.renderMonth(this.nameMonths[this.currentMonth]);
            document.querySelector('.calendar_year').innerHTML = this.currentYear;
        }

        if (this.currentMonth <= this.currentDate.getMonth()){
            document.querySelector('.calendar_prev_btn').classList.add('calendar_arrow_btn__disable');
        }
    };
    this.calculateWeekend = function (day, number) {
        if (day == 0){
            day = 7;
        }
        if (day > 5){
            number.classList.add('calendar_number__weekend');
        }
    };
    this.pastDays = function(day, number){
        if (day < this.currentDate.getDate() && this.currentDate.getMonth() == this.currentMonth && this.currentDate.getFullYear() == this.currentYear){
            number.classList.add('calendar_number__last_day');
            number.classList.remove('calendar_number__weekend')
        }
    };
    this.remainingDay = function (day, number) {
        if (!number.classList.contains('calendar_number__last_day')){
            number.classList.add('remaining_days');
        }
    };

    this.hide = function () {
        this.currentYear = this.currentDate.getFullYear();
        this.currentMonth = this.currentDate.getMonth();
        document.querySelector('.calendar').remove();
    };
    this.formatDate = function (day) {
        if (String(day).length < 2){
            day = '0' + day;
        }
        let m = this.currentMonth + 1;
        if (String(m).length < 2){
            m = '0' + m;
        }
        return day +  '.' + m + '.' + this.currentYear;
    };
    this.overlay = function () {
        let overlayFix = document.createElement('div');
        overlayFix.classList.add('overlay');
        overlayFix.style.position = 'absolute';
        overlayFix.style.top = '0';
        overlayFix.style.left = '0';
        overlayFix.style.zIndex = '5';
        overlayFix.style.height = '100%';
        overlayFix.style.width = '100%';
        //overlayFix.style.backgroundColor = 'black';
        let body = document.querySelector('body');
        body.style.position = 'relative';
        body.append(overlayFix);
    }
}

export default Calendar;
