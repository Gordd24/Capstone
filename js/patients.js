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

    //consultation personal group
    $("#patient1_next_btn").click(function () {
        fname = $('#first_name').val()
        mname = $('#middle_name').val()
        lname = $('#last_name').val()
        email = $('#email').val()
        if (fname != '' && lname != '' && email != '') {
            if (isEmail(email) == true) {
                $("#patient1_group").removeClass("active_group");
                $("#patient2_group").addClass("active_group");
                $(".progress-bar").css('width', '66%');
            } else {
                Swal.fire('Error!', 'Please enter a valid email', 'error')
            }
        } else {
            Swal.fire('Error!', 'Please fill up all the required fields.', 'error')
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
        }
        else {
            Swal.fire('Error!', 'Please fill up all the required fields.', 'error')
        }
    });

    $("#patient2_prev_btn").click(function () {
        $("#patient2_group").removeClass("active_group");
        $("#patient1_group").addClass("active_group");
        $(".progress-bar").css('width', '33%');
    });


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


});