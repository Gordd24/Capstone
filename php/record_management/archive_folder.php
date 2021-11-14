<?php

include_once '../dbconn.php';


if(isset($_GET['id']))
{

    $patient_id = base64_decode(base64_decode($_GET['id']));
    rename("../../patient/".$patient_id, "../../archive/".$patient_id);



    //set record status
    $updateStat = "UPDATE tbl_patients SET record_status = 'Archive' WHERE patient_id = '".$patient_id."';";
    mysqli_query($conn,$updateStat);
    header('Location: record_management.php');
}
else{
    header('Location: record_management.php');
}



?>