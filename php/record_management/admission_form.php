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
                  <label for='patient_sex_male'>Male</label>
                  <input type='radio' id='patient_sex_female' name='patient_sex' value='Female'>
                  <label for='patient_sex_female'>Female</label><br><br>";
    }
    else{
      $sex = "  <input type='radio' id='patient_sex_male' name='patient_sex' value='Male' >
                  <label for='patient_sex_male'>Male</label>
                  <input type='radio' id='patient_sex_female' name='patient_sex' value='Female' checked='checked'>
                  <label for='patient_sex_female'>Female</label><br><br>";
    }


echo "

<div class='cancel_form_btn_div'>
      <i class='bx bxs-x-circle'></i>
</div>
<div class='form_div'>
    <h2>Admission Form</h2> 
    <form id='admi_form' method='POST'>

     <div class='immutable'>
        <div class='admi_cont patient_id'>
          <label for='patient_id'>Patient ID:</label><br>
          <input type='text' id='patient_id' name='patient_id' value='".$viewPatient['patient_id']."' required='required' readonly><br>
        </div>

        <div class='admi_cont_div name'>
          <div class='admi_cont fname'>
            <label for='patient_fname'>First name:</label><br>
            <input type='text' id='patient_fname' name='patient_fname' value='".$viewPatient['first_name']."'  readonly>
          </div>
          <div class='admi_cont mname'>
            <label for='patient_mname'>Middle name:</label><br>
            <input type='text' id='patient_mname' value='".$viewPatient['middle_name']."' name='patient_mname'  readonly>
          </div>
          <div class='admi_cont lname'>
            <label for='patient_lname'>Last Name:</label><br>
            <input type='text' id='patient_lname' value='".$viewPatient['last_name']."' name='patient_lname'  readonly>
          </div>
        </div>
      </div>

      <div class='mutable'>
        <div class='admi_cont_div age_sex_contact_address'>
            <div class='admi_cont age'>
                <label for='patient_age'>Age: *</label><br>
                <input type='text' id='patient_age' name='patient_age' required='required' autocomplete='off'>
            </div>
            <div class='admi_cont sex'>
                <p>Sex:</p>
                ".$sex."
            </div>
            <div class='admi_cont contact'>
                <label for='patient_contact_no'>Contact No:</label><br>
                <input type='text' id='patient_contact_no' name='patient_contact_no'  value='".$viewPatient['contact_no']."' autocomplete='off'>
            </div>
        </div>
        <div class='admi_cont address'>
                <label for='patient_address'>Address: *</label><br>
                <input type='text' id='patient_address' name='patient_address' value='".$viewPatient['address']."' required='required' autocomplete='off'>
        </div>

        <div class='admi_cont_div room_case'>
            <div class='admi_cont room'>
                <label for='patient_room_no'>Room No:</label><br>
                <input type='text' id='patient_room_no' name='patient_room_no' autocomplete='off'>
            </div>
            <div class='admi_cont case'>
                <label for='patient_case_no'>Case No:</label><br>
                <input type='text' id='patient_case_no' name='patient_case_no' autocomplete='off'>
            </div>
            <div class='admi_cont cs'>
                <label for='patient_cs'>CS:</label><br>
                <input type='text' id='patient_cs' name='patient_cs' autocomplete='off'>
            </div>
        </div>

        <div class='admi_cont_div religion_bday_occupation'>
            <div class='admi_cont religion'>
                <label for='patient_religion'>Religion:</label><br>
                <input type='text' id='patient_religion' name='patient_religion' value='".$viewPatient['religion']."' autocomplete='off'>
            </div>
            <div class='admi_cont bday'>
                <label for='patient_birthday'>Birthday: *</label><br>
                <input type='date' id='patient_birthday' name='patient_birthday' value='".$viewPatient['birthdate']."' required='required' >
            </div>
            <div class='admi_cont occupation'>
                <label for='patient_occupation'>Occupation:</label><br>
                <input type='text' id='patient_occupation' name='patient_occupation' value='".$viewPatient['occupation']."' required='required' autocomplete='off'>
            </div>
        </div>
        
        <div class='admi_cont philhealth'>
            <label for='patient_philhealth_no'>Philhealth No:</label><br>
            <input type='text' id='patient_philhealth_no' name='patient_philhealth_no' autocomplete='off'>
        </div>
        
        <div class='admi_cont_div father_mother'>
            <div class='admi_cont father'>
                <label for='patient_father_name'>Father's Name: *</label><br>
                <input type='text' id='patient_father_name' name='patient_father_name' required='required' autocomplete='off'>
            </div>
            <div class='admi_cont mother'>
                <label for='patient_mother_name'>Mother's Name: *</label><br>
                <input type='text' id='patient_mother_name' name='patient_mother_name' required='required' autocomplete='off'>
            </div>
        </div>
            
        <div class='admi_cont_div spouse'>

            <div class='admi_cont spouse'>
                <label for='patient_spouse_name'>Spouse's Name:</label><br>
                <input type='text' id='patient_spouse_name' name='patient_spouse_name' autocomplete='off'>
            </div>
            <div class='admi_cont date_marriage'>
                <label for='patient_date_of_marriage'>Date Of Marriage:</label><br>
                <input type='date' id='patient_date_of_marriage' name='patient_date_of_marriage' autocomplete='off'>
            </div>
            <div class='admi_cont place_marriage'>
                <label for='patient_place_of_marraige'>Place Of Marriage:</label><br>
                <input type='text' id='patient_place_of_marraige' name='patient_place_of_marriage' autocomplete='off'>
            </div>

        </div>
            
        <div class='admi_cont_div admitted'>
            <div class='admi_cont day'>
                <label for='patient_date_admitted'>Day Admitted: *</label><br>
                <input type='date' id='patient_date_admitted' name='patient_date_admitted' required='required'>
            </div>
            <div class='admi_cont time'>
                <label for='patient_time_admitted'>Time Admitted: *</label><br>
                <input type='time' id='patient_time_admitted' name='patient_time_admitted' required='required' >
            </div>
            <div class='admi_cont admitted_by'>
                <label for='patient_admitted_by'>Admitted By: *</label><br>
                <input type='text' id='patient_admitted_by' name='patient_admitted_by' required='required' autocomplete='off'>
            </div>
        </div>
        
        <div class='admi_cont physician'>
            <label for='patient_physician'>Attending Physician (Full Name): *</label><br>
            <input type='text' id='patient_physician' name='patient_physician' required='required' autocomplete='off'>
        </div>
        <div class='admi_cont diagnosis'>
            <label for='patient_admitting_diagnosis'>Admitting Diagnosis: *</label><br>
            <textarea id='patient_admitting_diagnosis' name='patient_admitting_diagnosis' rows=”15″ cols=”40″ required='required'></textarea>
        </div>
    </div>
        <input type='submit' name='admission_submit' value='Submit'>
    </form> 
   </div> 
";
}
?>