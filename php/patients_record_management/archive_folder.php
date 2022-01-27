<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
include_once '../dbconn.php';


if(isset($_GET['id']))
{

    $patient_id = $_GET['id'];
    rename("../../patient/".$patient_id, "../../archive/".$patient_id);

    $stmt = $connection->prepare("UPDATE tbl_patients SET record_status = 'Archive' WHERE patient_id = ?;");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("s", $patient_id); 

    $stmt->execute();
    header('Location: patients_records.php');
}
else{
    header('Location: patients_records.php');
}



?>