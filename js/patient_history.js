$(document).ready(function () {

    $(".record_type").on('change', function () {
        var type = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            url: "select_history.php",
            method: "post",
            data: {
                type: type,
                id: id
            },
            dataType: "text",
            success: function (data) {
                $('.history_div').html(data);

            }
        });


    });


});