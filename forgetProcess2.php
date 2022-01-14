<?php
session_start();
if(isset($_SESSION["ID"])){
    header("Location:php/dashboard/dashboard.php");
}

if(isset($_SESSION["PATIENT_ID"])){
    header("Location:patient_website/profile/patient_profile.php");
}
include_once 'php/dbconn.php';

//for personnel
if(isset($_POST['email_check'])){
    $email = $_POST['email'];

    //check if user exists
    $selectEmail = $connection->prepare("SELECT email FROM tbl_accounts WHERE email = ?");
    $selectEmail->bind_param('s',$email);
    $selectEmail->execute();
    $selectEmail->store_result();

    if($selectEmail->num_rows>0){
        //user exist
        echo "0";
    }
    else{
        //user does not exist
        echo "1";
    }
    $selectEmail->close();
}
?>