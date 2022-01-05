$(document).ready(function () {

    $(".record_select").on('change', function () {

        var record = $(this).val();
        var id = $(this).attr("id");
        $.ajax({
            url: "fetch_records.php",
            method: "post",
            data: { patient: id, record: record },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);
            }
        });

    });



});