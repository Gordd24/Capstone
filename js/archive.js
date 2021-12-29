$(document).ready(function () {


    $('#search_patient').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_patient").keyup(function () {
        var txt = $(this).val();
        console.log(txt);
        //???? what 
        $('tbody').html('');
        $.ajax({
            url: "searched_archive_records.php",
            method: "post",
            data: { search: txt },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);
                // Restore record
                $(".btn.restore").click(function () {
                    location.href = "restore.php?id=" + $(this).attr('id');
                });

            }
        });
        //somehow return false stops keyup functioning twice
        return false;
    });


    // Restore record
    $(".btn.restore").click(function () {
        location.href = "restore.php?id=" + $(this).attr('id');
    });



});