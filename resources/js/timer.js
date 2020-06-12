function f(time) {
    time--;
    let m = Math.floor(time / 60);
    if (m < 10){
        m = '0' + m;
    }
    let s = Math.floor(time % 60);
     if (s < 10){
         s = '0' + s;
     }
     return [m, s];
}

function showTimer(v) {
    document.querySelector('.verify_phone_popup .minute').innerHTML = v[0];
    document.querySelector('.verify_phone_popup .seconds').innerHTML = v[1];
}
export {f, showTimer}
