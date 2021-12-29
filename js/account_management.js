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
            confirmButtonText: 'Yes'
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

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    //account group
    $("#account_next_btn").click(function () {
        uname = $('#username').val()
        email = $('#email').val()
        pword = $('#password').val()
        cpword = $('#confirm_password').val()
        if (uname != '' && email != '' && pword != '' && cpword != '') {
            if (isEmail(email) == true) {
                if (pword == cpword) {
                    console.log('asdad')
                    $("#account_group").removeClass("active_group");
                    $("#personal_group").addClass("active_group");
                    $(".progress-bar").css('width', '69%');
                } else {
                    Swal.fire('Error!', 'Password did not match.', 'error')
                }
            } else {
                Swal.fire('Error!', 'Please use a valid email', 'error')
            }

        }
        else {
            Swal.fire('Error!', 'Please fill up all fields.', 'error')
        }
    })
    // $('.account-inputs').on('blur', function () {

    //     uname=$('#username').val()
    //     email=$('#email').val()
    //     pword=$('#password').val()
    //     cpword=$('#confirm_password').val()

    //         // account group   
    //         $("#account_next_btn").click(function () {    
    //             if(uname!='' && email!='' && pword!='' && cpword!=''){
    //                 console.log(uname)
    //                 console.log(email)
    //                 console.log(pword)
    //                 console.log(cpword)
    //                 if(pword==cpword){
    //                     console.log('asdad')
    //                     $("#account_group").removeClass("active_group");
    //                     $("#personal_group").addClass("active_group");
    //                     $(".progress-bar").css('width', '69%');
    //                 }else{
    //                     alert('password did not match.')
    //                 }
    //             }
    //             else{
    //                 alert('Please fill up all fields.')
    //             }
    //         }); 
    // })
    //personal group
    $("#personal_next_btn").click(function () {
        console.log('hellow')
        fname = $('#first_name').val()
        mname = $('#middle_name').val()
        lname = $('#last_name').val()

        if (fname != '' && lname != '') {
            $("#personal_group").removeClass("active_group");
            $("#emp_group").addClass("active_group");
            $(".progress-bar").css('width', '100%');
        } else {
            Swal.fire('Error!', 'Please fill up all the required fields.', 'error')
        }
    });

    $("#personal_prev_btn").click(function () {
        $("#personal_group").removeClass("active_group");
        $("#account_group").addClass("active_group");
        $(".progress-bar").css('width', '33%');
    });

    //employee group
    $("#regform").on('submit',function (e) {   
        emp_id = $('#empi_id').val()
        if(emp_id==''){
            Swal.fire('Error!','Please fill up all the required fields.','error')
            e.preventDefault()
        }
    }) 
    $("#emp_prev_btn").click(function () {
        $("#emp_group").removeClass("active_group");
        $("#personal_group").addClass("active_group");
        $(".progress-bar").css('width', '69%');
    });

});