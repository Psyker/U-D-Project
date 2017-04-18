let smoothFadeIn = {
    setElementVisible(element) {
        element = document.querySelectorAll(element);
        element.map(function () {
            this.className = 'js-elementFadeIn';
        })
    },

    init() {
        this.setElementVisible(element)
    }
}

alert('plop');

smoothFadeIn.init();

// export default smoothFadeIn