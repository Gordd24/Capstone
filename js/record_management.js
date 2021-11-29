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

          $(".patient_table_div .bx.bxs-file-plus").click(function () {
            $('.option_modal_div').show();
            $('.option_modal_div').focus();
            $('.option_modal_div').attr('id', this.id);
          });

          $('.patient_table_div .bx.bxs-user-minus').click(function () {
            var patient_id = $(this).attr('id');
            $('.record_management_div_1').hide();
            $('.record_management_div_4').show();
            $('.record_management_div_4').html('');

            $.ajax({
              url: "discharged_form.php",
              method: "post",
              data: { patient: patient_id },
              dataType: "text",
              success: function (data) {
                $('.record_management_div_4').html(data);
                $(".cancel_form_btn_div .bx.bxs-x-circle").click(function () {
                  $(".record_management_div_4").hide(),
                    $(".record_management_div_1").show();

                });
              }
            });
          });

        }
      });
    //somehow return false stops keyup functioning twice
    return false;
  });


  $(".bx.bxs-x-circle").click(function () {
    $(".record_management_div_2").hide(),
      $(".record_management_div_1").show();
  });

  $(".bx.bxs-file-plus").click(function () {
    $('.option_modal_div').show();
    $('.option_modal_div').focus();
    $('.option_modal_div').attr('id', this.id);
  });

  $('.option_modal_div').focusout(function () {
    $(this).hide();
    $('.option_modal_div').attr('id', "");
  });

  $('.option_modal_exit_div').click(function () {
    $('.option_modal_div').hide();
    $('.option_modal_div').attr('id', "");
  });

  $('.modal_options_div .option_buttons').click(function () {
    console.log($(this).attr('id'));
    var patient_id = $('.option_modal_div').attr('id');
    $('.option_modal_div').hide();
    $('.option_modal_div').attr('id', "");
    $('.record_management_div_1').hide();
    $('.record_management_div_4').show();
    $('.record_management_div_4').html('');
    var url_path = "";
    if ($(this).attr('id') == "consultation") {
      url_path = "consultation_form.php";
      
    }
    else if ($(this).attr('id') == "admission") {
      url_path = "admission_form.php";
    }
    else if ($(this).attr('id') == "med_cert") {
      url_path = "med_cert_form.php";
    }
    else if ($(this).attr('id') == "lab_res") {
      url_path = "lab_res_form.php";
    }
    $.ajax({
      url: url_path,
      method: "post",
      data: { patient: patient_id },
      dataType: "text",
      success: function (data) {
        
        $('.record_management_div_4').html(data);
        $(".cancel_form_btn_div .bx.bxs-x-circle").click(function () {
          $(".record_management_div_4").hide(),
            $(".record_management_div_1").show();
        });
        $('#patient_lab_res').change(function () {
          document.getElementById('lab_res_up_button').innerHTML = "<i class='bx bx-check'></i> File Uploaded";
        });
        
        $('#cons_form').submit(function (e) { 
        Swal.fire('Success!','Consultation form submitted successfully','success')
          //e.preventDefault();
        });
        $('#admi_form').submit(function (e) { 
          Swal.fire('Success!','Admission form submitted successfully','success')
          //e.preventDefault();
        });
        
        $('#med_cert_form').submit(function (e) { 
          Swal.fire('Success!','Medical Certificate form submitted successfully','success')
          //e.preventDefault();
        });
        
        $('#lab_res_form').submit(function (e) { 
          Swal.fire('Success!','Laboratory result form submitted successfully','success')
        // setTimeout(function(){
        //   window.location.reload(1);
        // }, 3000);
          //e.preventDefault();
        });

      }
    });
  });

  $('#table_patient .bx.bxs-user-minus').click(function () {
    var patient_id = $(this).attr('id');
    $('.record_management_div_1').hide();
    $('.record_management_div_4').show();
    $('.record_management_div_4').html('');

    $.ajax({
      url: "discharged_form.php",
      method: "post",
      data: { patient: patient_id },
      dataType: "text",
      success: function (data) {
        $('.record_management_div_4').html(data);
        $(".cancel_form_btn_div .bx.bxs-x-circle").click(function () {
          $(".record_management_div_4").hide(),
            $(".record_management_div_1").show();

        });

        $('#discharged_form').submit(function (e) { 
          Swal.fire('Success!','Discharged form submitted successfully','success')
        // setTimeout(function(){
        //   window.location.reload(1);
        // }, 3000);
          //e.preventDefault();
        });
      }
      
      
    });
  });

$('tr td a.archive_btn').on('click',function(e) {
  var archiveLink = this
  
  e.preventDefault();
  
  Swal.fire({
    title: 'Are you sure?',
    text: "Do you want to archive the patient",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, archive it!'
  }).then((result) => {
    if (result.isConfirmed) {
        window.location=archiveLink.href
    }
  })
})

  // $.fn.viewFunction = function (patient_id) {

  //   $('.record_management_div_3').html(''),
  //     $.ajax({
  //       url: "view_patient.php",
  //       method: "post",
  //       data: { view: patient_id },
  //       dataType: "text",
  //       success: function (data) {
  //         $('.record_management_div_3').html(data);
  //         $(".cancel_view_patient_btn_div .bx.bxs-x-circle").click(function () {
  //           $(".record_management_div_3").hide(),
  //             $(".record_management_div_1").show();

  //         });

  //         $("#admition_btn").click(function () {
  //           $(this).css(
  //             {
  //               "background-color": "rgb(52, 79, 95)",
  //               color: "white"
  //             }
  //           );
  //           $("#consultation_btn,#med_cert_btn,#lab_res_btn").css(
  //             {
  //               "background-color": "transparent",
  //               color: "black"
  //             }
  //           );

  //           $(".consultation_div,.med_cert_div,.lab_res_div").hide();

  //           $(".admition_div").show();

  //         });

  //         $("#consultation_btn").click(function () {
  //           $(this).css(
  //             {
  //               "background-color": "rgb(52, 79, 95)",
  //               color: "white"
  //             }
  //           );
  //           $("#admition_btn,#med_cert_btn,#lab_res_btn").css(
  //             {
  //               "background-color": "transparent",
  //               color: "black"
  //             }
  //           );

  //           $(".admition_div,.med_cert_div,.lab_res_div").hide();

  //           $(".consultation_div").show();

  //         });

  //         $("#med_cert_btn").click(function () {
  //           $(this).css(
  //             {
  //               "background-color": "rgb(52, 79, 95)",
  //               color: "white"
  //             }
  //           );
  //           $("#admition_btn,#consultation_btn,#lab_res_btn").css(
  //             {
  //               "background-color": "transparent",
  //               color: "black"
  //             }
  //           );

  //           $(".admition_div,.consultation_div,.lab_res_div").hide();

  //           $(".med_cert_div").show();

  //         });

  //         $("#lab_res_btn").click(function () {
  //           $(this).css(
  //             {
  //               "background-color": "rgb(52, 79, 95)",
  //               color: "white"
  //             }
  //           );
  //           $("#admition_btn,#consultation_btn,#med_cert_btn").css(
  //             {
  //               "background-color": "transparent",
  //               color: "black"
  //             }
  //           );

  //           $(".admition_div,.consultation_div,.med_cert_div").hide();

  //           $(".lab_res_div").show();


  //         });

  //       }
  //     });
  // }




});
