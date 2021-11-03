<?php

include_once 'dbconn.php';


$patient = $_POST['patient'];
$sql = "SELECT * FROM tbl_patients where patient_id = '".$patient."'";
$result = $conn -> query($sql);


if($result->num_rows>0)
{
    $viewPatient = $result -> fetch_assoc();
   


echo "

<div class='cancel_form_btn_div'>
      <i class='bx bxs-x-circle'></i>
</div>
<div class='form_div'>
    <h2>Medical Certificate Form</h2> 
    <form action='make_med_cert.php' method='POST'>
        
        <label for='patient_fname'>First name:</label><br>
        <input type='text' id='patient_fname' name='patient_fname' value='".$viewPatient['first_name']."' required='required'><br>
        <label for='patient_mname'>Middle Name:</label><br>
        <input type='text' id='patient_mname' name='patient_mname' value='".$viewPatient['middle_name']."' required='required'><br>
        <label for='patient_lname'>Last name:</label><br>
        <input type='text' id='patient_lname' name='patient_lname' value='".$viewPatient['last_name']."' required='required'><br>
        <label for='patient_age'>Age:</label><br>
        <input type='text' id='patient_age' name='patient_age' required='required'><br>
        <label for='patient_address'>Address:</label><br>
        <input type='text' id='patient_address' name='patient_address' value='".$viewPatient['address']."' required='required'><br><br>

        <label for='patient_treatment'>Treatment:</label><br>
        <input type='text' id='patient_treatment' name='patient_treatment' required='required'><br>
        <label for='patient_diagnosis'>Diagnosis:</label><br>
        <textarea id='patient_diagnosis' name='patient_diagnosis' rows=”15″ cols=”40″ required='required'></textarea><br><br>

        <label for='patient_recommendation'>Recommendation/Advise:</label><br>
        <textarea id='patient_recommendation' name='patient_recommendation' rows=”15″ cols=”40″ required='required'></textarea><br><br>
       
        <label for='patient_physician'>Physician (Full Name):</label><br>
        <input type='text' id='patient_physician' name='patient_physician' required='required'><br>
        <label for='patient_physician_license'>Physician License:</label><br>
        <input type='text' id='patient_physician_license' name='patient_physician_license' required='required'><br>
        

        <input type='submit' value='Submit'>
    </form> 
   </div> 
";
}
?>