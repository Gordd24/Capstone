<?php

include_once 'dbconn.php';
$viewed = $_POST['view'];
$sql = "SELECT * FROM tbl_patients where patient_id = '".$viewed."';";
$result = $conn -> query($sql);

if($result->num_rows>0)
{
   while($row = $result -> fetch_assoc())
   {
        echo"
        <div class='cancel_view_patient_btn_div'>
        <i class='bx bxs-x-circle'></i>
        </div>
        <div class='patient_info'>
            <span>Patient ID: ".$row['patient_id']."</span><br>
            <span>Patient Name: ".$row['first_name']." ".$row['middle_name']." ".$row['last_name']."</span>
            <i class='bx bxs-edit'></i>
        </div>

        <div class='tab'>
        <button class='tablinks' id='admition_btn'><i class='bx bxs-user-check'></i> Admition</button>
        <button class='tablinks' id='consultation_btn'><i class='bx bx-notepad' ></i> Consultation</button>
        <button class='tablinks' id='med_cert_btn'><i class='bx bxs-certification' ></i> Medical Certificate</button>
        <button class='tablinks' id='lab_res_btn'><i class='bx bx-test-tube' ></i> Laboratory Results</button>
        </div> 
        
        <div class='admition_div'>Admition ".$row['patient_id']."</div>
        <div class='consultation_div'>Consultation ".$row['patient_id']."</div>
        <div class='med_cert_div'>Medical Certificate ".$row['patient_id']."</div>
        <div class='lab_res_div'>Laboratory Results ".$row['patient_id']."</div>";

   }
} 


           


?>