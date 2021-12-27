$(document).ready(function () {
    $('#search_patient').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_patient").keyup(function () {
        var txt = $(this).val();
        $('tbody').html('');
        $.ajax({
            url: "searched_patient.php",
            method: "post",
            data: { search: txt },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);

            }
        });
        //somehow return false stops keyup functioning twice
        return false;
    });

    function isEmail(email){
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
            return false;
          }else{
            return true;
          }
    }

    //consultation personal group
    $("#patient1_next_btn").click(function () {
        fname = $('#first_name').val()
        mname = $('#middle_name').val()
        lname = $('#last_name').val()
        email = $('#email').val()
        if(fname!='' && lname!='' && email!=''){
            if(isEmail(email)==true){
                $("#patient1_group").removeClass("active_group");
                $("#patient2_group").addClass("active_group");
                $(".progress-bar").css('width', '66%');
            }else{
                Swal.fire('Error!','Please enter a valid email','error')
            }
        }else{
            Swal.fire('Error!','Please fill up all the required fields.','error')
        }
    });


    //vital group    
    $("#patient2_next_btn").click(function () {
        bday = $('#birthdate').val()
        address = $('#address').val()
        if(Date.parse(bday) && address!=''){
            $("#patient2_group").removeClass("active_group");
            $("#patient3_group").addClass("active_group");
            $(".progress-bar").css('width', '100%');
        }
        else{
            Swal.fire('Error!','Please fill up all the required fields.','error')
        }
    });

    $("#patient2_prev_btn").click(function () {
        $("#patient2_group").removeClass("active_group");
        $("#patient1_group").addClass("active_group");
        $(".progress-bar").css('width', '33%');
    });


    // account group
    $("#patient3_prev_btn").click(function () {
        $("#patient3_group").removeClass("active_group");
        $("#patient2_group").addClass("active_group");
        $(".progress-bar").css('width', '66%');
    });







});