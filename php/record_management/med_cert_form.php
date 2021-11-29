<?php

include_once '../dbconn.php';


$patient = $_POST['patient'];
$sql = "SELECT * FROM tbl_patients where patient_id = '".$patient."'";
$result = $conn -> query($sql);



if($result->num_rows>0)
{
    $viewPatient = $result -> fetch_assoc();

    
    if($viewPatient['sex']=="Male")
    { 
        $sex = "  <input type='radio' id='patient_sex_male' name='patient_sex' value='Male' checked='checked'>
                  <label for='html'>Male</label>
                  <input type='radio' id='patient_sex_female' name='patient_sex' value='Female'>
                  <label for='css'>Female</label><br><br>";
    }
    else{
      $sex = "  <input type='radio' id='patient_sex_male' name='patient_sex' value='Male' >
                  <label for='html'>Male</label>
                  <input type='radio' id='patient_sex_female' name='patient_sex' value='Female' checked='checked'>
                  <label for='css'>Female</label><br><br>";
    }


echo "

<div class='cancel_form_btn_div'>
      <i class='bx bxs-x-circle'></i>
</div>
<div class='form_div'>
    <h2>Medical Certificate Form</h2> 
    <form id='med_cert_form' method='POST'>

        <div class='immutable'>
            <div class='med_cont patient_id'>
            <label for='patient_id'>Patient ID:</label><br>
            <input type='text' id='patient_id' name='patient_id' value='".$viewPatient['patient_id']."' required='required' readonly><br>
            </div>

            <div class='med_cont_div name'>
                <div class='med_cont fname'>
                    <label for='patient_fname'>First name:</label><br>
                    <input type='text' id='patient_fname' name='patient_fname' value='".$viewPatient['first_name']."'  readonly>
                </div>
                <div class='med_cont mname'>
                    <label for='patient_mname'>Middle name:</label><br>
                    <input type='text' id='patient_mname' value='".$viewPatient['middle_name']."' name='patient_mname'  readonly>
                </div>
                <div class='med_cont lname'>
                    <label for='patient_lname'>Last Name:</label><br>
                    <input type='text' id='patient_lname' value='".$viewPatient['last_name']."' name='patient_lname'  readonly>
                </div>
            </div>
        </div>

        <div class='mutable'>
            <div class='med_cont_div age_sex'>
                <div class='med_cont age'>
                    <label for='patient_age'>Age:</label><br>
                    <input type='text' id='patient_age' name='patient_age' required='required'>
                </div>
                <div class='med_cont sex'>
                    <p>Sex</p>
                    ".$sex."
                </div>
            </div>

            <div class='med_cont address'>
                <label for='patient_address'>Address:</label><br>
                <input type='text' id='patient_address' name='patient_address' value='".$viewPatient['address']."' required='required'>
            </div>

            <div class='med_cont diagnosis'>
                <label for='patient_diagnosis'>Diagnosis:</label><br>
                <textarea id='patient_diagnosis' name='patient_diagnosis' rows=”15″ cols=”40″ required='required'></textarea>
            </div>

            <div class='med_cont recommendation'>
                <label for='patient_recommendation'>Recommendation/Advise:</label><br>
                <textarea id='patient_recommendation' name='patient_recommendation' rows=”15″ cols=”40″ required='required'></textarea>
            </div>

            <div class='med_cont_div physician'>
                <div class='med_cont physician'>
                    <label for='patient_physician'>Physician (Full Name):</label><br>
                    <input type='text' id='patient_physician' name='patient_physician' required='required'>
                </div>
                <div class='med_cont license'>
                    <label for='patient_physician_license'>Physician License:</label><br>
                    <input type='text' id='patient_physician_license' name='patient_physician_license' required='required'>
                </div>
            </div>
        </div>

        <input type='submit' name='med_cert_submit' value='Submit'>
    </form> 
   </div> 
";
}
?>