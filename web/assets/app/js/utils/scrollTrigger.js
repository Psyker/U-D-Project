let scrollTrigger = {
    init () {
        document.onscroll = () => {
            let windowY = window.scrollY;

            this.triggerClass('.containerBubbles', 200, windowY);
        };
    },

    triggerClass (el, offset, ref) {
        let container = document.querySelector(el);
        let posContainer = container.offsetTop;
        let active = false;
        let condition = (ref > (posContainer - offset));

        if (condition && active == false) {
            container.classList.add('active');
            active = true;
        }
    }
}

scrollTrigger.init();
