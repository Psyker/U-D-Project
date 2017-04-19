let scrollTrigger = {
    init () {
        window.onscroll = () => {
            let windowY = window.scrollY;

            this.triggerClass('.containerBubbles', 200, windowY);

        };
    },

    triggerClass (el, offset, ref) {
        let container = document.querySelector(el);
        let posContainer = container.offsetTop;

        if (ref > (posContainer - offset)) {
            container.classList.add('active')
        }
    }
}

scrollTrigger.init();
