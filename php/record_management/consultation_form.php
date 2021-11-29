<?php


include_once '../dbconn.php';


$patient = $_POST['patient'];
$sql = "SELECT * FROM tbl_patients where patient_id = '".$patient."'";
$result = $conn -> query($sql);

if($result->num_rows>0)
{
    $viewPatient = $result -> fetch_assoc();
    $sex = "";
   
        

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

    echo   "
    <div class='cancel_form_btn_div'>
      <i class='bx bxs-x-circle'></i>
    </div>
    <div class='form_div'>
      <h2>Consultation Form</h2> 
      <form id='cons_form' method='POST'>
        <div class='immutable'>
          <div class='cons_cont patient_id'>
            <label for='patient_id'>Patient ID:</label><br>
            <input type='text' id='patient_id' name='patient_id' value='".$viewPatient['patient_id']."' required='required' readonly>
          </div>

          <div class='cons_cont_div name'>
            <div class='cons_cont fname'>
              <label for='patient_fname'>First name:</label><br>
              <input type='text' id='patient_fname' name='patient_fname' value='".$viewPatient['first_name']."'  readonly>
            </div>
            <div class='cons_cont mname'>
              <label for='patient_mname'>Middle name:</label><br>
              <input type='text' id='patient_mname' value='".$viewPatient['middle_name']."' name='patient_mname'  readonly>
            </div>
            <div class='cons_cont lname'>
              <label for='patient_lname'>Last Name:</label><br>
              <input type='text' id='patient_lname' value='".$viewPatient['last_name']."' name='patient_lname'  readonly>
            </div>
          </div>
        </div>
        
        <div class='mutable'>
          <div class='cons_cont_div age_sex_bday'>
            <div class='cons_cont age'>
              <label for='patient_age'>Age:</label><br>
              <input type='text' id='patient_age' name='patient_age' required='required'>
            </div>
            <div class='cons_cont sex'>
              <p>Sex</p>
              ".$sex."
            </div>
            <div class='cons_cont bday'>
              <label for='patient_birthday'>Birthday:</label><br>
              <input type='date' id='patient_birthday' name='patient_birthday' value='".$viewPatient['birthdate']."' required='required'>
            </div>
          </div>

          <div class='cons_cont_div address_contact'>
            <div class='cons_cont address'>
              <label for='patient_address'>Address:</label><br>
              <input type='text' id='patient_address' name='patient_address' value='".$viewPatient['address']."' required='required'><br>
            </div>
            <div class='cons_cont contact'>
              <label for='patient_contact_no'>Contact No:</label><br>
              <input type='text' id='patient_contact_no' value='".$viewPatient['contact_no']."' name='patient_contact_no'>
            </div>
          </div>
        
          <div class='cons_cont complaint'>
            <label for='patient_complaint'>Chief Complaint:</label><br>
            <textarea id='patient_complaint' name='patient_complaint' rows=”15″ cols=”40″></textarea>
          </div>

          <div class='cons_cont_div vitals'>
            <div class='cons_cont vital_sign'>
              <label for='patient_weight'>Weight:</label><br>
              <input type='text' id='patient_weight' name='patient_weight'><br>
              <label for='patient_bp'>BP:</label><br>
              <input type='text' id='patient_bp' name='patient_bp'><br>
              <label for='patient_temp'>Temp:</label><br>
              <input type='text' id='patient_temp' name='patient_temp'><br>
              <label for='patient_rr'>RR:</label><br>
              <input type='text' id='patient_rr' name='patient_rr'><br>
              <label for='patient_pr'>PR:</label><br>
              <input type='text' id='patient_pr' name='patient_pr'>
            </div>
          
            <div class='cons_cont ob_patient'>
              <p>For OB Patient</p>
              <label for='patient_lmp'>LMP:</label><br>
              <input type='text' id='patient_lmp' name='patient_lmp'><br>
              <label for='patient_aog'>AOG:</label><br>
              <input type='text' id='patient_aog' name='patient_aog'><br>
              <label for='patient_edc'>EDC:</label><br>
              <input type='text' id='patient_edc' name='patient_edc'>
            </div>
          </div>
        </div>

      
        <input type='submit' value='Submit' name='consultation_submit'>
      </form> 
    </div>";
}

?>
