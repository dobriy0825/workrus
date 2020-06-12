export default function(time, elem1, elem2){
    this.time = time;
    this.elem1 = elem1;
    this.elem2 = elem2;
    this.interval;
    this.minutes;
    this.seconds;

    this.activateResendCode = function () {
        let resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
        resendCodeBtn.removeAttribute('disabled');
        resendCodeBtn.style.color = '#006363';
    };

    this.disabledResendCode = function () {
        let resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
        resendCodeBtn.setAttribute('disabled', 0);
        resendCodeBtn.style.color = '#b0afaf';
    };

    this.tick = function () {
        this.time--;
        this.formatTime();
        this.render();

        if (this.time <= 0){
            this.stop();
            this.activateResendCode();
        }else {
            this.disabledResendCode();
        }
    };
    // this.a = function (elem, str) {
    //     elem = Math.floor(this.time   60);
    //     if (elem < 10){
    //         elem = '0' + elem;
    //     }
    // }
    this.formatTime = function () {
        this.minutes = Math.floor(this.time / 60);
        if (this.minutes < 10){
            this.minutes = '0' + this.minutes;
        }

        this.seconds = Math.floor(this.time % 60);
        if (this.seconds < 10){
            this.seconds = '0' + this.seconds;
        }
    };

    this.render = function () {
        if (document.querySelector('.verify_phone_popup').style.display === 'none'){
            this.stop();
        }
        this.elem1.innerHTML = this.minutes;
        this.elem2.innerHTML = this.seconds;
    };

    this.start = function() {
        this.interval = setInterval(this.tick.bind(this), 1000);
    };


    this.stop = function () {
        clearInterval(this.interval);
        this.time = 0;
        this.elem1.innerHTML = '00';
        this.elem2.innerHTML = '00';
    };
}
