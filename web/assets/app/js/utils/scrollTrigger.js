let scrollTrigger = {
    init () {
        setTimeout(() => {
            document.querySelector('.section__landing').classList.add('active');
        }, 400);

        document.onscroll = () => {
            let windowY = window.scrollY;

            this.triggerClass('.containerBubbles', 400, windowY);
            this.triggerClass('.number', -100, windowY)
            this.triggerClass('.section__contact',200, windowY)
            this.triggerClass('.section__statistics',200, windowY)
        };
    },

    triggerClass (el, offset, ref) {
        let container = document.querySelector(el);
        let posContainer = container.offsetTop;
        let active = false;
        let condition = (ref > (posContainer - (offset)));

        if (condition && active == false) {
            container.classList.add('active');
            active = true;
        }
    }
}

scrollTrigger.init();
