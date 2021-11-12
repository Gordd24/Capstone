$(document).ready(function () {
    $("input").dblclick(function () {
        $('input').prop('readonly', false);
        $(':submit').css("background-color", "rgb(91, 220, 125)");
        $(":submit").prop('disabled', false);
    });
});

