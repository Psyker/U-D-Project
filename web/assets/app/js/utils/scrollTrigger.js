/**
 * Created by Thib on 18/04/2017.
 */
let scrollTrigger = {

    getScrollStatus (element, animation) {
        let scrollBody = window.pageYOffset;
        let elementOffset = element.getBoundingClientRect();
        console.log(elementOffset.top);

        this.trigger(scrollBody, elementOffset, window.innerHeight / 2)
    },

    trigger (elementParent, elementChild, offset) {
        elementParent <= elementChild - offset ? true : false;
    }
}

export default scrollTrigger