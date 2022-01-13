$(document).ready(function () {
    //get original  values
    var fname = $("#first_name").val();
    var mname = $("#middle_name").val();
    var lname = $("#last_name").val();
        
    //toggle forms

    $("#edit_info").change(function () {

        if (!$("#edit_info_div").hasClass("editing")) {
            if ($("#up_username_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_info_btn").toggleClass("d-none");
                if ($("#up_info_btn").hasClass("d-none")) {
                    $(".edit_info").attr("readonly", true);
                } else {
                    $(".edit_info").attr("readonly", false);
                    
                }
            } else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_info").prop("checked", false);
            }


        } else {
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
                        $("#first_name").val(fname);
                        $("#middle_name").val(mname);
                        $("#last_name").val(lname);
                        if ($("#up_username_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                            $("#up_info_btn").toggleClass("d-none");
                            if ($("#up_info_btn").hasClass("d-none")) {
                                $(".edit_info").attr("readonly", true);
                            } else {
                                $(".edit_info").attr("readonly", false);
                            }
                            $("#edit_info_div").removeClass("editing");
                        }

                        
                    }else{
                        $("#edit_info").prop("checked", true);
                    }
                  })
            }

        }
    });
    
    $("#edit_username").change(function () {
        if (!$("#edit_username_div").hasClass("editing")) {
            //check if there is ongoing update, 1 update at a time.
            if ($("#up_info_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_username_btn").toggleClass("d-none");
                if ($("#up_username_btn").hasClass("d-none")) {
                    $(".edit_username").attr("readonly", true);
                } else {
                    $(".edit_username").attr("readonly", false);
                }
            } else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_username").prop("checked", false);
            }
        } else {
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
                        $("#edit_username").prop("checked", false);
                        $('#username').val(username);
                        if ($("#up_info_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                            $("#up_username_btn").toggleClass("d-none");
                            if ($("#up_username_btn").hasClass("d-none")) {
                                $(".edit_username").attr("readonly", true);
                            } else {
                                $(".edit_username").attr("readonly", false);
                            }
                            $("#edit_username_div").removeClass("editing");
                        }
                        
                    }else{
                        $("#edit_username").prop("checked", true);
                    }
                  })
            }
        }

    });
    var uname_state = 'orig';
    orig_uname = $('#username').val();
    $('#username').on('input', function () {
        var uname = $('#username').val()
        if (uname == orig_uname) {
            uname_state = 'orig';
            console.log('this is your original username')
            console.log(uname_state)
        }else{
            $.ajax({
                type: "POST",
                url: "view_profile_update.php",
                data: {
                    'upd_uname_check': 1,
                    'uname': uname,
                },
                success: function (response) {
    
                    if (response == 0) {
                        uname_state = 'available'
                        console.log('username available')
                        console.log(uname_state)
                    }
                    else if (response == 1) {
                        uname_state = 'not available'
                        console.log('username already used')
                        console.log(uname_state)
                    }
                    else {
                        alert(response);
                        console.log(response)
                    }
    
                }
            });
        }  
    })

    $('#form_username').on('submit', function(e){
        e.preventDefault();
        var data = $('#form_username').serialize()
        console.log(data)
        if(uname_state === 'orig'){
            Swal.fire('Error','This is your original username','error')
        }else if(uname_state === 'not available'){
            Swal.fire('Error','This username is already used','error')
        }else if(uname_state === 'available'){
            Swal.fire({
                title: 'Confirmation',
                text: "Do you want to update your username?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "view_profile_update.php",
                        data: data,
                        success: function (response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Username updated successfully',
                                    icon: 'success',
                                }).then((result) => {
                                    // Reload the Page
                                    location.reload();
                                });
                        }
                    })
                }
            })
            return false;
        }

    })
    var current_pword_state = false;
    $('#password').on('blur', function () {
        var currentPword = $('#password').val()
        if (currentPword == '') {
            current_pword_state = true
            return
        }
        $.ajax({
            type: "POST",
            url: "view_profile_update.php",
            data: {
                'upd_password_check': 1,
                'currentUname': orig_uname,
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
                    alert(response);
                    console.log(response)
                }

            }
        });
    })

    $("#form_password").on("submit", function (e) {  
        e.preventDefault();
        var data = $('#form_password').serialize();
        if (current_pword_state == false) {
            Swal.fire('Error!', 'Current password is wrong.', 'error')
        } else if ($("#new_password").val() !== $("#confirm_password").val()) {
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
                        url: "./../profile/view_profile_update.php",
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
            //check if there is ongoing update, 1 update at a time.
            if ($("#up_info_btn").hasClass("d-none") && $("#up_username_btn").hasClass("d-none")) {
                $("#up_password_btn").toggleClass("d-none");
                if ($("#up_password_btn").hasClass("d-none")) {
                    $(".edit_password").attr("readonly", true);
                } else {
                    $(".edit_password").attr("readonly", false);
                }
            } else {
                Swal.fire('Error', 'You need to complete the ongoing update first.', 'error')
                $("#edit_password").prop("checked", false);
            }
        } else {
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
                        $('#password').val('')
                        $('#new_password').val('')
                        $('#confirm_password').val('')
                        if ($("#up_info_btn").hasClass("d-none") && $("#up_username_btn").hasClass("d-none")) {
                            $("#up_password_btn").toggleClass("d-none");
                            if ($("#up_password_btn").hasClass("d-none")) {
                                $(".edit_password").attr("readonly", true);
                            } else {
                                $(".edit_password").attr("readonly", false);
                            }
                            $("#edit_password_div").removeClass("editing")
                        }
                    }else{
                        $("#edit_password").prop("checked", true);
                    }
                  })
            }
            
           
        }
    });
    // if input begins add editing class
    $(".edit_info").on("input", function () {
        if (!$("#edit_info_div").hasClass("editing")) {
            $("#edit_info_div").addClass("editing");
        }
    });

    $(".edit_username").on("input", function () {
        if (!$("#edit_username_div").hasClass("editing")) {
            $("#edit_username_div").addClass("editing");
        }
    });

    $(".edit_password").on("input", function () {
        if (!$("#edit_password_div").hasClass("editing")) {
            $("#edit_password_div").addClass("editing");
        }
    });


});


