<?php

include_once '../dbconn.php';


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
    <h2>Laboratory Result</h2> 


    <form method='POST' enctype='multipart/form-data'>
    <label for='patient_id'>Patient ID:</label><br>
    <input type='text' id='patient_id' name='patient_id' value='".$viewPatient['patient_id']."' required='required' readonly><br>
    <label for='patient_fname'>First name:</label><br>
    <input type='text' id='patient_fname' name='patient_fname' value='".$viewPatient['first_name']."' readonly><br>
    <label for='patient_mname'>Middle Name:</label><br>
    <input type='text' id='patient_mname' name='patient_mname' value='".$viewPatient['middle_name']."' readonly><br>
    <label for='patient_lname'>Last name:</label><br>
    <input type='text' id='patient_lname' name='patient_lname' value='".$viewPatient['last_name']."'  readonly><br><br>
    <label id='lab_res_up_button' for='patient_lab_res'> <i class='bx bx-test-tube'></i> Upload File</label>
    <input type='file' id='patient_lab_res' name='patient_lab_res' multiple><br>
    <button type='submit' id='lab_res_upload' name='lab_res_upload'>Submit</button>
    </form>
</div>";

}
?>