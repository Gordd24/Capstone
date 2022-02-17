$(document).ready(function () {
    flag = true;
    $("#signature").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#sign_error').html('Please upload signature in jpeg,jpg, or png format only')
            flag = false;
        }else{
            $('#sign_error').html('')
            flag = true;
        }
    });

    $('#generate_form').on('submit', function (e) {
        
        
        // var data = $('#medcert_form').serialize()
        if ($('#signature').get(0).files.length === 0) {
            e.preventDefault()
           $('#sign_error').html('Please upload signature')
        }
        else{
            if(flag){
                $('#sign_error').html('')
                
            }else{
               e.preventDefault()
            }
            
        }
    })

})