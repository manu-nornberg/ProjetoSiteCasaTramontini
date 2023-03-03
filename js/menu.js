function menuShow() {
    let menuMobile = document.querySelector('.menu-mobile');
    if (menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.menu').src = "../image/menu_FILL0_wght400_GRAD0_opsz48.png";
    } else {
        menuMobile.classList.add('open');
        document.querySelector('.menu').src = "../image/menu_FILL0_wght400_GRAD0_opsz48.png";
    }
}