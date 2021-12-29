<?php

include_once '../dbconn.php';


if(isset($_GET['id']))
{

    $patient_id = $_GET['id'];
    rename("../../archive/".$patient_id,"../../patient/".$patient_id);

    $stmt = $connection->prepare("UPDATE tbl_patients SET record_status = 'Active' WHERE patient_id = ?;");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("s", $patient_id); 

    $stmt->execute();
    header('Location: ../patients_record_archive/patients_archive.php');
}

else{
    header('Location: ../patients_record_archive/patients_archive.php');
}



?>