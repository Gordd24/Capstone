<?php

// EMAIL
if(isset($_POST['edit_email'])){
    $id = $_GET['id'];
    $email = $_POST['edit_email'];

    /* Prepared statement, stage 1: prepare */
    $stmt = $connection->prepare("UPDATE tbl_accounts SET email = ? WHERE acc_id = ?");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("ss", $email,$id); // "is" means that $id is bound as an integer and $label as a string

    $stmt->execute();
}

?>