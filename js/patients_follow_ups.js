$(document).ready(function () {
    $('#search_request').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_request").keyup(function () {
        var txt = $(this).val();
        // console.log(txt);
        //???? what 
        $('tbody').html('');
        $.ajax({
            url: "searched_follow_ups.php",
            method: "post",
            data: { search: txt },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);
                $(".bx.respond").click(function () {
                    var idarr = $(this).attr('id').split("_");
                    var id = idarr[0];
                    var req_id = idarr[1];
                    location.href = "../patients_record_management/laboratory.php?id=" + id + "&req_id=" + req_id;
                });
                $(".bx.not_avail").click(function () {
                    Swal.fire({
                        title: 'Confirmation',
                        text: "Are you sure that the record is not available?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "../patients_follow_ups/response_fail.php?id=" + $(this).attr("id");
                        }
                      })

                    
                });
                $(".bx.avail").click(function () {
                    Swal.fire({
                        title: 'Confirmation',
                        text: "Are you sure that the record is available?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "../patients_follow_ups/response_success.php?id=" + $(this).attr("id");
                        }
                      })
                    
                    // console.log($(this).attr("id"));
                });

            }
        });
        //somehow return false stops keyup functioning twice
        return false;
    });



    $(".bx.respond").click(function () {
        var idarr = $(this).attr('id').split("_");
        var id = idarr[0];
        var req_id = idarr[1];
        location.href = "../patients_record_management/laboratory.php?id=" + id + "&req_id=" + req_id;
    });

    $(".bx.not_avail").click(function () {
        Swal.fire({
            title: 'Confirmation',
            text: "Are you sure that the record is not available?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
                location.href = "../patients_follow_ups/response_fail.php?id=" + $(this).attr("id");
            }
          })
        // console.log($(this).attr("id"));
    });

    $(".bx.avail").click(function () {
        Swal.fire({
            title: 'Confirmation',
            text: "Are you sure that the record is available?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
                location.href = "../patients_follow_ups/response_success.php?id=" + $(this).attr("id");
            }
          })
        // console.log($(this).attr("id"));
    });

});