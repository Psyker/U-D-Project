/**
 * Created by Thib on 18/04/2017.
 */
import jump from 'jump.js'

let smoothScroll = {
    init () {
        let linksTab = document.querySelectorAll('.navSticky__tabLink');

        for (let i = 0; i < linksTab.length; i++) {
            linksTab[i].addEventListener('click', function () {
                jump(linksTab[i].getAttribute('href'))
            })
        }

    }
};

smoothScroll.init();
export default smoothScroll;
