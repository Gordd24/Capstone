<?php

include_once '../dbconn.php';


if(isset($_GET['id']))
{

    $patient_id = $_GET['id'];
    rename("../../patient/".$patient_id, "../../archive/".$patient_id);



    //set record status
    $updateStat = "UPDATE tbl_patients SET record_status = 'Archive' WHERE patient_id = '".$patient_id."';";
    mysqli_query($conn,$updateStat);
    header('Location: patients_records.php');
}
else{
    header('Location: patients_records.php');
}



?>