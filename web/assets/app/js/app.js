//Utils
import './utils/scrollTrigger'
import './components/nav'

import './animation/countingNumbers'

//Animation
// import './animation/smoothFadeIn.js'

//Components
// import './components/graphic'

// smoothFadeIn.init('#status');


var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    direction: 'vertical',
    loop: true,
    slidesPerView: 1,
    autoHeight: true,
    centeredSlides: true,
    fade: {
        crossFade: true
    },
    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',

})
