<?php

include_once '../dbconn.php';
$file = '';
$filename = '';

if(isset($_GET['type'])&&$_GET['type']=="admission"){

    $file_name = $_GET['file_name'];
    

    /* Prepared statement, stage 1: prepare */                                                   
    $get_record_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE file_name = ?");

    /* Prepared statement, stage 2: bind and execute */
    $get_record_stmt->bind_param("s", $file_name); // "is" means that $id is bound as an integer and $label as a string
    $get_record_stmt->execute();
    $record_result = $get_record_stmt->get_result();

    while ($row = $record_result->fetch_array(MYSQLI_ASSOC)) {
        $file = "../../".$row['pdf_path'];
        $filename = $row['file_name'];

   }



}else if(isset($_GET['type'])&&$_GET['type']=="consultation"){

    $file_name = $_GET['file_name'];
    

    /* Prepared statement, stage 1: prepare */                                                   
    $get_record_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE file_name = ?");

    /* Prepared statement, stage 2: bind and execute */
    $get_record_stmt->bind_param("s", $file_name); // "is" means that $id is bound as an integer and $label as a string
    $get_record_stmt->execute();
    $record_result = $get_record_stmt->get_result();

    while ($row = $record_result->fetch_array(MYSQLI_ASSOC)) {
        $file = "../../".$row['pdf_path'];
        $filename = $row['file_name'];

   }



}else if(isset($_GET['type'])&&$_GET['type']=="medical"){

    $file_name = $_GET['file_name'];
    

    /* Prepared statement, stage 1: prepare */                                                   
    $get_record_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE file_name = ?");

    /* Prepared statement, stage 2: bind and execute */
    $get_record_stmt->bind_param("s", $file_name); // "is" means that $id is bound as an integer and $label as a string
    $get_record_stmt->execute();
    $record_result = $get_record_stmt->get_result();

    while ($row = $record_result->fetch_array(MYSQLI_ASSOC)) {
        $file = "../../".$row['pdf_path'];
        $filename = $row['file_name'];

   }



}else if(isset($_GET['type'])&&$_GET['type']=="laboratory"){

    $file_name = $_GET['file_name'];
    

    /* Prepared statement, stage 1: prepare */                                                   
    $get_record_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE file_name = ?");

    /* Prepared statement, stage 2: bind and execute */
    $get_record_stmt->bind_param("s", $file_name); // "is" means that $id is bound as an integer and $label as a string
    $get_record_stmt->execute();
    $record_result = $get_record_stmt->get_result();

    while ($row = $record_result->fetch_array(MYSQLI_ASSOC)) {
        $file = "../../".$row['pdf_path'];
        $filename = $row['file_name'];

   }



}


header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');
@readfile($file);
?>