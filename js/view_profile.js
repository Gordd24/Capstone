$(document).ready(function () {
    $(".profile_editable").dblclick(function () {
        $('.profile_editable').prop('readonly', false);
        $(':submit').css("background-color", "rgb(91, 220, 125)");
        $(":submit").prop('disabled', false);
        $("#edit_stat").text("You are Editing!");
        $("#edit_stat").css('color', "rgb(91, 220, 125)");
    });
});

