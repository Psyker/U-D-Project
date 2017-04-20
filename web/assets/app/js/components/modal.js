let modal = {
    init () {
        let modal = document.querySelector('#modal');
        let modalClose = document.querySelector('.modal__close');
        // let modalIconClose = document.querySelector('.fa-close');
        let lightbox = document.querySelector('.lightbox');

        let buttonModal = document.querySelector('.modal__open');

        buttonModal.addEventListener('click', (e) => {
            e.preventDefault();

            document.querySelector('body').classList.add('body--noScroll');
            modal.classList.add('modal--active');
            lightbox.classList.add('lightbox--active');

            this.closeModalKeyPress();
        });

        let elementsClose = [];
        elementsClose.push(modal, modalClose);

        for(let i = 0; i < elementsClose.length; i++) {
            elementsClose[i].addEventListener('click', (e) => {
                e.preventDefault();

                this.closeModal(modal, lightbox);
            });
        }
    },

    closeModal (modal, lightbox) {
        modal.classList.remove('modal--active');
        document.querySelector('body').classList.remove('body--noScroll');
        lightbox.classList.remove('lightbox--active');
    },

    closeModalKeyPress () {
        let self = this;
        if (document.querySelector('.modal--active').length) {
            document.addEventListener('keyup', (e) => {
                if (e.keyCode == 27) {
                    self.closeModal();
                }
            })
        }
    }
};

modal.init();
