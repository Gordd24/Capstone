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

    $("#edit_name").change(function () {

        if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_optional_btn").hasClass("d-none")) {
            $("#up_name_btn").toggleClass("d-none");
            if ($("#up_name_btn").hasClass("d-none")) {
                $(".edit_name").attr("readonly", true);
            } else {
                $(".edit_name").attr("readonly", false);
            }

        }
        else {
            alert("editing");
            $("#edit_name").prop("checked", false);
        }

    });

    $("#edit_optional").change(function () {

        if ($("#up_email_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
            $("#up_optional_btn").toggleClass("d-none");
            if ($("#up_optional_btn").hasClass("d-none")) {
                $(".edit_optional").attr("readonly", true);
            } else {
                $(".edit_optional").attr("readonly", false);
            }

        }
        else {
            alert("editing");
            $("#edit_optional").prop("checked", false);
        }

    });

    $("#edit_email").change(function () {

        if ($("#up_optional_btn").hasClass("d-none") && $("#up_info_btn").hasClass("d-none") && $("#up_name_btn").hasClass("d-none")) {
            $("#up_email_btn").toggleClass("d-none");
            if ($("#up_email_btn").hasClass("d-none")) {
                $(".edit_email").attr("readonly", true);
            } else {
                $(".edit_email").attr("readonly", false);
            }

        }
        else {
            alert("editing");
            $("#edit_email").prop("checked", false);
        }

    });

    $("#edit_info").change(function () {

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
            alert("editing");
            $("#edit_info").prop("checked", false);
        }

    });


    //discharge_patient btn

    $(".btn.discharge_patient").click(function () {
        var id = $(this).attr('id');
        location.href = "../patients_record_management/discharge.php?id=" + id;
    });

});