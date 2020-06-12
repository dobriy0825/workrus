export default function (response, errors) {
    errors.innerHTML = response;
    errors.style.display = 'flex';
}
