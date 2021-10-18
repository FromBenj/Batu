// import Swiper JS
import Swiper from "./swiper-bundle.min";
    const swiper = new Swiper('.swiper', {
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
        },
        slidesPerView: 4,
        spaceBetween: 5,
        loop: true,
        breakpoints: {
            320: {
                slidesPerView: 2,
            },
            480: {
                slidesPerView: 3,
                spaceBetween: 30
            },
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

export {swiper}
