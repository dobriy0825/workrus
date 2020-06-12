import csrf from "../common/get_csrf";

export default function(xhr, method, url, form){
    xhr.open(method, url);
    xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
    xhr.send(form);
}
