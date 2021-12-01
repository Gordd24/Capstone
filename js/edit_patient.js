$(document).ready(function () {
    $("input,label").dblclick(function () {
        $('input').prop('readonly', false);
        $(':submit').css("background-color", "rgb(91, 220, 125)");
        $(":submit").prop('disabled', false);
        $("#edit_stat").text("You are Editing!");
        $("#edit_stat").css('color', "rgb(91, 220, 125)");
        $("input[type=radio]").prop('disabled', false);
    });

    $("input").on("input", function () {
        $(".record_management_edit_div").addClass("active");
    });

    
    $('a#edit_patient_exit').on('click', function (e) {
        var editLink = this
    
        e.preventDefault();
        
        if ($(".record_management_edit_div").hasClass("active")) {
            
            Swal.fire({
                title: 'Do you want to exit?',
                text: "You are currently editing the patient",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location = editLink.href
                }
              })
        }
    
        
      })
    
    
});

