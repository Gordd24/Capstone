$(document).ready(function () {

    setInterval(function () {

        $.ajax({
            url: "../notification.php",
            method: "post",
            data: { data: "text" },
            dataType: "text",
            success: function (data) {
                $('#response').html(data);


            }
        });

    }, 4000


    );

});