$(document).ready(function () {


    $(".bx.bxs-x-circle").click(function () {

        if ($(".add_patient_div").hasClass("active")) {
            alert("Jardon Sweet alert para confirm, kasi ongoing ung add");
        }
        else {
            window.location.href = "record_management.php";
        }

    });


    $("input").on("input", function () {
        $(".add_patient_div").addClass("active");
    });



});

