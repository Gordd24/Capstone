$(document).ready(function () {
    
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    radio ='patient';
    $('#frmForget').on('submit', function (e) {
        var data = $('#frmForget').serialize();
        email = $('#forgetEmail').val()
        categ = $('input[name="forgot_account"]:checked').val()

        console.log(categ)
        if (categ == 'patient'){
            if(email==''){
                $('#email_error').html('Please enter email')
                e.preventDefault()
            }
            else{
                e.preventDefault();
                if(isEmail(email) == true){
                    
                        $.ajax({
                            type: 'POST',
                            url: 'forgetProcess.php',
                            data: data,
                            success: function (response){        
                                if (response == '1'){
                                    Swal.fire({
                                        title: 'Success',
                                        text:'Check email for reset password link',
                                        icon: 'success',
                                       }).then((result) => {
                                         // Reload the Page
                                         $('#email_error').html('')
                                         location.reload();
                                       });
                                }else if (response == '0'){
                                    Swal.fire('Error!', 'Email does not exist', 'error')
                                }else{
                                    console.log('There is a website error')
                                }
                                
                            }
                        })
                        return false;
                }else{
                    
                    Swal.fire('Error!', 'Please use a valid email', 'error')
                    $('#email_error').html('Please enter a valid email')
                }
            }
        }
        else if (categ == 'personnel'){
            if(email==''){
                $('#email_error').html('Please enter email')
                e.preventDefault()
            }
            else{
                e.preventDefault();
                if(isEmail(email) == true){
                        $.ajax({
                            type: 'POST',
                            url: 'forgetProcess2.php',
                            data: data,
                            success: function (response){      
                                
                                if(response == '1'){
                                    console.log(response)
                                    Swal.fire({
                                        title: 'Success',
                                        text:'Check email for reset password link',
                                        icon: 'success',
                                       }).then((result) => {
                                         // Reload the Page
                                         $('#email_error').html('')
                                         location.reload();
                                       });
                                }else if (response == '0'){
                                    console.log(response)
                                    Swal.fire('Error!', 'Email does not exist', 'error')
                                }
                                else{
                                    alert(response)
                                }  
                                
                            },
                            
                        })
                        return false;
    
                    }
                   
                else{
                    
                    Swal.fire('Error!', 'Please use a valid email', 'error')
                    $('#email_error').html('Please enter a valid email')
                }
            }
        }
        
    })

    $('#reset_form').on('submit', function(e){
        data = $('#reset_form').serialize();
        password = $('#new_password').val()
        cpassword = $('#confirm_password').val()
        console.log(password)
        if (password != '' && cpassword!=''){
            if(password===cpassword){
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'reset_process.php',
                    data: data,
                    success: function (response){   
                            console.log(response)  
                            Swal.fire({
                                title: 'Success',
                                text:'Password updated successfully',
                                icon: 'success',
                               }).then((result) => {
                                 // Reload the Page
                                 $('#password_error').html('')
                                 $('#cpassword_error').html('')
                                 location.href= 'index.php';
                               });
                    }
                })
                return false;
    
            }else{
                Swal.fire('Error','Password did not match','error')
                e.preventDefault();
            }
        }else{
            $('#password_error').html('Please enter password')
            $('#cpassword_error').html('Please enter confirm password')
            e.preventDefault();
        }  
    })
})