import ajaxRequest from "./ajax_request";
function showVerifyCode() {
    document.querySelector('.wrap_popup').style.display = 'flex';
}


// let time = parseInt(xhr.response);
// console.log(xhr.response);
// return time;


let minutesFormat;
let secondsFormat;
function timer(time){
    time--;
    console.log(time);
    let minutes = Math.floor(time / 60);
    if (minutes < 10) {
        minutesFormat = '0' + minutes;
    }
    let seconds = time % 60;
    if (seconds < 10) {
        secondsFormat = '0' + seconds;
    }
}

function printTimer(minutesFormat, secondsFormat) {
    document.querySelector('.minute').innerHTML = minutesFormat;
    document.querySelector('.seconds').innerHTML = secondsFormat;
}

function btnLock(minutes, seconds) {
    if ((minutes === 0 && seconds === 0) || document.querySelector('.wrap_popup').style.display === 'none') {

        document.querySelector('.btn_send_code').removeAttribute('disabled');
        document.querySelector('.btn_send_code').style.color = '#006363';
    }
}

let f1 = function(e) {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    let form  = new FormData(document.forms.captcha);
    ajaxRequest(xhr,'post', '/register/request', form);
    xhr.onreadystatechange = function(){
        if (xhr.readyState === 4){
            console.log(xhr.response);
            setInterval(function () {
                let time = xhr.response;
                timer(time)
                console.log(time);
            }, 1000);
        }


        btnLock();
        showVerifyCode();
        printTimer(minutesFormat, secondsFormat);

        console.log(minutesFormat,secondsFormat);
    }

    //setTimeout(clearInterval(z));

}

export default function f(){
    document.querySelector('.btn_send').addEventListener('click', f1);
}

