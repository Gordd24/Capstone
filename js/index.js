



const frmSignIn = document.getElementById('frmSignIn');
const frmForget = document.getElementById('frmForget');


const inputs = document.querySelectorAll('.asm-form__input');
const linkButtons = document.querySelectorAll('[data-action="show-form"]');


/* Functions */




const inputLabelFocusOut = event => {
    label = document.querySelector(`label[for="${event.target.id}"]`);
    if (event.target.value.length > 0) {
        label.classList.add('active');
        label.parentNode.classList.remove('invalid');
    } else {
        label.classList.remove('active');
    }
}

const inputLabelFocus = event => {
    label = document.querySelector(`label[for="${event.target.id}"]`);
    label.classList.add('active');
    label.parentNode.classList.remove('invalid');
}



const showForm = event => {
    event.preventDefault();

    for (const form of document.querySelectorAll('.asm-form')) {
        form.classList.remove('active');
    }

    for (const error of document.querySelectorAll('.asm-form__inputbox.invalid')) {
        error.classList.remove('invalid');
    }

    document.querySelector(event.target.dataset.target).classList.add('active');
}

/* Listener assigns */

for (const input of inputs) {
    input.addEventListener('focusout', inputLabelFocusOut);
    input.addEventListener('focus', inputLabelFocus);
}


for (const button of linkButtons) {
    button.addEventListener('click', showForm);
}





