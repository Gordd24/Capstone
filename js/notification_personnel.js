$(document).ready(function () {


    setInterval(function () {

        $.ajax({
            url: "../../php/notification.php",
            method: "post",
            data: { data: "text" },
            dataType: "text",
            success: function (data) {
                $('#followup_link').html(data);


            }
        });


    }, 4000


    );

});