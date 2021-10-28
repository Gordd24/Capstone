$(document).ready(function(){

    $('#patient_search').on('keypress', function(e) {
        return e.which !== 13;
    });
      
    $("#patient_search").keyup(function()
    {

            var txt = $(this).val();
            //???? what 
            $('#table_patient').html(''),
            $.ajax({
              url:"searched_patients.php",
              method:"post",
              data:{search:txt},
              dataType:"text",
              success:function(data)
              {
                $('#table_patient').html(data);
              }
            });            
            //somehow return false stops keyup functioning twice
            return false;
    });


    $("#add_patient_btn").click(function(){
      $(".record_management_div_1").hide(),
      $(".record_management_div_2").show();

    });

    $(".bx.bxs-x-circle").click(function(){
      $(".record_management_div_2").hide(),
      $(".record_management_div_1").show();

    });
    


});   
