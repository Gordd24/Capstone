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
        $("input").on("input", function () {
          $(".record_management_div_4").addClass("active");
        });
        $(".cancel_form_btn_div .bx.bxs-x-circle").click(function () {

          if ($(".record_management_div_4").hasClass("active")) {
            Swal.fire({
              title: 'You are currently creating a form',
              text: "Do you want to exit?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
              }).then((result) => {
                   if (result.isConfirmed) {
                        window.location.href = "record_management.php";
                   }
              })
          }
          else {
            $(".record_management_div_4").hide();

            $(".record_management_div_1").show();
          }

        });
        $('#patient_lab_res').change(function () {
          document.getElementById('lab_res_up_button').innerHTML = "<i class='bx bx-check'></i> File Uploaded";
        });

        $('#cons_form').submit(function (e) {
          Swal.fire('Success!', 'Consultation form submitted successfully', 'success')
          //e.preventDefault();
        });
        $('#admi_form').submit(function (e) {
          Swal.fire('Success!', 'Admission form submitted successfully', 'success')
          //e.preventDefault();
        });

        $('#med_cert_form').submit(function (e) {
          Swal.fire('Success!', 'Medical Certificate form submitted successfully', 'success')
          //e.preventDefault();
        });

        $('#lab_res_form').submit(function (e) {
          Swal.fire('Success!', 'Laboratory result form submitted successfully', 'success')
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
          Swal.fire('Success!', 'Discharged form submitted successfully', 'success')
          // setTimeout(function(){
          //   window.location.reload(1);
          // }, 3000);
          //e.preventDefault();
        });
      }


    });
  });
  
  $('tr td a.archive_btn').on('click', function (e) {
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
        window.location = archiveLink.href
      }
    })
  })





});
