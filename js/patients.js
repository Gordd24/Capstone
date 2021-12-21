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



    //consultation personal group
    $("#patient1_next_btn").click(function () {
        $("#patient1_group").removeClass("active_group");
        $("#patient2_group").addClass("active_group");
        $(".progress-bar").css('width', '66%');
    });


    //vital group    
    $("#patient2_next_btn").click(function () {
        $("#patient2_group").removeClass("active_group");
        $("#patient3_group").addClass("active_group");
        $(".progress-bar").css('width', '100%');
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







});