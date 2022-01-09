<?php
include_once 'php/dbconn.php';

if (isset($_POST['hidden_field_reset']) && $_POST['hidden_field_reset'] === 'form_check'){
// if (isset($_POST['reset_submit'])) {
                        
    $email = $_POST["email"];
    $password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $curDate = date("Y-m-d H:i:s");
   
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare("UPDATE tbl_patients SET password = ?");
        $stmt -> bind_param('s', $hashed_password);
        $stmt -> execute();
        $stmt -> close();
        
        $del_stmt = $connection->prepare("DELETE FROM tbl_password_reset WHERE email  = ?");
        $del_stmt -> bind_param('s', $email);
        $del_stmt -> execute();
        $del_stmt -> close();

        
    
}
?>