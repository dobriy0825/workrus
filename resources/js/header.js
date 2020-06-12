export default function() {
    let width = window.screen.width;
    let url = 'http://localhost:3000/';
    if (width < 1028){
        document.querySelector('.header-for-desktop').remove();
        if (window.location.href != url){
            document.querySelector('.header-for-main-mobile').remove();
        }
    }
}
