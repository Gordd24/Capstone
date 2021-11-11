<?php


include_once '../dbconn.php';

$delete = $_POST['delete'];
$sql = "DELETE FROM tbl_accounts WHERE emp_id='".$delete."'";
$result = $conn -> query($sql);

include_once 'fetch_Accounts.php';


?>