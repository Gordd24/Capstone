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


echo "

<div class='cancel_form_btn_div'>
      <i class='bx bxs-x-circle'></i>
</div>
<div class='form_div'>
    <h2>Admission Form</h2> 
    <form method='POST'>
        <label for='patient_room_no'>Room No:</label><br>
        <input type='text' id='patient_room_no' name='patient_room_no'><br>
        <label for='patient_contact_no'>Contact No (Optional):</label><br>
        <input type='text' id='patient_contact_no' name='patient_contact_no'  value='".$viewPatient['contact_no']."'><br>
        <label for='patient_case_no'>Case No:</label><br>
        <input type='text' id='patient_case_no' name='patient_case_no'><br><br>

        <label for='patient_id'>Patient ID:</label><br>
        <input type='text' id='patient_id' name='patient_id' value='".$viewPatient['patient_id']."' required='required' readonly><br>
        <label for='patient_fname'>First name:</label><br>
        <input type='text' id='patient_fname' name='patient_fname' value='".$viewPatient['first_name']."' readonly><br>
        <label for='patient_mname'>Middle Name:</label><br>
        <input type='text' id='patient_mname' name='patient_mname' value='".$viewPatient['middle_name']."' readonly><br>
        <label for='patient_lname'>Last name:</label><br>
        <input type='text' id='patient_lname' name='patient_lname' value='".$viewPatient['last_name']."' readonly><br><br>

        <label for='patient_age'>Age:</label><br>
        <input type='text' id='patient_age' name='patient_age' required='required'><br>
        <p>Sex:</p>
        ".$sex."
        <label for='patient_address'>Address:</label><br>
        <input type='text' id='patient_address' name='patient_address' value='".$viewPatient['address']."' required='required'><br>
        <label for='patient_cs'>CS:</label><br>
        <input type='text' id='patient_cs' name='patient_cs'><br>
        <label for='patient_religion'>Religion (Optional):</label><br>
        <input type='text' id='patient_religion' name='patient_religion' value='".$viewPatient['religion']."'><br>
        <label for='patient_birthday'>Birthday:</label><br>
        <input type='date' id='patient_birthday' name='patient_birthday' value='".$viewPatient['birthdate']."' required='required'><br>
        <label for='patient_occupation'>Occupation:</label><br>
        <input type='text' id='patient_occupation' name='patient_occupation' value='".$viewPatient['occupation']."' required='required'><br>
        <label for='patient_philhealth_no'>Philhealth No:</label><br>
        <input type='text' id='patient_philhealth_no' name='patient_philhealth_no'><br>
        <label for='patient_father_name'>Father's Name:</label><br>
        <input type='text' id='patient_father_name' name='patient_father_name' required='required'><br>
        <label for='patient_mother_name'>Mother's Name:</label><br>
        <input type='text' id='patient_mother_name' name='patient_mother_name' required='required'><br>
        <label for='patient_spouse_name'>Spouse's Name (Optional):</label><br>
        <input type='text' id='patient_spouse_name' name='patient_spouse_name'><br>
        <label for='patient_date_of_marriage'>Date Of Marriage (Optional):</label><br>
        <input type='date' id='patient_date_of_marriage' name='patient_date_of_marriage' required='required'><br>
        <label for='patient_place_of_marraige'>Place Of Marriage (Optional):</label><br>
        <input type='text' id='patient_place_of_marraige' name='patient_place_of_marriage'><br><br>

        <label for='patient_date_admitted'>Day Admitted:</label><br>
        <input type='date' id='patient_date_admitted' name='patient_date_admitted' required='required'><br>
        <label for='patient_time_admitted'>Time Admitted:</label><br>
        <input type='time' id='patient_time_admitted' name='patient_time_admitted' required='required'><br>
        <label for='patient_admitted_by'>Admitted By:</label><br>
        <input type='text' id='patient_admitted_by' name='patient_admitted_by' required='required'><br><br>
       
        <label for='patient_physician'>Attending Physician (Full Name):</label><br>
        <input type='text' id='patient_physician' name='patient_physician' required='required'><br>
        <label for='patient_admitting_diagnosis'>Admitting Diagnosis:</label><br>
        <textarea id='patient_admitting_diagnosis' name='patient_admitting_diagnosis' rows=”15″ cols=”40″ required='required'></textarea><br><br>

        <input type='submit' name='admission_submit' value='Submit'>
    </form> 
   </div> 
";
}
?>