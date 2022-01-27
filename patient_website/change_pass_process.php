<?php
session_start();
include_once 'dbconn.php';
if (isset($_POST['hidden_field_changepass']) && $_POST['hidden_field_changepass'] === 'form_check'){
    $password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $patient_id =$_POST['patient_id'];
    $hashedP = password_hash($password, PASSWORD_DEFAULT);
    $changed =  'changed';
    $update = 'UPDATE tbl_patients SET password=?, pass_status=? WHERE patient_id=? ';

    if($stmt = $connection->prepare($update)){
        echo '1';
        $stmt->bind_param('ssi',$hashedP,$changed,$patient_id);
        $stmt->execute();
        $_SESSION['PASS_STATUS']= $changed;

    }else{
        echo $connection->errno . ' ' . $connection->error;
        //                 echo 'error ' .$error;;
    }
}
?>