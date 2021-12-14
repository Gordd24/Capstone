$(document).ready(function () {
     $("#account_btn").click(function () {
          $(this).css(
               {
                    "background-color": "rgb(52, 79, 95)",
                    color: "white"
               }
          ),
               $("#accounts").show(),
               $("#registration").hide(),
               $("#registration_btn").css(
                    {
                         "background-color": "transparent",
                         color: "black"
                    }
               );
     });
     $("#registration_btn").click(function () {
          $(this).css(
               {
                    "background-color": "rgb(52, 79, 95)",
                    color: "white"
               }
          ),
               $("#registration").show(),
               $("#accounts").hide(),
               $("#account_btn").css(
                    {
                         "background-color": "transparent",
                         color: "black"
                    }
               );

     });
     var reg_uname_state = false;
     var reg_empid_state = false;

     //check if uname exist
     $('#regUname').on('blur', function () {

          var regisUname = $('#regUname').val()
          if (regisUname == '') {
               reg_uname_state = false;
               return
          }
          $.ajax({
               type: "POST",
               url: "account_register.php",
               data: {
                    'username_check': 1,
                    'regisUname': regisUname,
               },
               success: function (response) {
                    if (response == 0) {
                         reg_uname_state = false;
                    }
                    else if (response == 1) {
                         reg_uname_state = true
                    }
                    else {
                         alert(response);
                    }

               }
          });
     });

     //check if emp id exist
     $('#regEmpId').on('blur', function () {
          var regisEmpid = $('#regEmpId').val()
          if (regisEmpid == '') {
               reg_empid_state = false;              
               return
          }
          $.ajax({
               type: "POST",
               url: "account_register.php",
               data: {
                    'empid_check': 1,
                    'employeeId': regisEmpid,
               },
               success: function (response) {
                    if (response == 0) {
                         reg_empid_state = false;
                    }
                    else if (response == 1) {
                         reg_empid_state = true;
                    }
                    else {
                         alert(response);
                    }
               }
          });
     });

     $("#regForm").validate({
          rules: {
               regUname: {
                    required: true,
               },
               regPword: {
                    required: true,
                    minlength: 5
               },
               regCPword: {
                    required: true,
                    equalTo: '#regPword'
               },
               regFname: {
                    required: true,
               },
               regLname: {
                    required: true,
               },
               regEmpId: {
                    required: true,
               },
          },
          messages: {
               regUname: "Please enter username",
               regPword: {
                    required: "Please provide a password",
                    minlength: "password must atleast have 5 characters"
               },
               regCPword: {
                    required: "Please retype your password",
                    equalTo: "Password does not match"
               },
               regFname: "Please enter first name",
               regLname: "Please enter last name",
               regEmpId: "Please enter Employee ID"

          },
          submitHandler: submitForm
     })
     //form submitter
     function submitForm() {
          var data = $('#regForm').serialize();
          if (reg_uname_state == false) {
               Swal.fire('Error','Username already exist','error')
          } else if(reg_empid_state == false){
               Swal.fire('Error','Employee ID already exist','error')

          }else {
               $.ajax({
                    type: 'POST',
                    url: "account_register.php",
                    data: data,
                    beforeSend: function () {
                         $("#error").fadeOut();
                         $("#error2").fadeOut();
                    },
                    success: function (response) {
                         Swal.fire(
                              'Success',
                              'Registration is successful',
                              'success'
                         )
                         $('#regUname').val('')
                         $('#regPword').val('')
                         $('#regCPword').val('')
                         $('#regFname').val('')
                         $('#regMname').val('')
                         $('#regLname').val('')
                         $('#regEmpId').val('')

                         setTimeout(function () {
                              window.location.reload(1);
                         }, 1000);
                    }
               })
          }
          return false;
     }

     /*--------------------UPDATE ACCOUNT------------------------*/

     //   unused codes, might delete later
     //      var current_pword_state = true
     /*     $('#currentPword').on('blur', function(){
               var currentPword = $('#currentPword').val()
               if(currentPword==''){
                    current_pword_state = true
                    $('#currentPword').parent().removeClass();
                    $('#currentPword').parent().removeClass("form_error");
                    $('#currentPword').siblings("span").text('');
                    return
               }
               $.ajax({
                    type: "POST",
                    url: "update_validation.php",
                    data: {
                         'upd_password_check': 1,
                         'currentUname' : currentUname,
                         'currentPword' : currentPword
                         
                    },
                    success: function (response) {
                         
                         if(response == 0){
                              
                              current_pword_state = false 
                              $('#currentPword').parent().removeClass();
                              $('#currentPword').parent().addClass("form_error");
                              $('#currentPword').siblings("span").text('Current Password is wrong');
                                   
                         }
                         else if(response==1){    
                              
                              current_pword_state = true
                              $('#currentPword').parent().removeClass();
                              $('#currentPword').parent().removeClass("form_error");
                              $('#currentPword').siblings("span").text('');
                         }
                         else{
                              alert(response);
                              $('#currentPword').parent().removeClass();
                              $('#currentPword').parent().removeClass("form_error");
                              $('#currentPword').siblings("span").text(response);
                         }
                                   
                    }
               });
          })
          */
     //form submitter update
     function submitFormUpdate() {
          var data = $('#view_form').serialize();
          // if(upd_uname_state == false || current_pword_state == false){
          if (upd_uname_state == false) {
               Swal.fire(
                    'Error!',
                    'Username already exist',
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
                              url: "update_validation.php",
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
                                   }
                              }
                         })
                    }
               })
          }

          return false;
     }
     //stops submittin, or simply disable 13 or the enter key
     $('.search_bar').on('keypress', function (e) {
          return e.which !== 13;
     });
     $(".search_bar").keyup(function () {
          var txt = $(this).val();
          //???? what 
          $('table').html(''),
               $.ajax({
                    url: "searched_account.php",
                    method: "post",
                    data: { search: txt },
                    dataType: "text",
                    success: function (data) {
                         $('table').html(data);
                         var upd_uname_state = true;

                         $(".bx.bxs-user").click(function () {
                              var id = $(this).attr('id');
                              $(".accounts_table_div,.search_form").hide(),
                                   $(".view_account").show(),
                                   $('.view_form_div').html(''),
                                   $.ajax({
                                        url: "view_account.php",
                                        method: "post",
                                        data: { view: id },
                                        dataType: "text",
                                        success: function (data) {
                                             $('.view_form_div').html(data);

                                             $(".mutable input[type=text],.mutable input[type=password],.mutable select").dblclick(function () {
                                                  $("h4").text("You are Editing!");
                                                  $("h4").css('color', 'rgb(91, 220, 125)');
                                                  $(":submit").prop('disabled', false);
                                                  $(".mutable input[type=text],.mutable input[type=password],.mutable select").prop('readonly', false);
                                                  $("option").prop('disabled', false);
                                                  if (!($(":submit").hasClass("enable"))) {
                                                       $(":submit").addClass("enable");
                                                  }

                                             });

                                             $(".bx.bxs-x-circle").click(function () {



                                                  if ($(".view_form_div").hasClass("active")) {
                                                       // alert("ongoing pa sweet alert ulet");
                                                      Swal.fire({
                                                            title: 'You are currently updating an acount',
                                                            text: "Do you want to exit?",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes'
                                                            }).then((result) => {
                                                                 if (result.isConfirmed) {
                                                                      window.location.href = "account_management.php";
                                                                 }
                                                            })
                                                  }
                                                  else {
                                                       window.location.href = "account_management.php";
                                                  }
                                             });


                                             $("input").on("input", function () {
                                                  $(".view_form_div").addClass("active");
                                             });

                                             //to get the current username
                                             var currentUname = $('#viewUname').val()

                                             $('#viewUname').on('blur', function () {
                                                  var viewUname = $('#viewUname').val()
                                                  if (viewUname === '') {
                                                       upd_uname_state = false;
                                                       
                                                       return
                                                  }

                                                  if (viewUname !== currentUname) {
                                                       $.ajax({
                                                            type: "POST",
                                                            url: "update_validation.php",
                                                            data: {
                                                                 'upd_username_check': 1,
                                                                 'viewUname': viewUname,
                                                            },
                                                            success: function (response) {

                                                                 if (response == 0) {
                                                                      upd_uname_state = false;
                                                                      
                                                                 }
                                                                 else if (response == 1) {
                                                                      upd_uname_state = true;
                                                                      
                                                                 }
                                                                 else {
                                                                      alert(response);
                                                                 }
                                                            }
                                                       });
                                                  }
                                                  else if (viewUname === currentUname) {
                                                       upd_uname_state = true;
                                                  }
                                             });

                                             $("#view_form").validate({
                                                  rules: {
                                                       viewUname: {
                                                            required: true,
                                                       },

                                                       viewFname: {
                                                            required: true,
                                                       },
                                                       viewLname: {
                                                            required: true,
                                                       },
                                                       newPword: {
                                                            minlength: 5
                                                       },
                                                       confirmPword: {
                                                            equalTo: '#newPword'
                                                       },
                                                  },
                                                  messages: {
                                                       viewUname: "Please enter username",
                                                       viewFname: "Please enter first name",
                                                       viewLname: "Please enter last name",

                                                       newPword: {

                                                            minlength: "password must atleast have 5 characters"
                                                       },
                                                       confirmPword: {

                                                            equalTo: "Password does not match"
                                                       },
                                                  },
                                                  submitHandler: submitFormUpdate
                                             })
                                        }
                                   });
                         });
                    }
               });
          //somehow return false stops keyup functioning twice
          return false;
     }),
          //delete
          $('body').on('click', '.bx.bxs-trash-alt', function () {
               Swal.fire({
                    title: 'Are you sure you want to delete this account?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
               }).then((result) => {
                    if (result.isConfirmed) {
                         var id = $(this).attr('id');
                         //???? what 
                         $('table').html(''),

                              $.ajax({
                                   url: "delete_account.php",
                                   method: "post",
                                   data: { delete: id },
                                   dataType: "text",
                                   success: function (data) {
                                        $('table').html(data);
                                   }
                              });
                         Swal.fire(
                              'Deleted!',
                              'Your file has been deleted.',
                              'success'
                         )
                    }
               })

          });
     //update
     // $('body').on('click', '.bx.bxs-user', function () {
     //      var id = $(this).attr('id');
     //      $(".accounts_table_div,.search_form").hide(),
     //           $(".view_account").show(),
     //           $('.view_form_div').html(''),
     //           $.ajax({
     //                url: "view_account.php",
     //                method: "post",
     //                data: { view: id },
     //                dataType: "text",
     //                success: function (data) {
     //                     $('.view_form_div').html(data),
     //                          $("#view_form input[type='submit'],#view_form #viewEmpId").prop("disabled", true),
     //                          $(".viewFields").keyup(function () {
     //                               $("#view_form input[type='submit']").css("background-color", "rgb(91, 220, 125)"),
     //                                    $("#view_form input[type='submit']").prop("disabled", false);
     //                          }),
     //                          $("#view_form select").change(function () {
     //                               $("#view_form input[type='submit']").css("background-color", "rgb(91, 220, 125)"),
     //                                    $("#view_form input[type='submit']").prop("disabled", false);
     //                          });


     //                }
     //           });
     // });

     var upd_uname_state = true;

     $(".bx.bxs-user").click(function () {
          var id = $(this).attr('id');
          $(".accounts_table_div,.search_form").hide(),
               $(".view_account").show(),
               $('.view_form_div').html(''),
               $.ajax({
                    url: "view_account.php",
                    method: "post",
                    data: { view: id },
                    dataType: "text",
                    success: function (data) {
                         $('.view_form_div').html(data);

                         $(".mutable input[type=text],.mutable input[type=password],.mutable select").dblclick(function () {
                              $("h4").text("You are Editing!");
                              $("h4").css('color', 'rgb(91, 220, 125)');
                              $(":submit").prop('disabled', false);
                              $(".mutable input[type=text],.mutable input[type=password],.mutable select").prop('readonly', false);
                              $("option").prop('disabled', false);
                              if (!($(":submit").hasClass("enable"))) {
                                   $(":submit").addClass("enable");
                              }

                         });

                         $(".bx.bxs-x-circle").click(function () {

                              if ($(".view_form_div").hasClass("active")) {
                                   // alert("ongoing pa sweet alert ulet");
                                   Swal.fire({
                                        title: 'You are currently updating an acount',
                                        text: "Do you want to exit?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes'
                                        }).then((result) => {
                                             if (result.isConfirmed) {
                                                  window.location.href = "account_management.php";
                                             }
                                        })
                              }
                              else {
                                   window.location.href = "account_management.php";
                              }
                         });


                         $("input").on("input", function () {
                              $(".view_form_div").addClass("active");
                         });

                         //to get the current username
                         var currentUname = $('#viewUname').val()

                         $('#viewUname').on('blur', function () {
                              var viewUname = $('#viewUname').val()
                              if (viewUname === '') {
                                   upd_uname_state = false;
                                   return
                              }

                              if (viewUname !== currentUname) {
                                   $.ajax({
                                        type: "POST",
                                        url: "update_validation.php",
                                        data: {
                                             'upd_username_check': 1,
                                             'viewUname': viewUname,
                                        },
                                        success: function (response) {

                                             if (response == 0) {
                                                  upd_uname_state = false;
                                             }
                                             else if (response == 1) {
                                                  upd_uname_state = true;
                                                  
                                             }
                                             else {
                                                  alert(response);
                                             }
                                        }
                                   });
                              }
                              else if (viewUname === currentUname) {
                                   upd_uname_state = true;
                              }
                         });

                         $("#view_form").validate({
                              rules: {
                                   viewUname: {
                                        required: true,
                                   },

                                   viewFname: {
                                        required: true,
                                   },
                                   viewLname: {
                                        required: true,
                                   },
                                   newPword: {
                                        minlength: 5
                                   },
                                   confirmPword: {
                                        equalTo: '#newPword'
                                   },
                              },
                              messages: {
                                   viewUname: "Please enter username",
                                   viewFname: "Please enter first name",
                                   viewLname: "Please enter last name",

                                   newPword: {

                                        minlength: "password must atleast have 5 characters"
                                   },
                                   confirmPword: {

                                        equalTo: "Password does not match"
                                   },
                              },
                              submitHandler: submitFormUpdate
                         })
                    }
               });
     });

});