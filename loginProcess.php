<?php
session_start();
include_once 'php/dbconn.php';
if(isset($_SESSION["ID"])){
    header("Location:php/dashboard/dashboard.php");
}

if(isset($_SESSION["PATIENT_ID"])){
    header("Location:patient_website/profile/patient_profile.php");
}

if(isset($_POST['username_check'])){
    
    $username = $_POST['username'];

    //check if user exists
    $selectUsername;
    
    $selectUsername = $connection->prepare("SELECT username FROM tbl_patients WHERE username = ?");
    
    $selectUsername->bind_param('s',$username);
    $selectUsername->execute();
    $selectUsername->store_result();

    if($selectUsername->num_rows>0){
        //user exist
        echo "1";
    }
    else{
        //user does not exist
        echo "0";
    }

    $selectUsername->close();
}

if (isset($_POST['hidden_field_signin']) && $_POST['hidden_field_signin'] === 'form_check'){
    
    if(isset($_POST['account'])&&$_POST["account"]=="Patient"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $get_patient_account = $connection->prepare("SELECT patient_id, username,password, pass_status FROM tbl_patients WHERE username = ?");
        $get_patient_account->bind_param("s", $username); // "is" means that $id is bound as an integer and $label as a string
        $get_patient_account->execute();
        $patient_account = $get_patient_account->get_result();

        if($patient_account->num_rows>0)
        {
            while ($row = $patient_account->fetch_array(MYSQLI_ASSOC)) {
                $test_pass = $row['password'];
                $patient_id = $row['patient_id'];
                $pass_status = $row['pass_status'];
            }

            if(password_verify($password, $test_pass)){
                $_SESSION["PATIENT_ID"] = $patient_id;
                $_SESSION["PASS_STATUS"] = $pass_status;
                echo '1';
            }
            else{
                echo '0';
            }
        }
    }        
}

?>