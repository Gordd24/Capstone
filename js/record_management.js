$(document).ready(function () {

  $('#patient_search').on('keypress', function (e) {
    return e.which !== 13;
  });

  $("#patient_search").keyup(function () {

    var txt = $(this).val();
    //???? what 
    $('#table_patient').html(''),
      $.ajax({
        url: "searched_patients.php",
        method: "post",
        data: { search: txt },
        dataType: "text",
        success: function (data) {
          $('#table_patient').html(data);
          $(".patient_table_div .bx.bxs-file-find").click(function () {
            $(".record_management_div_1").hide();
            $(".record_management_div_3").show();
            var patient_id = $(this).attr('id');
            $.fn.viewFunction(patient_id);

          });
        }
      });
    //somehow return false stops keyup functioning twice
    return false;
  });


  $("#add_patient_btn").click(function () {
    $(".record_management_div_1").hide(),
      $(".record_management_div_2").show();

  });

  $(".bx.bxs-x-circle").click(function () {
    $(".record_management_div_2").hide(),
      $(".record_management_div_1").show();

  });



  $(".patient_table_div .bx.bxs-file-find").click(function () {
    $(".record_management_div_1").hide();
    $(".record_management_div_3").show();
    var patient_id = $(this).attr('id');
    $.fn.viewFunction(patient_id);

  });


  $.fn.viewFunction = function (patient_id) {
    $('.record_management_div_3').html(''),
      $.ajax({
        url: "view_patient.php",
        method: "post",
        data: { view: patient_id },
        dataType: "text",
        success: function (data) {
          $('.record_management_div_3').html(data);
          $(".cancel_view_patient_btn_div .bx.bxs-x-circle").click(function () {
            $(".record_management_div_3").hide(),
              $(".record_management_div_1").show();

          });

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

        }
      });
  }




});
