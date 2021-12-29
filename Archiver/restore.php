<?php

include_once '../dbconn.php';


if(isset($_GET['id']))
{

    $patient_id = $_GET['id'];
    rename("../../archive/".$patient_id,"../../patient/".$patient_id);


    //set record status
    $updateStat = "UPDATE tbl_patients SET record_status = 'Active' WHERE patient_id = '".$patient_id."';";
    mysqli_query($conn,$updateStat);
    header('Location: patients_archive.php');
}

else{
    header('Location: patients_archive.php');
}



?>