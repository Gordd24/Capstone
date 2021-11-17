$(document).ready(function () {

    $("#admition_btn").click(function () {
        $(this).css(
            {
                "background-color": "rgb(52, 79, 95)",
                color: "white"
            }
        );
        $("#consultation_btn,#med_cert_btn,#lab_res_btn").css(
            {
                "background-color": "transparent",
                color: "black"
            }
        );

        $(".consultation_div,.med_cert_div,.lab_res_div").hide();

        $(".admition_div").show();

    });

    $("#consultation_btn").click(function () {
        $(this).css(
            {
                "background-color": "rgb(52, 79, 95)",
                color: "white"
            }
        );
        $("#admition_btn,#med_cert_btn,#lab_res_btn").css(
            {
                "background-color": "transparent",
                color: "black"
            }
        );

        $(".admition_div,.med_cert_div,.lab_res_div").hide();

        $(".consultation_div").show();

    });

    $("#med_cert_btn").click(function () {
        $(this).css(
            {
                "background-color": "rgb(52, 79, 95)",
                color: "white"
            }
        );
        $("#admition_btn,#consultation_btn,#lab_res_btn").css(
            {
                "background-color": "transparent",
                color: "black"
            }
        );

        $(".admition_div,.consultation_div,.lab_res_div").hide();

        $(".med_cert_div").show();

    });

    $("#lab_res_btn").click(function () {
        $(this).css(
            {
                "background-color": "rgb(52, 79, 95)",
                color: "white"
            }
        );
        $("#admition_btn,#consultation_btn,#med_cert_btn").css(
            {
                "background-color": "transparent",
                color: "black"
            }
        );

        $(".admition_div,.consultation_div,.med_cert_div").hide();

        $(".lab_res_div").show();


    });


});


