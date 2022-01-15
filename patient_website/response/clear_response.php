<?php

session_start();

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}

include_once '../dbconn.php';

$stmt = $connection->prepare("DELETE FROM tbl_responses WHERE patient_id = ? and view_status = 'viewed'");
$stmt->bind_param("s", $_SESSION['PATIENT_ID']);
$stmt->execute();

header("Location: response.php");

?>