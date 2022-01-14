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
  <title>About</title>
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="about.css">
  <link rel="stylesheet" href="../nav/patient_header.css">
   <!-- boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../nav/patient_header.js"></script>
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

    <div class="row my-3">
      <div class="col">

            <!-- mission -->
            <div class="row justify-content-center m-3">
              <div class="col-12 col-sm-6 p-2" id="edit_name_div">
                 
                      <div class="row mb-3 justify-content-center">
                          <div class="col text-center">
                            <h3>Mission</h3>
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col fs-5 text">
                            Our mission is to provide the quality of health care through our roster of complete medical staff and state of the art equipment
                          </div>
                      </div>
              </div>
          </div>    
          <!-- mission end -->

          <!-- vision -->
          <div class="row justify-content-center m-3">
              <div class="col-12 col-sm-6 p-2" id="edit_name_div">
                 
                      <div class="row mb-3 justify-content-center">
                          <div class="col text-center">
                            <h3>Vision</h3>
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col fs-5 text">
                          We envision the hospital to be the best in the field of medical service for all patients at all times. 
                          And it will be an institution that is conductive to the rapid recovery of patients and a venue for physicians 
                          to practice the most up to date medical science
                          </div>
                      </div>
              </div>
          </div>    
          <!--Vision end -->


          <!-- Background -->
          <div class="row justify-content-center m-3">
              <div class="col-12 col-sm-6 p-2" id="edit_name_div">
                 
                      <div class="row mb-3 justify-content-center">
                          <div class="col text-center">
                            <h3>Background</h3>
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col fs-5 text" id="text">
                          Dr. Ofelia L. Mendoza founded the Ofelia L. Mendoza Maternity and General Hospital on October 15, 2002. 
                          Dr. Mendoza began her professional career at a small clinic near her home before establishing a hospital. 
                          After a year, Dr. Mendoza and her husband developed a full hospital facility at Mojon, City of Malolos, Bulacan. 
                          The hospital has been operating at a high level of excellence for exactly 19 years, they provide the quality of 
                          health care through their medical staff and being progressive and competitive institution for health in 
                          Bulacan and currently, they have an additional hospital facility in Liang, Malolos City, Bulacan.
                          </div>
                      </div>
              </div>
          </div>    
          <!-- Background end -->


          <!-- Background -->
          <div class="row justify-content-center m-3">
              <div class="col-12 col-sm-6 p-2" id="edit_name_div">
                 
                      <div class="row mb-3 justify-content-center">
                          <div class="col text-center">
                            <h3>Goals</h3>
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col fs-5 text">
                          To be a progressive and competitive institution for health in Bulacan
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col fs-5 text">
                          To be industry standard in the community for service, health care and ethics.
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col fs-5 text">
                          To lead the industry in professionalism, facilities, and service.
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col fs-5 text">
                          To be professional and dynamic organization involved in providing health care.
                          </div>
                      </div>
              </div>
          </div>    
          <!-- Background end -->
          
          

        <!-- name row -->
        <div class="row justify-content-center m-4">
              <div class="col-12 col-sm-6 border rounded p-2" id="edit_name_div">
                 
                    <div class="row mb-3 justify-content-center">
                          <div class="col text-center">
                            <h3>Hospital's Contact Information</h3>
                          </div>
                      </div>
                      <div class="row mb-3 px-3 justify-content-center">
                          <div class="col">
                              <label for="email" class="form-label"><i class='bx bx-envelope'></i> Email</label>
                              <input type="text" class="form-control edit_name" id="email" name="email"  value="olmmgh@yahoo.com" required readonly autocomplete="off">
                          </div>
                      </div>

                      <div class="row mb-3 px-3  justify-content-center">
                          <div class="col">
                              <label for="contact_no" class="form-label"><i class='bx bx-phone' ></i> Contact No.</label>
                              <input type="text" class="form-control edit_name" id="contact_no" name="contact_no"  value="(044) 794-7113" readonly autocomplete="off">
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







