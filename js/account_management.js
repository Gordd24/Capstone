$(document).ready(function () {
    $('#search_account').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_account").keyup(function () {
        var txt = $(this).val();
        //???? what 
        $('tbody').html('');
        $.ajax({
            url: "searched_account.php",
            method: "post",
            data: { search: txt },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);
                $(".bx.bxs-trash-alt").click(function () {
                    Swal.fire({
                        title: 'Are you sure you want to delete this account?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = $(this).attr('id');
                            //???? what 
                            $('tbody').html(''),

                                $.ajax({
                                    url: "delete_account.php",
                                    method: "post",
                                    data: { delete: id },
                                    dataType: "text",
                                    success: function (data) {
                                        $('tbody').html(data);
                                    }
                                });
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });

                });

            }
        });
        //somehow return false stops keyup functioning twice
        return false;
    });

    //delete

    $(".bx.bxs-trash-alt").click(function () {
        Swal.fire({
            title: 'Are you sure you want to delete this account?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('id');
                //???? what 
                $('tbody').html(''),

                    $.ajax({
                        url: "delete_account.php",
                        method: "post",
                        data: { delete: id },
                        dataType: "text",
                        success: function (data) {
                            $('tbody').html(data);
                        }
                    });
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });

    });

    // account group
    $("#account_next_btn").click(function () {
        $("#account_group").removeClass("active_group");
        $("#personal_group").addClass("active_group");
        $(".progress-bar").css('width', '69%');
    });


    //personal group
    $("#personal_next_btn").click(function () {
        $("#personal_group").removeClass("active_group");
        $("#emp_group").addClass("active_group");
        $(".progress-bar").css('width', '100%');
    });

    $("#personal_prev_btn").click(function () {
        $("#personal_group").removeClass("active_group");
        $("#account_group").addClass("active_group");
        $(".progress-bar").css('width', '33%');
    });

    //employee group    
    $("#emp_prev_btn").click(function () {
        $("#emp_group").removeClass("active_group");
        $("#personal_group").addClass("active_group");
        $(".progress-bar").css('width', '69%');
    });






});