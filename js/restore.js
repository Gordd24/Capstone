$(document).ready(function () {

    $("#patient_search").keyup(function () {

        var txt = $(this).val();
        //???? what 
        $('#table_archives').html(''),
            $.ajax({
                url: "searched_patients.php",
                method: "post",
                data: { restore: txt },
                dataType: "text",
                success: function (data) {
                    $('#table_archives').html(data);
                }
            });
        //somehow return false stops keyup functioning twice
        return false;
    });


});