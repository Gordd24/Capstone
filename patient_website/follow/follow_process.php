<?php
session_start();
include_once '../dbconn.php';
date_default_timezone_set('Asia/Manila');

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){

    header("Location: ../../index.php");
  }
  if(isset($_SESSION['ID'])){
  
    header("Location: ../../index.php");
  }



if(isset($_POST['follow'])){

    if( isset($_POST['results']) && is_array($_POST['results']) ) {
        foreach($_POST['results'] as $results) {
            
            $stmt = $connection->prepare("INSERT INTO tbl_requests(patient_id, result_type, request_date, request_time, request_status) VALUES (?, ?, ?, ?, ?)");
    
            /* Prepared statement, stage 2: bind and execute */

            $id = $_SESSION['PATIENT_ID'];
            $result_type = $results;
            $today = date("Y-m-d"); 
            $time = date("H:i:s");
            $request_status = 'sent';
            $stmt->bind_param("issss", $id, $result_type, $today, $time, $request_status); 
            
            $stmt->execute();     

            header("Location: patient_follow.php");


        }

    }

}


?>