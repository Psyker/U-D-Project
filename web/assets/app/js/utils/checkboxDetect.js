var formGroup = document.querySelector('.form-group');
var checkbox = document.querySelector('#checkbox__call');

checkbox.addEventListener('click', () => {
    if (checkbox.checked) {
        formGroup.classList.add('active');
        formGroup.classList.remove('close');
    } else {
        formGroup.classList.add('close');
        formGroup.classList.remove('active');
    }
})
