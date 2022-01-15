$(document).ready(function () {
    //name
    fname = $("#first_name").val();
    mname = $("#middle_name").val();
    lname = $("#last_name").val();
    //other info
    bday = $("#birthday").val();
    sex = $('input[name="sex"]:checked').val();
    address = $('#address').val();
    //optional
    contact =$('#contact_no').val();
    religion = $('#religion').val();
    occupation = $('#occupation').val();
    //email 
    email = $('#email').val();


    $("#edit_name").change(function () {
        if (!$("#edit_name_div").hasClass("editing")) {
            if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_optional_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_name_btn").toggleClass("d-none");
                if ($("#up_name_btn").hasClass("d-none")) {
                    $(".edit_name").attr("readonly", true);
                } else {
                    $(".edit_name").attr("readonly", false);
                }
            }
            else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_name").prop("checked", false);
            }
        }else{
            if(!$(this).is(':checked')){
                Swal.fire({
                    title: 'Warning',
                    text: "You have unsave changes. Do you want to continue?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#edit_name").prop("checked", false);
                        $("#first_name").val(fname);
                        $("#middle_name").val(mname);
                        $("#last_name").val(lname);   
                        
                        if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_optional_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                            $("#up_name_btn").toggleClass("d-none");
                            if ($("#up_name_btn").hasClass("d-none")) {
                                $(".edit_name").attr("readonly", true);
                            } else {
                                $(".edit_name").attr("readonly", false);
                            }
                            $("#edit_name_div").removeClass("editing")
                        }
                    }else{
                        $("#edit_name").prop("checked", true);
                    }
                  })
            }
        }
    });

    $("#edit_optional").change(function () {

        if (!$("#edit_optional_div").hasClass("editing")) {
            if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_optional_btn").toggleClass("d-none");
                if ($("#up_optional_btn").hasClass("d-none")) {
                    $(".edit_optional").attr("readonly", true);
                } else {
                    $(".edit_optional").attr("readonly", false);
                }

            }
            else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_optional").prop("checked", false);
            }
        }else{
            if(!$(this).is(':checked')){
                Swal.fire({
                    title: 'Warning',
                    text: "You have unsave changes. Do you want to continue?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#edit_opitonal").prop("checked", false);
                        $('#contact_no').val(contact);
                        $('#religion').val(religion);
                        $('#occupation').val(occupation);

                        if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                            $("#up_optional_btn").toggleClass("d-none");
                            if ($("#up_optional_btn").hasClass("d-none")) {
                                $(".edit_optional").attr("readonly", true);
                            } else {
                                $(".edit_optional").attr("readonly", false);
                            }
                            $("#edit_optional_div").removeClass("editing")
                        }
                        
                    }else{
                        $("#edit_optional").prop("checked", true);
                    }
                  })
            }
        }
    });

    $("#edit_email").change(function () {
        if (!$("#edit_email_div").hasClass("editing")) {
            if ($("#up_optional_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_email_btn").toggleClass("d-none");
                if ($("#up_email_btn").hasClass("d-none")) {
                    $(".edit_email").attr("readonly", true);
                } else {
                    $(".edit_email").attr("readonly", false);
                }

            }
            else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_email").prop("checked", false);
            }
        }else{
            if(!$(this).is(':checked')){
                Swal.fire({
                    title: 'Warning',
                    text: "You have unsave changes. Do you want to continue?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#edit_email").prop("checked", false);
                        $("#email").val(email);

                        if ($("#up_optional_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                            $("#up_email_btn").toggleClass("d-none");
                            if ($("#up_email_btn").hasClass("d-none")) {
                                $(".edit_email").attr("readonly", true);
                            } else {
                                $(".edit_email").attr("readonly", false);
                            }
                            $("#edit_email_div").removeClass("editing")
                        }
                       
                    }else{
                        $("#edit_email").prop("checked", true);
                    }
                  })
            }
        }
    });

    $("#edit_info").change(function () {
        if (!$("#edit_info_div").hasClass("editing")) {
            if ($("#up_optional_btn").hasClass("d-none") && $("#up_email_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_info_btn").toggleClass("d-none");
                if ($("#up_info_btn").hasClass("d-none")) {
                    $(".edit_info").attr("readonly", true);
                    $(".edit_info.edit_sex").attr("disabled", true);
                } else {
                    $(".edit_info").attr("readonly", false);
                    $(".edit_info.edit_sex").attr("disabled", false);
                }

            }
            else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_info").prop("checked", false);
            }
        }else{
            if(!$(this).is(':checked')){
                Swal.fire({
                    title: 'Warning',
                    text: "You have unsave changes. Do you want to continue?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#edit_info").prop("checked", false);
                        $("#birthday").val(bday);
                        $('input[name="sex"]:checked').val(sex);
                        $("#address").val(address); 
                        if ($("#up_optional_btn").hasClass("d-none") && $("#up_email_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                            $("#up_info_btn").toggleClass("d-none");
                            if ($("#up_info_btn").hasClass("d-none")) {
                                $(".edit_info").attr("readonly", true);
                                $(".edit_info.edit_sex").attr("disabled", true);
                            } else {
                                $(".edit_info").attr("readonly", false);
                                $(".edit_info.edit_sex").attr("disabled", false);
                            }
                            $("#edit_info_div").removeClass("editing")
                        }
                    }else{
                        $("#edit_info").prop("checked", true);
                    }
                  })
            }
        }

    });
    
    var username  = $('#patient_uname').val();
    console.log(username)
    var current_pword_state = false;
    $('#password').on('blur', function () {
        
        
        var currentPword = $('#password').val()
        if (currentPword == '') {
            current_pword_state = true
            return
        }
        $.ajax({
            type: "POST",
            url: "update_patient.php",
            data: {
                'password_check': 1,
                'username': username,
                'currentPword': currentPword
            },
            success: function (response) {

                if (response == 0) {
                    current_pword_state = false
                    console.log('password wrong')
                }
                else if (response == 1) {
                    current_pword_state = true
                    console.log('password correct')
                }
                else {
                    // alert(response);
                    console.log(response)
                }

            }
        });
    })

    $("#form_password").on("submit", function (e) {  
        e.preventDefault();
        var data = $('#form_password').serialize();
        if (current_pword_state == false) {
            $('#password_error').html('Current password is wrong')
            $('#new_password_error').html('')
            $('#confirm_password_error').html('')
        }
        else if($('#new_password').val().length <= 8){
            $('#password_error').html('')
            $('#new_password_error').html('Password must atleast have 8 characters')
            $('#confirm_password_error').html('')
        } 
        else if ($("#new_password").val() !== $("#confirm_password").val()) {
            $('#password_error').html('')
            $('#new_password_error').html('Password did not match')
            $('#confirm_password_error').html('Password did not match')
            Swal.fire('Error!', 'Password did not match.', 'error')
        } else {
            Swal.fire({
                title: 'Confirmation',
                text: "Do you want to update your password?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "update_patient.php",
                        data: data,
                        success: function (response) {
                            console.log("res" + response)
                            if (response == '1') {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Password updated successfully',
                                    icon: 'success',
                                }).then((result) => {
                                    // Reload the Page
                                    location.reload();
                                });
                            }
                            else {
                                alert(response);
                                console.log(response)
                            }
                        }
                    })
                }
            })
            return false;
        }
    })


    $("#edit_password").change(function () {
        if (!$("#edit_password_div").hasClass("editing")) {
            if ($("#up_optional_btn").hasClass("d-none") && $("#up_email_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
                $("#up_password_btn").toggleClass("d-none");
                if ($("#up_password_btn").hasClass("d-none")) {
                    $(".edit_password").attr("readonly", true);
                } else {
                    $(".edit_password").attr("readonly", false);
                }
            }
            else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_password").prop("checked", false);
            }
        }else{
            if(!$(this).is(':checked')){
                Swal.fire({
                    title: 'Warning',
                    text: "You have unsave changes. Do you want to continue?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#edit_password").prop("checked", false);
                        $("#password").val('');
                        $('#new_password').val('');
                        $("#confirm_password").val(''); 
                        if ($("#up_optional_btn").hasClass("d-none") && $("#up_email_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
                            $("#up_password_btn").toggleClass("d-none");
                            if ($("#up_password_btn").hasClass("d-none")) {
                                $(".edit_password").attr("readonly", true);
                            } else {
                                $(".edit_password").attr("readonly", false);
                            }
                            $("#edit_password_div").removeClass("editing")
                            $('#password_error').html('')
                            $('#new_password_error').html('')
                            $('#confirm_password_error').html('')
                        }
                    }else{
                        $("#edit_password").prop("checked", true);
                    }
                  })
            }
        }
    });

    $(".edit_name").on("input", function () {
        if (!$("#edit_name_div").hasClass("editing")) {
            $("#edit_name_div").addClass("editing");
        }
    });

    $(".edit_password").on("input", function () {
        if (!$("#edit_password_div").hasClass("editing")) {
            $("#edit_password_div").addClass("editing");
        }
    });

    $(".edit_info").on("input", function () {
        if (!$("#edit_info_div").hasClass("editing")) {
            $("#edit_info_div").addClass("editing");
        }
    });

    $(".edit_optional").on("input", function () {
        if (!$("#edit_optional_div").hasClass("editing")) {
            $("#edit_optional_div").addClass("editing");
        }
    });
    $(".edit_email").on("input", function () {
        if (!$("#edit_email_div").hasClass("editing")) {
            $("#edit_email_div").addClass("editing");
        }
    });


});