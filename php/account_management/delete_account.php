<?php

session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
include_once '../dbconn.php';

if(isset($_POST['delete']))
{
    $delete = $_POST['delete'];

    /* Prepared statement, stage 1: prepare */
    $del_account_stmt = $connection->prepare("DELETE FROM tbl_accounts WHERE acc_id=?");
   
    /* Prepared statement, stage 2: bind and execute */
    $del_account_stmt->bind_param("s", $delete); // "is" means that $id is bound as an integer and $label as a string
    $del_account_stmt->execute();
}


?>