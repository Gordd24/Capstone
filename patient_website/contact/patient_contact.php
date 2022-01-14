<?php

session_start();

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact</title>
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="patient_contact.css">
  <link rel="stylesheet" href="../nav/patient_header.css">
   <!-- boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../nav/patient_header.js"></script>
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

    <div class="row">
      <div class="col">

        <!-- name row -->
        <div class="row justify-content-center">
              <div class="col-12 col-sm-6 border rounded my-5 p-2" id="edit_name_div">
                 
                    <div class="row mb-3 justify-content-center">
                          <div class="col text-center">
                            <h3>Hospital's Contact Information</h3>
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col">
                              <label for="email" class="form-label"><i class='bx bx-envelope'></i> Email</label>
                              <input type="text" class="form-control edit_name" id="email" name="email"  value="olmmgh@gmail.com" required readonly autocomplete="off">
                          </div>
                      </div>

                      <div class="row mb-3 px-3  justify-content-center">
                          <div class="col">
                              <label for="contact_no" class="form-label"><i class='bx bx-phone' ></i> Contact No.</label>
                              <input type="text" class="form-control edit_name" id="contact_no" name="contact_no"  value="+63 9089899291" readonly autocomplete="off">
                          </div>
                      </div>
              </div>
          </div>    
          <!-- name row end -->

      </div>
    </div>


                                        

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







