$(document).ready(function () {
    $('#search_account').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_account").keyup(function () {
        var txt = $(this).val();
        //???? what 
        $('tbody').html('');
        $.ajax({
            url: "searched_account.php",
            method: "post",
            data: { search: txt },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);
                $(".bx.bxs-trash-alt").click(function () {
                    Swal.fire({
                        title: 'Are you sure you want to delete this account?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = $(this).attr('id');

                            $.ajax({
                                url: "delete_account.php",
                                method: "post",
                                data: { delete: id },
                                dataType: "text",
                                success: function (data) {
                                    location.href = "account_management.php";
                                }
                            });
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });

                });

            }
        });
        //somehow return false stops keyup functioning twice
        return false;
    });

    //delete

    $(".bx.bxs-trash-alt").click(function () {
        Swal.fire({
            title: 'Are you sure you want to delete this account?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('id');

                $.ajax({
                    url: "delete_account.php",
                    method: "post",
                    data: { delete: id },
                    dataType: "text",
                    success: function (data) {
                        Swal.fire({
                            title: 'Success',
                            text:'Registration Successful',
                            icon: 'success',
                        }).then((result) => {
                             // Reload the Page
                             location.reload();
                        });
                        
                    }
                });
                
            }
        });

    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    var reg_uname_state = false;
    var reg_empid_state = false;
    //check if uname exist
    $('#username').on('blur', function(){
        uname = $('#username').val()
        $.ajax({
            type: "POST",
            url: "register_validation.php",
            data: {
                 'username_check': 1,
                 'username': uname,
            },
            success: function (response) {
                 if (response == 0) {
                      reg_uname_state = false;
                      console.log(response)
                 }
                 else if (response == 1) {
                      reg_uname_state = true;
                      console.log(response)
                 }
                 else {
                      alert(response);
                 }

            }
        })
    })
    //check if emp id exist
    $('#emp_id').on('input', function () {
        emp_id = $('#emp_id').val()
        
        $.ajax({
             type: "POST",
             url: "register_validation.php",
             data: {
                  'empid_check': 1,
                  'employeeId': emp_id,
             },
             success: function (response) {
                  if (response == 0) {
                       reg_empid_state = false;
                       console.log(response)
                  }
                  else if (response == 1) {
                       reg_empid_state = true;
                       console.log(response)
                  }
                  else {
                       alert(response);
                       console.log(response)
                  }
             }
        });
   });
   //check if email exist
   email_state = false;
   $('#email').on('blur', function () {
    email = $('#email').val()
   
    $.ajax({
         type: "POST",
         url: "register_validation.php",
         data: {
              'email_check': 1,
              'email': email,
         },
         success: function (response) {
              if (response == 0) {
                   email_state = false;
                   console.log(response)
              }
              else if (response == 1) {
                   email_state = true;
                   console.log(response)
              }
              else {
                   alert(response);
                   console.log(response)
              }
         }
    });
});
    //account group
    
    $("#account_next_btn").click(function () {
        uname = $('#username').val()
        email = $('#email').val()
        pword = $('#password').val()
        cpword = $('#confirm_password').val()
        if (uname != '' && email != '' && pword != '' && cpword != '') {
            if(reg_uname_state){
                if (isEmail(email) == true) {
                    if(email_state){
                        if (pword.length>=8){
                            if (pword == cpword) {
                                $("#account_group").removeClass("active_group");
                                $("#personal_group").addClass("active_group");
                                $(".progress-bar").css('width', '69%');
                                //remove red texts if there is any
                                $('#uname_error').html('')
                                $('#email_error').html('')
                                $('#pword_error').html('')
                                $('#cpword_error').html('')   
                            } else {
                                Swal.fire('Error!', 'Password did not match.', 'error')
                            }
                        }else{
                            $('#pword_error').html('Password too short. Please enter atleast 8 characters.')
                        }
                        
                        }else {
                            Swal.fire('Error!', 'This email is already registered', 'error')
                            $('#email_error').html('This email is already registered')
                    }
                } else {
                    Swal.fire('Error!', 'Please use a valid email', 'error')
                    $('#email_error').html('Please enter a valid email')
                }
            }else{
               
                Swal.fire('Error!', 'Username already exist', 'error')
                $('#uname_error').html('Please enter valid username')
            }
        }
        else {
            if(uname == '')$('#uname_error').html('Please enter username')
            if(email =='')$('#email_error').html('Please enter email')
            if(pword =='')$('#pword_error').html('Please enter password')
            if(cpword =='')$('#cpword_error').html('Please enter password')
            
        }
    })

    

    //personal group
    $("#personal_next_btn").click(function () {
        console.log('hellow')
        fname = $('#first_name').val()
        mname = $('#middle_name').val()
        lname = $('#last_name').val()

        if (fname != '' && lname != '') {
            $("#personal_group").removeClass("active_group");
            $("#emp_group").addClass("active_group");
            $(".progress-bar").css('width', '100%');
            //remove red texts if there is any
            $('#fname_error').html('')
            $('#lname_error').html('')
        } else {
            if(fname =='')$('#fname_error').html('Please enter first name')
            if(lname =='')$('#lname_error').html('Please enter last name')
            
            
        }
    });

    $("#personal_prev_btn").click(function () {
        $("#personal_group").removeClass("active_group");
        $("#account_group").addClass("active_group");
        $(".progress-bar").css('width', '33%');
    });

    //employee group
    $("#regform").on("submit",function (e) {   
        var data = $('#regform').serialize();
        emp_id = $('#empi_id').val()
        if(emp_id==''){
            $('#empid_error').html('Please enter employee id')
            e.preventDefault()
           
        }else{
            if(reg_empid_state){
               
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'register_validation.php',
                    data: data,
                    success: function (response){        
                        Swal.fire({
                           title: 'Success',
                           text:'Registration Successful',
                           icon: 'success',
                          }).then((result) => {
                            // Reload the Page
                            $('#empid_error').html('')
                            location.href= 'account_management.php';
                          });
                    }
                })
                return false;
            }else{
                Swal.fire('Error!','Employee id already exists','error')
                e.preventDefault()
            }
        }
    }) 
    $("#emp_prev_btn").click(function () {
        $("#emp_group").removeClass("active_group");
        $("#personal_group").addClass("active_group");
        $(".progress-bar").css('width', '69%');
    });

});