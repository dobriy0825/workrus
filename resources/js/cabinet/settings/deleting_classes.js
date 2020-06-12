export default function(array, element) {
    array.forEach(function (item) {
        if (element.classList.contains(item)){
            element.classList.remove(item);
        }
    })
}
