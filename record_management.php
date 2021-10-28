<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Title of the document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/record_management.js"></script>
  <script src="js/NavigationScript.js" type="text/javascript"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/record_management.css">
</head>
<body>

    <?php include_once 'navigation_header.php'; ?>

    <div class="page_content_div">
        <div class="record_management_div">


          <div class="record_management_div_1">
            <div class="patient_search_div">
              <form action="index.php" method="post">
                <input id="patient_search" type="text" name="patient_search" placeholder="patient's name" required= ""><br>
              </form>     
            </div>
            <div class="add_patient_btn_div">
                <button id="add_patient_btn">Add Patient</button>
            </div>
            <div class="patient_table_div">
              <table id="table_patient">
                  <?php include_once 'fetch_Patients.php';?>   
              </table>
            </div>
          </div>

        <div class="record_management_div_2">
                <div class="cancel_add_patient_btn_div">
                  <i class='bx bxs-x-circle'></i>
                </div>
                <div class="add_patient_form_div">

                  <h2>Add New Patient</h2> 

                  <form class="add_patient_form" action="add_patient.php" method="POST">
                    <label for="patient_fname">First Name</label><br>
                    <input id="patient_fname" type="text" name="patient_fname" placeholder="First Name" required= ""><br>
                    <label for="patient_mname">Middle Name</label><br>
                    <input id="patient_mname" type="text" name="patient_mname" placeholder="Middle Name (Optional)"><br>
                    <label for="patient_lname">Last Name</label><br>
                    <input id="patient_lname" type="text" name="patient_lname" placeholder="Last Name" required= ""><br><br>      

                    <p>Sex</p>
                    <input type="radio" id="patient_sex_male" name="patient_sex" value="Male" checked="checked">
                    <label for="html">Male</label>
                    <input type="radio" id="patient_sex_female" name="patient_sex" value="Female">
                    <label for="css">Female</label><br><br>

                    <label for="patient_contact_no">Contact No</label><br>
                    <input id="patient_contact_no" type="text" name="patient_contact_no" placeholder="Contact No. (Optional)"><br>
                    <label for="patient_birthday">Birth Date</label><br>
                    <input id="patient_birthday" type="text" name="patient_birthday" placeholder="Birth Date" required= ""><br>
                    <label for="patient_address">Address</label><br>
                    <input id="patient_address" type="text" name="patient_address" placeholder="Address" required= ""><br>
                    <label for="patient_occupation">Occupation</label><br>
                    <input id="patient_occupation" type="text" name="patient_occupation" placeholder="Occupation (Optional)"><br>
                    <label for="patient_religion">Religion</label><br>
                    <input id="patient_religion" type="text" name="patient_religion" placeholder="Religion (Optional)"><br><br>
                    <input class="button" type="submit" name="addPatientBtn" value="Add Patient">    
                  </form>
                </div>
                
        </div>


      </div>
    </div>
        
      

</body>
</html>