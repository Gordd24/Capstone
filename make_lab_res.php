<?php

include_once 'dbconn.php';

date_default_timezone_set('Asia/Manila');
$patient_id = $_POST['patient_id'];
$patient_lname = strtolower($_POST['patient_lname']);
$path_date = date("Ymdgis");
$record_date = date("Y-m-d");

$patient_name = $_POST['patient_fname']." ".$_POST['patient_mname']." ".$_POST['patient_lname'];


if(isset($_POST['lab_res_upload'])){
    $pdfName =$_FILES['patient_lab_res']['name'];
    //$destination = 'patient/' . $pdfName;

    $path = "patient/".$patient_name;
    if (!is_dir( $path ) ) {
        mkdir( $path );       
    } 
    $path_type = $path."/laboratory_result";
    
    if (!is_dir( $path_type ) ) {
        mkdir( $path_type );       
    } 

    //destination
    $file = $path_type."/".$pdfName;

    //$extension = pathinfo($pdfName, PATHINFO_EXTENSION);//check if the extension is correct
    $tmp_file = $_FILES['patient_lab_res']['tmp_name'];
    //$size = $_FILES['patient_lab_res']['size'];//for size limit
   
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($tmp_file, $file)) {
            $insertSql = "INSERT INTO tbl_lab_result(patient_id,pdf_path,date) VALUES ('$patient_id','$file','$record_date');";
            if (mysqli_query($conn, $insertSql)) {
                echo "File uploaded successfully";
                header('Location: record_management.php');
            }else{
                echo mysqli_error($conn);
            }
        } 
        else {
            echo "Failed to upload file.";
            echo mysqli_error($conn);
        }
        
        //header('Location: record_management.php');
}



?>