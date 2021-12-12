$(document).ready(function () {
    //get original  values
    var fname =$("#first_name").val();
    var mname =$("#middle_name").val();
    var lname =$("#last_name").val();
    var uname =$("#username").val();

    var newfname = $("#first_name").val();
    var newmname =$("#middle_name").val();
    var newlname =$("#last_name").val();
    
    
        $('#first_name').on('blur', function () {
            newfname =$("#first_name").val(); 
            console.log(fname)
            console.log(newfname)   
            return newfname;
        });
        $('#middle_name').on('blur', function () {
            newmname =$("#middle_name").val();
             return newmname
        });
        $('#last_name').on('blur', function () {
            newlname =$("#last_name").val();
            return newlname
        });
    //toggle forms

    $("#edit_info").change(function () {
        
        if (fname == newfname && mname == newmname && lname == newlname) {
            // $("input#update_name_submit").click(function (e) { 
            //     e.preventDefault();
            //     Swal.fire('Error','You have not change anything','error')
            // });
            if ($("#up_username_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_info_btn").toggleClass("d-none");
                if ($("#up_info_btn").hasClass("d-none")) {
                    $(".edit_info").attr("readonly", true);
                } else {
                    $(".edit_info").attr("readonly", false);
                }
            } else {
                Swal.fire('Error','You need to complete the ongoing update first.','error')
                $("#edit_info").prop("checked", false);
            }
            
            
        } else {
            Swal.fire('Error','You have unsave changes!','error')
            $("#edit_info").prop("checked", true);
        }
    });

    $("#edit_username").change(function () {
        if (!$("#edit_username_div").hasClass("editing")) {
            //check if there is ongoing update, 1 update at a time.
            if ($("#up_info_btn").hasClass("d-none") && $("#up_password_btn").hasClass("d-none")) {
                $("#up_username_btn").toggleClass("d-none");
                if ($("#up_username_btn").hasClass("d-none")) {
                    $(".edit_username").attr("readonly", true);
                } else {
                    $(".edit_username").attr("readonly", false);
                }
            } else {
                Swal.fire('Error','You need to complete the ongoing update first.','error')
                $("#edit_username").prop("checked", false);
            }
        } else {
            Swal.fire('Error','You have unsave changes!','error')
            $("#edit_username").prop("checked", true);
        }

    });
    var uname =$("#username").val();
    var current_pword_state = false;
    $('#password').on('blur', function(){
        var currentPword = $('#password').val()
        if(currentPword==''){
             current_pword_state = true
             return
        }
        $.ajax({
             type: "POST",
             url: "view_profile_update.php",
             data: {
                  'upd_password_check': 1,
                  'currentUname' : uname,
                  'currentPword' : currentPword   
             },
             success: function (response) {
                  
                  if(response == 0){
                       current_pword_state = false
                       console.log('password wrong')
                  }
                  else if(response==1){                           
                       current_pword_state = true
                       console.log('password correct')
                  }
                  else{
                       alert(response);
                       console.log(response)
                  }
                            
             }
        });
   })

   $("#form_password").on("submit", submitFormPassword)

   function submitFormPassword() {
    var data = $('#form_password').serialize();
    console.log(data)
    if (current_pword_state == false) {
         Swal.fire('Error!','Current password is wrong.','error')
    } else if ($("#new_password").val()!==$("#confirm_password").val()){
        Swal.fire('Error!','Password did not match.','error')
    }else {
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
                            console.log("res" +response)
                             if (response == '1') {
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
                                  console.log(response)
                             }
                        }
                   })
              }
         })
    }
    return false;
}


    $("#edit_password").change(function () {
        if (!$("#edit_password_div").hasClass("editing")) {
            //check if there is ongoing update, 1 update at a time.
            if ($("#up_info_btn").hasClass("d-none") && $("#up_username_btn").hasClass("d-none")) {
                $("#up_password_btn").toggleClass("d-none");
                if ($("#up_password_btn").hasClass("d-none")) {
                    $(".edit_password").attr("readonly", true);
                } else {
                    $(".edit_password").attr("readonly", false);
                }
            } else {
                Swal.fire('Error','You need to complete the ongoing update first.','error')
                $("#edit_password").prop("checked", false);
            }
        } else {
            Swal.fire('Error','You have unsave changes!','error')
            $("#edit_password").prop("checked", true);
        }
    });



    
    $('#username').on('blur', function (){
        newuname =$('#username').val()
        if (newuname == uname){
            $("#edit_username_div").removeClass("editing");   
        }else{
            $("#edit_username_div").addClass("editing");
        }
    })

    // if input begins add editing class
    // $(".edit_info").on("input", function () {
    //     if (!$("#edit_info_div").hasClass("editing")) {
    //         $("#edit_info_div").addClass("editing");
    //     }
    // });

    // $(".edit_username").on("input", function () {
    //     if (!$("#edit_username_div").hasClass("editing")) {
    //         $("#edit_username_div").addClass("editing");
    //     }
    // });

    $(".edit_password").on("input", function () {
        if (!$("#edit_password_div").hasClass("editing")) {
            $("#edit_password_div").addClass("editing");
        }
    });


});