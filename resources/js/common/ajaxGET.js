async function ajaxGet(url) {
    let request = await fetch(url);
    if (request.status!= 200){
        throw new Error('no');
    }
    let response = await request.text();
    let result = JSON.parse(response);
    return result;
}
export default ajaxGet;
