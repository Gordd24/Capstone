$(document).ready(function(){
    $("#account_btn").click(function(){
      $(this).css(
        {
          "background-color":"rgb(52, 79, 95)",
          color:"white"
        }
     ),
      $("#accounts").show(),
      $("#registration").hide(),
      $("#registration_btn").css(
        {
          "background-color":"transparent",
          color:"black"
        }
      );

    });

    $("#registration_btn").click(function(){
      $(this).css(
        {
          "background-color":"rgb(52, 79, 95)",
          color:"white"
        }
     ),
      $("#registration").show(),
      $("#accounts").hide(),
      $("#account_btn").css(
        {
          "background-color":"transparent",
          color:"black"
        }
      );
      
    });

    //stops submittin, or simply disable 13 or the enter key
    $('.search_bar').on('keypress', function(e) {
      return e.which !== 13;
    });

    $(".search_bar").keyup(function()
    {
          var txt = $(this).val();
         //???? what 
          $('table').html(''),
          $.ajax({
            url:"searched_account.php",
            method:"post",
            data:{search:txt},
            dataType:"text",
            success:function(data)
            {
              $('table').html(data);
            }
          });            
          //somehow return false stops keyup functioning twice
          return false;
    }),
     $('body').on('click', '.bx.bxs-trash-alt', function(){
      var id = $(this).attr('id');

        //???? what 
        $('table').html(''),
        $.ajax({
          url:"delete_account.php",
          method:"post",
          data:{delete:id},
          dataType:"text",
          success:function(data)
          {
            $('table').html(data);
          }
          });       
        
    }),
    $('body').on('click', '.bx.bxs-user-account', function(){
      var id = $(this).attr('id');
      $("table,.search_form").hide(),
      $(".view_account").show(),
      $('.view_form_div').html(''),
      $.ajax({
        url:"view_account.php",
        method:"post",
        data:{view:id},
        dataType:"text",
        success:function(data)
        {
          $('.view_form_div').html(data),
          $("#view_form input[type='submit'],#view_form #viewEmpId").prop( "disabled", true ),
          $(".viewFields").keyup(function() {
                $("#view_form input[type='submit']").css("background-color","rgb(91, 220, 125)"),
                $("#view_form input[type='submit']").prop( "disabled", false);
          }),
          $("#view_form select").change(function() {
            $("#view_form input[type='submit']").css("background-color","rgb(91, 220, 125)"),
            $("#view_form input[type='submit']").prop( "disabled", false);
         });
          
          
        }
        }); 
    }),
    $('body').on('click', '.bx.bxs-x-circle', function(){
      $("table,.search_form").show(),
      $(".view_account").hide();
     
        
    });

  
   
    
  });   
