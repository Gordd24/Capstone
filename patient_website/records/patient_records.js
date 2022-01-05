$(document).ready(function () {

    $(".record_select").on('change', function () {

        var record = $(this).val();
        var id = $(this).attr("id");
        // if (page == "consultation") {

        // } else if (page == "admission") {

        // } else if (page == "medical") {

        // } else if (page == "laboratory") {

        // }

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