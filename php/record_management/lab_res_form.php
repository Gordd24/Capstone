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

    <div class='immutable'>
            <div class='lab_cont patient_id'>
            <label for='patient_id'>Patient ID:</label><br>
            <input type='text' id='patient_id' name='patient_id' value='".$viewPatient['patient_id']."' required='required' readonly><br>
            </div>

            <div class='lab_cont_div name'>
                <div class='lab_cont fname'>
                    <label for='patient_fname'>First name:</label><br>
                    <input type='text' id='patient_fname' name='patient_fname' value='".$viewPatient['first_name']."'  readonly>
                </div>
                <div class='lab_cont mname'>
                    <label for='patient_mname'>Middle name:</label><br>
                    <input type='text' id='patient_mname' value='".$viewPatient['middle_name']."' name='patient_mname'  readonly>
                </div>
                <div class='lab_cont lname'>
                    <label for='patient_lname'>Last Name:</label><br>
                    <input type='text' id='patient_lname' value='".$viewPatient['last_name']."' name='patient_lname'  readonly>
                </div>
            </div>
    </div>
    
    <div class='mutable'>
        <div class='lab_cont file'>
            <label id='lab_res_up_button' for='patient_lab_res'> <i class='bx bx-test-tube'></i> Upload File</label>
            <input type='file' id='patient_lab_res' name='patient_lab_res' multiple><br>
        </div>
    </div>
    <button type='submit' id='lab_res_upload' name='lab_res_upload'>Submit</button>
    </form>
</div>";

}
?>