function forBackBtnMobileMode(element, elementBtn){
    if (window.screen.width < 1024){
        let styles = getComputedStyle(element, elementBtn);
        if (styles.display == 'none') {
            elementBtn.classList.add('back_in_page');
        }else {
            elementBtn.classList.add('back_in_items');
        }
    }
}
export default forBackBtnMobileMode;
