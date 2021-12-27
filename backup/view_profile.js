$(document).ready(function () {
     // $(".profile_editable").dblclick(function () {
     //     $('.profile_editable').prop('readonly', false);
     //     $(':submit').css("background-color", "rgb(91, 220, 125)");
     //     $(":submit").prop('disabled', false);
     //     $("#edit_stat").text("You are Editing!");
     //     $("#edit_stat").css('color', "rgb(91, 220, 125)");
     // });



     var current_pword_state = true
     var currentUname = $('#currentUname').val();
     $('#currentPword').on('blur', function () {
          var currentPword = $('#currentPword').val()
          if (currentPword == '') {
               current_pword_state = false;
               //   $('#currentPword').parent().removeClass();
               //   $('#currentPword').parent().removeClass("form_error");
               //   $('#currentPword').siblings("span").text('');
               return
          }
          $.ajax({
               type: "POST",
               url: "view_profile_update.php",
               data: {
                    'upd_password_check': 1,
                    'currentUname': currentUname,
                    'currentPword': currentPword
               },
               success: function (response) {

                    if (response == 0) {
                         current_pword_state = false
                    }
                    else if (response == 1) {
                         current_pword_state = true
                    }
                    else {
                         alert(response);

                    }

               }
          });
     })


     $("#edit_profile_form").validate({
          rules: {
               newPword: {
                    minlength: 5
               },
               confirmPword: {
                    equalTo: '#newPword'
               },
          },
          messages: {
               newPword: "password must atleast have 5 characters",
               confirmPword: "Password does not match"

          },
          submitHandler: submitFormUpdate
     })


     //form submitter update
     function submitFormUpdate() {
          var data = $('#edit_profile_form').serialize();
          if (current_pword_state == false) {
               Swal.fire(
                    'Error!',
                    'Current password is wrong',
                    'error'
               )
          } else {
               Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update this account!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
               }).then((result) => {
                    if (result.isConfirmed) {
                         $.ajax({
                              type: 'POST',
                              url: "view_profile_update.php",
                              data: data,
                              success: function (response) {

                                   if (response == 1) {
                                        Swal.fire(
                                             'Success',
                                             'Update is successful',
                                             'success'
                                        )
                                        setTimeout(function () {
                                             window.location.reload(1);
                                        }, 1000);
                                   }
                                   else {
                                        alert(response);
                                        $('#currentPword').parent().removeClass();
                                        $('#currentPword').parent().removeClass("form_error");
                                        $('#currentPword').siblings("span").text(response);
                                   }
                              }
                         })
                    }
               })


          }

          return false;
     }



     $(".pass_field").on("input", function () {
          if (!($(".button").hasClass("enable"))) {
               $(".button").toggleClass("enable");
               $(".button").prop("disabled", false);
          }


     });
});

