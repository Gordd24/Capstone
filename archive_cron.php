<?php

include_once 'php/dbconn.php';



 //post INPUTS FROM FORM FIELDS
//  $username = $_POST['username'];
//  $password = $_POST['password'];
//  $confirm_password = $_POST['confirm_password'];
//  $first_name = $_POST['first_name'];
//  $middle_name = $_POST['middle_name'];
//  $last_name = $_POST['last_name'];
//  $email = $_POST['email'];
//  $emp_id = $_POST['emp_id'];
//  $position = $_POST['position'];

//  $hashedP = password_hash($password, PASSWORD_DEFAULT);

// date_default_timezone_set('Asia/Manila');
// $today = date("Y-m-d"); 
// $time = date("H:i:s");


// DUMMY INPUT , pedeng tangalin once na connected na sa system
$username = "admin06";
$password = "admin06";
$first_name = "Dumbo";
$middle_name = "";
$last_name = "Hotdog";
$email = "dindough@gmail.com";
$emp_id = "7846";
$position = "Administrator";

$hashedP = password_hash($password, PASSWORD_DEFAULT);

date_default_timezone_set('Asia/Manila');
$today = date("Y-m-d"); 
$time = date("H:i:s");
// END OF DUMMY INPUT

/* Prepared statement, stage 1: prepare */
$stmt = $connection->prepare("INSERT INTO tbl_accounts(username, password, first_name, middle_name, last_name, email, emp_id, position,date_created,time_created) VALUES 
(?,?,?,?,?,?,?,?,?,?)");

/* Prepared statement, stage 2: bind and execute */
$stmt->bind_param("ssssssssss", $username, $hashedP, $first_name, $middle_name, $last_name, $email, $emp_id, $position, $today, $time); // "is" means that $id is bound as an integer and $label as a string

$stmt->execute();


?>