/**
 * Created by Thib on 18/04/2017.
 */
let smoothScroll = {
    setLinkScroll (element, offset) {
        window.scrollTo(0, element.offsetTop + offset)
    },
    init () {
        let linksTab = document.querySelectorAll('.js-scrollAnchor')
        for (let i = 0 ; i <= linksTab.length; i++) {
            linksTab[i].addEventListener('click', function (event) {
                event.preventDefault();
                setLinkScroll(linksTab[i], 0)
            })
        }
    }
};

export default smoothScroll;
