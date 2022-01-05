<?php
session_start();

if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

date_default_timezone_set('Asia/Manila');
$today = date("Y-m-d"); 
$time = date("H:i:s");


include_once '../dbconn.php';

if (isset($_POST['hidden_field']) && $_POST['hidden_field'] === 'form_check'){
    echo 'pasok';
        //  post INPUTS FROM FORM FIELDS
    $username = 'default';
    $password = 'default';
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $religion = $_POST['religion'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $occupation = $_POST['occupation'];
    $status = 'Not Admitted';
    $record_status = 'Active';

    $hashedP = password_hash($password, PASSWORD_DEFAULT);


        /* Prepared statement, stage 1: prepare */
    if($stmt = $connection->prepare("INSERT INTO tbl_patients(username, password, first_name, middle_name, last_name, contact_no, email, sex, religion, address, birthdate, occupation, status, record_status, date_added, time_added) VALUES 
    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")){
        
            /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("ssssssssssssssss", $username, $hashedP, $first_name, $middle_name, $last_name, $contact_no, $email, $sex, $religion, $address, $birthdate, $occupation, $status, $record_status,  $today, $time); // "is" means that $id is bound as an integer and $label as a string

        $stmt->execute();


        //setting of patient username and password
        $patient_id = $connection->insert_id;
        $username = '';
        $password = '';

        $get_patient_stmt = $connection->prepare("SELECT * FROM tbl_patients where patient_id = ?");

        /* Prepared statement, stage 2: bind and execute */
        $get_patient_stmt->bind_param("s", $patient_id); // "is" means that $id is bound as an integer and $label as a string
        $get_patient_stmt->execute();
        $patient_result = $get_patient_stmt->get_result();



        if($patient_result->num_rows>0)
        {
            while($row_patient = $patient_result -> fetch_assoc())
            {       
                    $username = $row_patient['patient_id'].str_replace('-','',$row_patient['birthdate']);
                    $password = $row_patient['patient_id'].str_replace('-','',$row_patient['birthdate']);                  
            }

        }

        $hashedP = password_hash($password, PASSWORD_DEFAULT);

        /* Prepared statement, stage 1: prepare */
        $stmt = $connection->prepare("UPDATE tbl_patients SET username = ?, password = ? WHERE patient_id = ?;");

        /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("sss", $username, $hashedP, $patient_id); // "is" means that $id is bound as an integer and $label as a string

        $stmt->execute();
    }else{

        $error = $connection->errno . ' ' . $connection->error;
                echo 'error ' .$error;
        $stmt -> close();
    }
}

?>