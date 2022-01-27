function logout(){
    Swal.fire({
        title: 'Logout',
        text: "Do you want to logout?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../sign_out/sign_out.php",
                success: function (response) {
                    location.href = "../../index.php"
                }
            });
            
        }
      })
}