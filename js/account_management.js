$(document).ready(function(){
    $("#account_btn").click(function(){
      $(this).css("background-color","#ccc"),
      $("#accounts").show(),
      $("#registration").hide(),
      $("#registration_btn").css("background-color","inherit");
    });

    $("#registration_btn").click(function(){
      $(this).css("background-color","#ccc"),
      $("#registration").show(),
      $("#accounts").hide(),
      $("#account_btn").css("background-color","inherit");
      
    });

    //stops submittin, or simply disable 13 or the enter key
    $('.search_bar').on('keypress', function(e) {
      return e.which !== 13;
    });

    $(".search_bar").keyup(function()
    {
          var txt = $(this).val();
         //???? what 
          $('#table').html(''),
          $.ajax({
            url:"searched_account.php",
            method:"post",
            data:{search:txt},
            dataType:"text",
            success:function(data)
            {
              $('#table').html(data);
            }
          });            
          //somehow return false stops keyup functioning twice
          return false;
       
    }),
    $('body').on('click', 'tr', function () {
        console.log("asd");
      });
    
  });   


