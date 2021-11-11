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
    <h2>Discharge Patient</h2> 

    <h3>Patient: ".$viewPatient['first_name']." ".$viewPatient['middle_name']." ".$viewPatient['last_name']."</h3>

    <form method='POST'>
    <label for='patient_id'>Patient ID:</label><br>
    <input type='text' id='patient_id' name='patient_id' value='".$viewPatient['patient_id']."' required='required' readonly><br><br>
    
    <label for='patient_date_discharged'>Date Discharged:</label><br>
    <input type='date' id='patient_date_discharged' name='patient_date_discharged' required='required'><br>
    <label for='patient_time_discharged'>Time Discharged:</label><br>
    <input type='time' id='patient_time_discharged' name='patient_time_discharged' required='required'><br>
    <label for='patient_discharged_by'>Discharged By:</label><br>
    <input type='text' id='patient_discharged_by' name='patient_discharged_by'><br><br>
    <label for='patient_transferred_to_room'>Transferred to Room (Optional):</label><br>
    <input type='text' id='patient_transferred_to_room' name='patient_transferred_to_room'><br>
    <label for='patient_transferred_to_room_date'>Date (Optional):</label><br>
    <input type='date' id='patient_transferred_to_room_date' name='patient_transferred_to_room_date'><br>
    <label for='patient_transferred_to_room_time'>Time (Optional):</label><br>
    <input type='time' id='patient_transferred_to_room_time' name='patient_transferred_to_room_time'><br><br>

    <label for='patient_final_diagnosis'>Final Diagnosis:</label><br>
    <textarea id='patient_final_diagnosis' name='patient_final_diagnosis' rows=”15″ cols=”40″ required='required'></textarea><br><br> 
    <label for='patient_ICD_10_code'>ICD 10 CODE:</label><br>
    <input type='text' id='patient_ICD_10_code' name='patient_ICD_10_code' required='required'><br>
    <label for='patient_rvs_code'>RVS CODE:</label><br>
    <input type='text' id='patient_rvs_code' name='patient_rvs_code' required='required'><br>
    <label for='patient_operations'>Operations:</label><br>
    <textarea id='patient_operations' name='patient_operations' rows=”15″ cols=”40″ required='required'></textarea><br><br>

    <p>DISPOSITION:</p>
    <input type='radio' id='patient_discharged' name='patient_disposition' value='DISCHARGED' checked='checked'>
    <label for='patinet_discharged'>Discharged</label><br>
    <input type='radio' id='patient_transferred' name='patient_disposition' value='TRANSFERRED'>
    <label for='patient_transferred'>Transferred</label><br>  
    <input type='radio' id='patient_hama' name='patient_disposition' value='HAMA'>
    <label for='patient_hama'>HAMA</label><br>
    <input type='radio' id='patient_absconded' name='patient_disposition' value='ABSCONDED'>
    <label for='patient_absconded'>Absconded</label><br>
    <input type='radio' id='patient_died' name='patient_disposition' value='DIED'>
    <label for='patient_died'>Died</label><br><br>


  <input type='submit' name='discharged_submit' value='Submit'>
  
    </form> 
   </div> 
";
}
?>