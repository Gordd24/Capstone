$(document).ready(function () {
    $('#search_patient').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_patient").keyup(function () {
        var txt = $(this).val();
        $('tbody').html('');
        $.ajax({
            url: "searched_patient.php",
            method: "post",
            data: { search: txt },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);

                //view_patient btn
                $(".btn.view_patient").click(function () {
                    var id = $(this).attr('id');
                    location.href = "view_patient.php?id=" + id;
                });

                //discharge_patient btn
                $(".btn.discharge_patient").click(function () {
                    var id = $(this).attr('id');
                    location.href = "../patients_record_management/discharge.php?id=" + id;
                });
            }
        });
        //somehow return false stops keyup functioning twice
        return false;
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    email_state = false;
   $('#email').on('input', function () {
    email = $('#email').val()
   
    $.ajax({
         type: "POST",
         url: "add_patient_validation.php",
         data: {
              'email_check': 1,
              'email': email,
         },
         success: function (response) {
              if (response == 0) {
                   email_state = false;
                   console.log(response)
              }
              else if (response == 1) {
                   email_state = true;
                   console.log(response)
              }
              else {
                   alert(response);
                   console.log(response)
              }
         }
    });
});

    //consultation personal group
    $("#patient1_next_btn").click(function () {
        fname = $('#first_name').val()
        mname = $('#middle_name').val()
        lname = $('#last_name').val()
        email = $('#email').val()
        if (fname != '' && lname != '' && email != '') {
            if (isEmail(email) == true) {
                if(email_state){
                    $("#patient1_group").removeClass("active_group");
                    $("#patient2_group").addClass("active_group");
                    $(".progress-bar").css('width', '66%');
                    $('#fname_error').html('')
                    $('#lname_error').html('')
                    $('#email_error').html('')
                }else{
                    Swal.fire('Error!', 'This email is already registered', 'error')
                    $('#email_error').html('This email is already registered')
                }
                
                
            } else {
                Swal.fire('Error!', 'Please enter a valid email', 'error')
                $('#email_error').html('Please enter a valid email')
            }
        } else {
            if(fname == '')$('#fname_error').html('Please enter first name')
            if(lname == '')$('#lname_error').html('Please enter last name')
            if(email == '')$('#email_error').html('Please enter email')
        }
    });


    //vital group    
    $("#patient2_next_btn").click(function () {
        bday = $('#birthdate').val()
        address = $('#address').val()
        if (Date.parse(bday) && address != '') {
            $("#patient2_group").removeClass("active_group");
            $("#patient3_group").addClass("active_group");
            $(".progress-bar").css('width', '100%');
            $('#date_error').html('')
            $('#address_error').html('')
        }
        else {
            if(bday == '')$('#date_error').html('Please enter birthday')
            if(address == '')$('#address_error').html('Please enter address')
        }
    });

    $("#patient2_prev_btn").click(function () {
        $("#patient2_group").removeClass("active_group");
        $("#patient1_group").addClass("active_group");
        $(".progress-bar").css('width', '33%');
    });

    $("#patient_form").on("submit",function (e) { 
        var data = $('#patient_form').serialize();
        e.preventDefault()
        $.ajax({
            type: 'POST',
            url: 'add_patient_validation.php',
            data: data,
            success: function (response){        
                Swal.fire({
                   title: 'Success',
                   text:'Patient Added Successfully',
                   icon: 'success',
                  }).then((result) => {
                    // Reload the Page
                    location.reload();
                  });
            }
        })
        return false;
    })
    // account group
    $("#patient3_prev_btn").click(function () {
        $("#patient3_group").removeClass("active_group");
        $("#patient2_group").addClass("active_group");
        $(".progress-bar").css('width', '66%');
    });





    //view_patient btn

    $(".btn.view_patient").click(function () {
        var id = $(this).attr('id');
        location.href = "view_patient.php?id=" + id;
    });




    // VIew Patient

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
            if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_optional_btn").hasClass("d-none")) {
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
                    
                    if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_optional_btn").hasClass("d-none")) {
                        $("#up_name_btn").toggleClass("d-none");
                        if ($("#up_name_btn").hasClass("d-none")) {
                            $(".edit_name").attr("readonly", true);
                        } else {
                            $(".edit_name").attr("readonly", false);
                        }
                        $('#edit_name_div').removeClass('editing');
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
        if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
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

                    if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
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
        if ($("#up_optional_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
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

                    if ($("#up_optional_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
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
        if ($("#up_optional_btn").hasClass("d-none") && $("#up_email_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
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
                    if ($("#up_optional_btn").hasClass("d-none") && $("#up_email_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
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

    $(".edit_name").on("input", function () {
        if (!$("#edit_name_div").hasClass("editing")) {
            $("#edit_name_div").addClass("editing");
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

    //discharge_patient btn

    $(".btn.discharge_patient").click(function () {
        var id = $(this).attr('id');
        location.href = "../patients_record_management/discharge.php?id=" + id;
    });

});