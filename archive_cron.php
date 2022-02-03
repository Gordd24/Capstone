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
$username = "admin01";
$password = "admin01";
$first_name = "John Mark";
$middle_name = "";
$last_name = "Almera";
$email = "almera.johnmark.a.7351@gmail.com";
$emp_id = "0001";
$position = "Administrator";
$auto_id = "0002";

$hashedP = password_hash($password, PASSWORD_DEFAULT);

date_default_timezone_set('Asia/Manila');
$today = date("Y-m-d"); 
$time = date("H:i:s");
// END OF DUMMY INPUT

/* Prepared statement, stage 1: prepare */
$stmt = $connection->prepare("INSERT INTO tbl_accounts(auto_id, username, password, first_name, middle_name, last_name, email, emp_id, position,date_created,time_created) VALUES 
(?,?,?,?,?,?,?,?,?,?,?)");

/* Prepared statement, stage 2: bind and execute */
$stmt->bind_param("sssssssssss",$auto_id, $username, $hashedP, $first_name, $middle_name, $last_name, $email, $emp_id, $position, $today, $time); // "is" means that $id is bound as an integer and $label as a string

$stmt->execute();


?>