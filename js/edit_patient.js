$(document).ready(function () {
    $("input,label").dblclick(function () {
        $('input').prop('readonly', false);
        $(':submit').css("background-color", "rgb(91, 220, 125)");
        $(":submit").prop('disabled', false);
        $("#edit_stat").text("You are Editing!");
        $("#edit_stat").css('color', "rgb(91, 220, 125)");
        $("input[type=radio]").prop('disabled', false);
    });


    $(".bx.bxs-x-circle").click(function () {

        if ($(".record_management_edit_div").hasClass("active")) {
            Swal.fire(
                'Error!',
                'Adding is still ongoing.',
                'error'
            )
        }
        else {
            // window.location.href = "record_management.php";
        }
    });


    $("input").on("input", function () {
        $(".record_management_edit_div").addClass("active");
    });
});

