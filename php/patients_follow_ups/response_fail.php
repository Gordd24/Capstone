<?php

session_start();

if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

include_once '../dbconn.php';
date_default_timezone_set('Asia/Manila');

if(isset($_GET['id'])){
/* Prepared statement, stage 1: prepare */

$idarr = preg_split("/[\s_]+/", $_GET['id']); 
$patient_id = $idarr[0];
$request_id = $idarr[1];
$response_status = 'not available';
$today = date("Y-m-d"); 
$time = date("H:i:s");
$request_status = "responded";
$view_status = "sent";

$stmt = $connection->prepare("INSERT INTO tbl_responses(patient_id, request_id, response_status, view_status, response_date, response_time) VALUES (?, ?, ?, ?, ?, ?)");

/* Prepared statement, stage 2: bind and execute */
$stmt->bind_param("ssssss",$patient_id, $request_id, $response_status, $view_status, $today, $time);
$stmt->execute();

/* Prepared statement, stage 1: prepare */
$request_stmt = $connection->prepare("UPDATE tbl_requests SET request_status = ? WHERE request_id = ?");


$request_stmt->bind_param("ss",$request_status, $request_id);
$request_stmt->execute();

header("Location: patients_follow_ups.php");

}

?>