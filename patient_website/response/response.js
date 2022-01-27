function clear_response(){
    Swal.fire({
        title: 'Warning!',
        text: "Do you want to clear the responses?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "clear_response.php",
                success: function (response) {
                    location.reload()
                }
            });
            
        }
      })
}