/**
 * Created by Thib on 20/04/2017.
 */
let countingNumbers = {
    init () {
        let elements = document.querySelectorAll('.number');
        for (let i = 0; i < elements.length; i++) {
            if (elements[i])
                this.saveElement(elements[i]);
        }
    },

    count (number, element, index) {
        let counter = setInterval(function () {
            countingNumbers.renderToHtml(element, index);
            index += 1
            if (index > number) {
                clearInterval(counter)
                return false;
            }
        }, 10);

    },
    saveElement (element) {
        let cachedData = element.innerHTML;
        let index = 0;
        console.log(cachedData)
        element.innerHTML = 0;

        this.count(cachedData, element, index)

    },

    renderToHtml (element, value) {
        element.innerHTML = value
    }
};

let checkScroll = setInterval(function () {
    if (document.querySelector('.number').classList.contains('active')) {
        countingNumbers.init();
        clearInterval(checkScroll)
    }
}, 100/60*100);