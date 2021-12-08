$(document).ready(function () {

    //toggle forms
    $("#edit_info").change(function () {
        if (!$("#edit_info_div").hasClass("editing")) {
            //check if there is ongoing update, 1 update at a time.
            if ($("#up_username_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_info_btn").toggleClass("d-none");
                if ($("#up_info_btn").hasClass("d-none")) {
                    $(".edit_info").attr("readonly", true);
                } else {
                    $(".edit_info").attr("readonly", false);
                }
            } else {
                alert("You need to complete the ongoing update first.");
                $("#edit_info").prop("checked", false);
            }
        } else {
            alert("You have unsave changes!");
            $("#edit_info").prop("checked", true);
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
                alert("You need to complete the ongoing update first.");
                $("#edit_username").prop("checked", false);
            }
        } else {
            alert("You have unsave changes!");
            $("#edit_username").prop("checked", true);
        }

    });

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
                alert("You need to complete the ongoing update first.");
                $("#edit_password").prop("checked", false);
            }
        } else {
            alert("You have unsave changes!");
            $("#edit_password").prop("checked", true);
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