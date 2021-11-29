<?php
include_once '../dbconn.php';
if(isset($_POST['addPatientBtn'])){

     //post inputs
    $patient_fname = $_POST['patient_fname'];
    $patient_mname = $_POST['patient_mname'];
    $patient_lname = $_POST['patient_lname'];
    $patient_sex = $_POST['patient_sex'];
    $patient_contact_no = $_POST['patient_contact_no'];
    $patient_birthday = $_POST['patient_birthday'];
    $patient_address = $_POST['patient_address'];
    $patient_occupation = $_POST['patient_occupation'];
    $patient_religion = $_POST['patient_religion'];
    $errorExist = "";

    //if user exists
    $patientSql = "SELECT * FROM tbl_patients WHERE first_name = '".$patient_fname."' AND last_name = '".$patient_lname."';";
    $result = mysqli_query($conn,$patientSql);
    $patientExist = mysqli_num_rows($result);

    if($patientExist>0){
      $errorPatient = "Patient Already Have a Record";
      $errorExist .= $errorPatient;
      echo '<script type="text/javascript"></script>';
      echo 'alert("Patient already have a record")';
      echo '</script>';
    }
   

    if(empty($errorExist)){
    $insertSql = "INSERT INTO tbl_patients(first_name,middle_name,last_name,contact_no,sex,religion,address,birthdate,occupation,status,record_status) VALUES ('$patient_fname','$patient_mname','$patient_lname','$patient_contact_no','$patient_sex','$patient_religion','$patient_address','$patient_birthday','$patient_occupation','Not Admitted','Active');";
    mysqli_query($conn,$insertSql);
    header("Location: record_management.php");

    }
}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Patient</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/add_patient.js"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/add_patient.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
  
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">
        
        
        <div class="record_management_div">

        <div class="add_patient_div">
                <div class="cancel_add_patient_btn_div">
                  <i class='bx bxs-x-circle'></i>
                  <h2>Add New Patient</h2> 
                </div>
                <div class="add_patient_form_div">
                
                  <form class="add_patient_form" method="POST" id="add_patient_form">
                    <div class="name_sex_bday">

                      <div class="name">
                        <label for="patient_fname">First Name</label><br>
                        <input id="patient_fname" type="text" name="patient_fname" placeholder="First Name" required= "" autocomplete="off"><br>
                        <label for="patient_mname">Middle Name (Optional)</label><br>
                        <input id="patient_mname" type="text" name="patient_mname" placeholder="Middle Name" autocomplete="off"><br>
                        <label for="patient_lname">Last Name</label><br>
                        <input id="patient_lname" type="text" name="patient_lname" placeholder="Last Name" required= "" autocomplete="off">     
                      </div>
                      
                      <div class="sex_bday">
                        <p>Sex</p>
                        <input type="radio" id="patient_sex_male" name="patient_sex" value="Male" checked="checked">
                        <label for="html">Male</label>
                        <input type="radio" id="patient_sex_female" name="patient_sex" value="Female">
                        <label for="css">Female</label><br><br>
                        <label for='patient_birthday'>Birthday:</label><br>
                        <input type='date' id='patient_birthday' name='patient_birthday' required='required'><br>
                      </div>

                    </div>
                    

                    <div class="contact_address_occupation_religion">

                      <div class="contact_address">
                        <label for="patient_contact_no">Contact No (Optional)</label><br>
                        <input id="patient_contact_no" type="text" name="patient_contact_no" placeholder="Contact No." autocomplete="off"><br>
                        <label for="patient_address">Address</label><br>
                        <input id="patient_address" type="text" name="patient_address" placeholder="Address" required= "" autocomplete="off"><br>
                      </div>
                      
                      <div class="occupation_religion">
                        <label for="patient_occupation">Occupation (Optional)</label><br>
                        <input id="patient_occupation" type="text" name="patient_occupation" placeholder="Occupation" autocomplete="off"><br>
                        <label for="patient_religion">Religion (Optional)</label><br>
                        <input id="patient_religion" type="text" name="patient_religion" placeholder="Religion" autocomplete="off"><br><br>
                        <input class="button" type="submit" name="addPatientBtn" value="Add Patient">  
                      </div>

                    </div>
                     
                  </form>
                </div>
                
        </div>

      </div>
    </div>
        
      

</body>
</html>

