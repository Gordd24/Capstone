<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patient</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/edit_patient.css">
</head>
<body>
  
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">

        <div class="record_management_div">

            <div class="record_management_edit_div">
                <div class="cancel_add_patient_btn_div">
                   <a href="record_management.php"><i class='bx bxs-x-circle'></i></a>
                </div>
                <div class="edit_patient_form_div">
                    <h2>Edit Patient</h2> 
                    <form class="edit_patient_form" method="POST">
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
                        <label for='patient_birthday'>Birthday:</label><br>
                        <input type='date' id='patient_birthday' name='patient_birthday' required='required'><br>
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