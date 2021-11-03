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
    <h2>Laboratory Result</h2> 
    <form action='make_lab_res.php'>
    <label id='lab_res_up_button' for='patient_lab_res'> <i class='bx bx-test-tube'></i> Upload File</label>
    <input type='file' id='patient_lab_res' name='patient_lab_res'><br>
    
    <input type='submit' id='lab_res_upload' value='Submit'>
    </form>
</div>";

}
?>