let navSticky = {
    init () {
        let navSticky = document.querySelector('.navSticky');
        let posNavSticky = navSticky.offsetTop;
        let position = window.pageYOffset || document.documentElement.scrollTop;
        let windowWidth = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;
        let idSetTimeout;
        let active = false;

        window.onresize = () => {
            clearTimeout(idSetTimeout);
            idSetTimeout = setTimeout(() => {
                window.scrollTo(0, 0);

                posNavSticky = navSticky.offsetTop;
                position = window.pageYOffset || document.documentElement.scrollTop;
                windowWidth = window.innerWidth
                    || document.documentElement.clientWidth
                    || document.body.clientWidth;
            }, 500);
        };

        window.onscroll = () => {
            let scroll = window.pageYOffset || document.documentElement.scrollTop;

            if (windowWidth <= 768) {
                document.querySelector('.navSticky__Contact').classList.remove('btn__base');

                if ((scroll > position) && (scroll > 200)) {
                    navSticky.classList.add('navSticky--active');
                } else {
                    navSticky.classList.remove('navSticky--active');
                }

                position = scroll;
            } else {
                if (scroll > (posNavSticky)) {
                    navSticky.classList.add('navSticky--active');
                    document.querySelector('.navSticky__Contact').classList.add('btn__base');
                } else {
                    navSticky.classList.remove('navSticky--active');
                    document.querySelector('.navSticky__Contact').classList.remove('btn__base');
                }
            }
        };
    }
}

navSticky.init();
