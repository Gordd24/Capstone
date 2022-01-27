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
                $(".btn.open_file").click(function () {


                    if ($(this).hasClass("medical")) {
                        var link = "open_file.php?type=medical&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("laboratory")) {
                        var link = "open_file.php?type=laboratory&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    }

                });
            }
        });

    });

    $(".btn.open_file").click(function () {

        if ($(this).hasClass("medical")) {
            var link = "open_file.php?type=medical&file_name=" + $(this).attr('id');
            window.open(link, '_blank');
        } else if ($(this).hasClass("laboratory")) {
            var link = "open_file.php?type=laboratory&file_name=" + $(this).attr('id');
            window.open(link, '_blank');
        }

    });



});