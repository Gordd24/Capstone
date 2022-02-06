$(document).ready(function () {

    $('#form_follow').on('submit',function(e){
        e.preventDefault();
        var submit = $('#hidden_field_follow').val()
        console.log(submit);
        var checkedArray = [];
        if ($('#form_follow :checkbox:checked').length > 0){
            $('input[name="results"]:checked').each(function () {  
                checkedArray.push($(this).val())
            })
            

            checked = JSON.stringify(checkedArray)
            console.log(checked)
            $.ajax({
                type: "POST",
                url: "follow_process.php",
                data: {
                    'hidden_field_follow': submit,
                    'checked': checked
                },
                cache: false,
                success: function (response) {
                    if(response == '1'){
                        
                        Swal.fire({
                            title: 'Success',
                            text: 'Follow up Success',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then((result) => {
                            // Reload the Page
                            location.reload()
                        });
                    }else if (response==0){
                        console.log('dipumasok')
                    }else{
                        console.log(response);
                    }
                    
                }
            });
          }
          else{
            Swal.fire('Error','Please select atleast one from the checkboxes','error')
          }

    })

})