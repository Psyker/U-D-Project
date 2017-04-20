let smoothFadeIn = {
    setElementVisible(element) {
        element = document.querySelectorAll(element);
        element = Array.from(element);
        element.map(function () {
            this.className = 'js-elementFadeIn';
        })
    },

    init() {
        this.setElementVisible(element)
    }
};


// export default smoothFadeIn