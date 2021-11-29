$(document).ready(function () {
    $(".bx.bxs-x-circle").click(function () {

        if ($(".add_patient_div").hasClass("active")) {
            Swal.fire(
                'Error!',
                'Adding is still ongoing.',
                'error'
           )
        }
        else {
            window.location.href = "record_management.php";
        }
    });


    $("input").on("input", function () {
        $(".add_patient_div").addClass("active");
    });

    //nadagdag
    $('#add_patient_form').submit(function (e) {
        var bday = $('#patient_birthday').val() 
        if($('#patient_fname').val() !="" && $('#patient_lname').val() !="" && $('#patient_address').val() !="" && Date.parse(bday)){    
              Swal.fire(
                'Success!',
                'Patient added successfully',
                'success'
            )
            
        }else{
            Swal.fire(
                'Error!',
                'Fill up all the required fields',
                'error'
            )
            e.preventDefault();
        }
    });

});

