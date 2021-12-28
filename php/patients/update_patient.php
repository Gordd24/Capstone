<?php

include_once '../dbconn.php';



if(isset($_POST['edit_name'])){
    $id = $_GET['id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    /* Prepared statement, stage 1: prepare */
    $stmt = $connection->prepare("UPDATE tbl_patients SET first_name = ?, middle_name = ?, last_name = ? WHERE patient_id = ?");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("ssss", $first_name, $middle_name, $last_name, $id ); // "is" means that $id is bound as an integer and $label as a string

    $stmt->execute();

    header('Location: view_patient.php?id='.$id);
}

// OTHER INFO GROUP
if(isset($_POST['edit_info'])){
 
    $id = $_GET['id'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    /* Prepared statement, stage 1: prepare */
    $stmt = $connection->prepare("UPDATE tbl_patients SET birthdate = ?, sex = ?, address = ? WHERE patient_id = ?");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("ssss", $birthday, $sex, $address, $id ); // "is" means that $id is bound as an integer and $label as a string

    $stmt->execute();
    header('Location: view_patient.php?id='.$id);
}

// OPTIONAL
if(isset($_POST['edit_optional'])){
    $id = $_GET['id'];
    $contact_no =  $_POST['contact_no'];
    $religion = $_POST['religion'];
    $occupation = $_POST['occupation'];
    /* Prepared statement, stage 1: prepare */
    $stmt = $connection->prepare("UPDATE tbl_patients SET contact_no = ?, religion = ?, occupation = ? WHERE patient_id = ?");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("ssss", $contact_no, $religion, $occupation, $id ); //"is" means that $id is bound as an integer and $label as a string

    $stmt->execute();
    header('Location: view_patient.php?id='.$id);
}

// EMAIL
if(isset($_POST['edit_email'])){
    $id = $_GET['id'];
    $email = $_POST['email'];

    /* Prepared statement, stage 1: prepare */
    $stmt = $connection->prepare("UPDATE tbl_patients SET email = ? WHERE patient_id = ?");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("ss", $email,$id); // "is" means that $id is bound as an integer and $label as a string

    $stmt->execute();
    header('Location: view_patient.php?id='.$id);
}


?>