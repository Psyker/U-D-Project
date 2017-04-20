/**
 * Created by Thib on 18/04/2017.
 */
import jump from 'jump.js'

let smoothScroll = {
    init () {
        let linksTab = document.querySelectorAll('.js-scrollAnchor')
        for (let i = 0; i <= linksTab.length; i++) {
            jump(linksTab[i], {
                duration: 1000,
                offset: 0,
                callback: undefined,
                easing: easeInOutQuad,
                a11y: false
            })
        }
    }
};

smoothScroll.init();
console.log('yolooooooo')
export default smoothScroll;
