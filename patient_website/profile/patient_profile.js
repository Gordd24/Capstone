$(document).ready(function () {

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