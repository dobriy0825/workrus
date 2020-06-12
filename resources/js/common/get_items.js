import ajaxPost from "./ajaxPOST";

async function getItems(id, url){
    let result = await ajaxPost(url, id);
    return JSON.parse(result);
}
export default getItems;
