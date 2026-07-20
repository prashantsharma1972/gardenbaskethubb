import './aboutUs.scss';
import './../../src-utilities/header';
import './../../src-utilities/footer';
import './../../src-utilities/country';
import Swiper from './../../../node_modules/swiper';
import { Autoplay, Navigation } from 'swiper/modules';
import './../../src-utilities/vanilla-tilt';
import { initZohoForm } from '../../src-utilities/formSubmission';

// other opportunities slider
const historySlider = new Swiper('.job-card-slider', {
    modules: [Autoplay, Navigation],
    slidesPerView: 3,
    loop: true,
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.other-opportunities .swiper-button-next',
        prevEl: '.other-opportunities .swiper-button-prev',
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        1000: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
    },
});

const sliderElement = document.querySelector('.job-card-slider');

sliderElement.addEventListener('mouseenter', () => {
    historySlider.autoplay.stop();
});

sliderElement.addEventListener('mouseleave', () => {
    historySlider.autoplay.start();
});


// Newsletter CTA Subscribe Form

document.addEventListener('DOMContentLoaded', function () {
    initZohoForm('#cta-subscribe-form', 'gardenbaskethubb-Website-Newsletter', 'success');
});

// Newsletter CTA Subscribe Form