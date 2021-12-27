$(document).ready(function () {
    $(".sidebar .burger_div #burger").click(function () {
        $(".sidebar").toggleClass("active");
        if ($(".sidebar").hasClass("active")) {
            $.fn.activeChange();
        }
        else {
            $.fn.inactiveChange();
        }

    });

    $.fn.activeChange = function () {
        console.log("working");
        $(".sidebar").animate({
            width: "20%"
        }),
            $(".title_bar").animate({
                width: "80%",
                left: "20%"
            }
            ),
            $(".sidebar ul li a span").show(),
            $(".sidebar .burger_div #burger").css(
                {
                    left: "85%",
                    margin: "0"
                }
            );
        $(".sidebar .title_logo").show(),
            $(".sidebar ul li a").css(
                {
                    'font-size': "1.3vw",
                    'border-radius': "17%/100%"
                }
            ),
            $(".sidebar ul li a i").css("margin", "0"),
            $(".sidebar ul li").css("margin", "0"),
            $(".page_content_div").animate(
                {
                    left: "21%",
                    width: "78%"
                }
            );

    }

    $.fn.inactiveChange = function () {
        $(".sidebar").animate({
            width: "5%"
        }),
            $(".title_bar").animate({
                width: "95%",
                left: "5%"
            }),
            $(".sidebar ul li a span").hide(),
            $(".sidebar .burger_div #burger").css(
                {
                    left: "0",
                    margin: "auto"
                }
            ),
            $(".sidebar .title_logo").hide(),
            $(".sidebar ul li a").css(
                {
                    'font-size': "2.7vw",
                    'border-radius': "40%/80%"
                }
            ),
            $(".sidebar ul li a i").css("margin", "auto"),
            $(".sidebar ul li").css("margin", "15% 0 15.5% 0"),
            $(".page_content_div").animate(
                {
                    left: "7.5%",
                    width: "90%"
                }
            );
    }
});

