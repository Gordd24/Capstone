$(document).ready(function () {
    $('#search_patient').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_patient").keyup(function () {
        var txt = $(this).val();
        //???? what 
        $('tbody').html('');
        $.ajax({
            url: "searched_patients_records.php",
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

});