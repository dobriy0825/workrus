import csrf from "./get_csrf";


export default async function (url, form) {
    let options = {
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': csrf
        }
    };
    let proxy = new Proxy(options, {
        get(target, body) {
            return target[body];
        },
        set(target, body, value) {
            target[body] = value;
            return true;
        }
    });
    if (typeof form == 'object') {
        proxy.body = new FormData(form);
    }else {
        let formData = new FormData();
        formData.append('id', form);
        proxy.body = formData;
    }
    let request = await fetch(url, options);

    let status = request.status;
    if (status !== 200){
        throw new Error('no');
    }
    return await request.text();

}



