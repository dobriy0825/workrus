import ajaxRequest from "./ajax_request";
export default function()
{
    document.querySelector('.btn_send').addEventListener('click', function (e) {
        e.preventDefault();
        let fff = new FormData(document.forms.ccc);
        let obj = new XMLHttpRequest();
        // obj.open('post', '/register/c');
        // obj.setRequestHeader('X-CSRF-TOKEN', csrf);
        // obj.send(fff);
        obj.onreadystatechange = function () {
            if (obj.readyState == 4){
                document.querySelector('.captcha').style.display = 'none';
                document.querySelector('.wrap_popup').style.display = 'flex';
                let time = parseInt(obj.response);
                function f(){
                    time--;
                    let m = Math.floor(time/60);
                    if(m < 10){
                        m = '0' + m;
                    }
                    let s = time%60;
                    if(s < 10){
                        s = '0' +  s;
                    }
                    if ((m == 0 && s == 0) || document.querySelector('.wrap_popup').style.display === 'none'){
                        setTimeout(clearInterval(z));
                        document.querySelector('.btn_send_code').removeAttribute('disabled');
                        document.querySelector('.btn_send_code').style.color = '#006363';
                    }
                    document.querySelector('.minute').innerHTML = m;
                    document.querySelector('.seconds').innerHTML = s;
                }
                let z =setInterval(f,1000);
            }
        }
    });
}

