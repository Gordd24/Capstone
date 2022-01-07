$(document).ready(function () {

    $(".card").hover(

        function () {

            $(this).toggleClass("hover");
            $(this).children().toggleClass("hover");
        }

    );

    $(".card").click(function () {
        var id = $(this).attr('id');
        if (id == "patient") {
            location.href = "../patients/patients.php";
        } else if (id == "record") {
            location.href = "../patients_record_management/patients_records.php";
        } else if (id == "request") {
            location.href = "../patients_request/patients_request.php";
        }
    });





});