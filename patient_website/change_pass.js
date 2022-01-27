$(document).ready(function () {
    $('#change_pass_form').on('submit', function (e) {
        e.preventDefault();
        
        pword = $('#new_password').val()
        cpword = $('#confirm_password').val()
        if(pword !='' && cpword!=''){
            if (pword.length>=8){
                if(pword === cpword){
                    var data = $('#change_pass_form').serialize();
                    $.ajax({
                        type: "POST",
                        url: "change_pass_process.php",
                        data: data,
                        success: function (response) {
                            if(response ==1){
                                console.log(response)
                                Swal.fire({
                                    title: 'Success',
                                    text:'Password updated',
                                    icon: 'success',
                                   }).then((result) => {
                                     // Reload the Page
                                    $('#password_error').html('')
                                    $('#cpassword_error').html('')
                                    location.href = '../patient_website/profile/patient_profile.php';
                                   });
                            }else{
                                console.log(response)
                            }
                            
                        }
                    });
                }else{
                    Swal.fire('Error!', 'Password did not match.', 'error')
                    $('#password_error').html('')
                    $('#cpassword_error').html('')
                }
            }else{
                $('#password_error').html('Please enter atleast 8 characters')
                $('#cpassword_error').html('')
            }
        }
        else{
            if(pword =='')$('#password_error').html('Please enter password')
            if(cpword =='')$('#cpassword_error').html('Please enter password')
        }
      })
})