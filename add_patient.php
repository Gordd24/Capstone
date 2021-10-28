<?php

include_once 'dbconn.php';
if(isset($_POST['addPatientBtn'])){

     //post inputs
    $patient_fname = $_POST['patient_fname'];
    $patient_mname = $_POST['patient_mname'];
    $patient_lname = $_POST['patient_lname'];
    $patient_sex = $_POST['patient_sex'];
    $patient_contact_no = $_POST['patient_contact_no'];
    $patient_birthday = $_POST['patient_birthday'];
    $patient_address = $_POST['patient_address'];
    $patient_occupation = $_POST['patient_occupation'];
    $patient_religion = $_POST['patient_religion'];
    $errorExist = "";

    //if user exists
    $patientSql = "SELECT * FROM tbl_patients WHERE first_name = '".$patient_fname."' AND last_name = '".$patient_lname."';";
    $result = mysqli_query($conn,$patientSql);
    $patientExist = mysqli_num_rows($result);

    if($patientExist>0){
      $errorPatient = "Patient Already Have a Record";
      $errorExist .= $errorPatient;
      echo '<script type = "text/javascript">';
      echo 'alert("'.$errorPatient.'");';
      echo '</script>';
    }
   

    if(empty($errorExist)){
    $insertSql = "INSERT INTO tbl_patients(first_name,middle_name,last_name,contact_no,sex,religion,address,birthdate,occupation) VALUES ('$patient_fname','$patient_mname','$patient_lname','$patient_contact_no','$patient_sex','$patient_religion','$patient_address','$patient_birthday','$patient_occupation');";
    mysqli_query($conn,$insertSql);
    header("Location: record_management.php");

    }
}
   
  

?>