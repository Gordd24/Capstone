$(document).ready(function () {

    const frmSignIn = document.getElementById('frmSignIn');
    const frmForget = document.getElementById('frmForget');

    const showPasswordTogglers = document.querySelectorAll('[data-action="toggle-show-password"]');
    const inputs = document.querySelectorAll('.asm-form__input');
    const linkButtons = document.querySelectorAll('[data-action="show-form"]');


    /* Functions */

    const toggleShowPassword = event => {
        const input = document.getElementById('signinPassword');
        const type = input.getAttribute('type');
        input.setAttribute('type', type === 'password' ? 'text' : 'password');
    }

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
    for (const toggler of showPasswordTogglers) {
        toggler.addEventListener('click', toggleShowPassword);
    }

    for (const input of inputs) {
        input.addEventListener('focusout', inputLabelFocusOut);
        input.addEventListener('focus', inputLabelFocus);
    }

    for (const button of linkButtons) {
        button.addEventListener('click', showForm);
    }
    radio = 'Patient';
    username_state = false;
    $('input[name="account"]').change(function () {
        username = $('#signinUsername').val();
        password = $('#signinPassword').val();
        if (this.value == 'Patient') {
            radio = this.value
            //console.log(radio)
            $.ajax({
                type: "POST",
                url: "loginProcess.php",
                data: {
                    'username_check': 1,
                    'username': username,
                    'radio': radio,
                },
                success: function (response) {
                    if (response == 0) {
                        //user does not exist
                        username_state = false;
                        console.log(response)
                    }
                    else if (response == 1) {
                        //user exist
                        username_state = true;
                        console.log(response)
                    }
                    else {
                        console.log(response);
                    }

                }
            })

        } else if (this.value == 'Personnel') {
            radio = this.value
            //console.log(radio)
            $.ajax({
                type: "POST",
                url: "loginProcess2.php",
                data: {
                    'username_check': 1,
                    'username': username,
                    'radio': radio,
                },
                success: function (response) {
                    if (response == 0) {
                        //user does not exist
                        username_state = false;
                        console.log(response)
                    }
                    else if (response == 1) {
                        //user exist
                        username_state = true;
                        console.log(response)
                    }
                    else {
                        console.log(response);
                    }

                }
            })
        }
    })

    $('#frmSignIn').on('submit', function (e) {
        e.preventDefault()
        radio = $('input[name="account"]:checked').val()
        console.log(radio)
        // username = $('#signinUsername').val();
        // password = $('#signinPassword').val();
        data = $('#frmSignIn').serialize();
        if (radio == 'Patient') {
            $.ajax({
                type: "POST",
                url: "loginProcess.php",
                data: data,
                success: function (response) {
                    if (response == '1') {
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then((result) => {
                            // Reload the Page
                            location.href = 'patient_website/profile/patient_profile.php'
                        });
                    } else {
                        console.log(response)
                        Swal.fire('Error', 'Username or password is incorrect', 'error')
                    }
                }
            });

        } else if (radio == 'Personnel') {

            $.ajax({
                type: "POST",
                url: "loginProcess2.php",
                data: data,
                success: function (response) {
                    if (response == '1') {
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then((result) => {
                            // Reload the Page
                            // Reload the Page
                            location.href = 'php/dashboard/dashboard.php'
                        });

                    } else {
                        console.log(response)
                        Swal.fire('Error', 'Username or password is incorrect', 'error')

                    }
                }
            });
        }
    })

})


