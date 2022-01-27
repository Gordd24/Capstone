<?php
session_start();
include_once '../dbconn.php';

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
    header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
    header("Location: ../../index.php");
  }



if (isset($_POST['password_check'])){
    $username = $_POST['username'];
    $currentPword = $_POST['currentPword'];

    //echo $patient_id;
    // $select = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$currentUname' AND password = '$currentPword'");
    // $selectUname = mysqli_query($conn,"SELECT password FROM tbl_accounts WHERE username = '$currentUname'");

    $get_password_stmt = $connection->prepare("SELECT password FROM tbl_patients where username = ?");
    $get_password_stmt->bind_param("s", $username); // "is" means that $id is bound as an integer and $label as a string
    $get_password_stmt->execute();
    $pass_result = $get_password_stmt->get_result();

    //$row = mysqli_fetch_array($selectUname);

    if($pass_result->num_rows>0)
        
    $pass_row = $pass_result->fetch_assoc();
        if(password_verify($currentPword,$pass_row['password'])){
            //password correct
            echo '1';
        }
        else{
            //password not correct.
            echo '0';
        }
}

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

    header('Location: patient_profile.php');
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
    header('Location: patient_profile.php');
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
    header('Location: patient_profile.php');
}

if (isset($_POST['upd_email_check'])){
    $email = $_POST['email'];

    $get_email_stmt = $connection->prepare("SELECT username FROM tbl_accounts WHERE username = ?");
    $get_email_stmt -> bind_param("s",$email);
    $get_email_stmt -> execute();
    $result = $get_email_stmt->get_result();

    if($result->num_rows>0){
        //username already used
        echo '1';

    }else{
        //username available
        echo '0';
        
    }
}

// EMAIL
// if(isset($_POST['edit_email'])){
//     $id = $_GET['id'];
//     $email = $_POST['email'];

//     /* Prepared statement, stage 1: prepare */
//     $stmt = $connection->prepare("UPDATE tbl_patients SET email = ? WHERE patient_id = ?");

//     /* Prepared statement, stage 2: bind and execute */
//     $stmt->bind_param("ss", $email,$id); // "is" means that $id is bound as an integer and $label as a string

//     $stmt->execute();
//     header('Location: patient_profile.php');
// }

if (isset($_POST['hidden_field_email']) && $_POST['hidden_field_email'] === 'form_check')
    {
        // if(isset($_POST['edit_username'])){
        $origEmail = $_POST['orig_email'];
        $email = $_POST['email'];

            // prepare
            $up_email_stmt = $connection->prepare("UPDATE tbl_patients SET email = ? WHERE email = ?");

            //execute
            $up_email_stmt->bind_param("ss", $email,$origEmail); // "is" means that $id is bound as an integer and $label as a string
            $up_email_stmt->execute();
            echo '1';
    }


if (isset($_POST['hidden_field_password']) && $_POST['hidden_field_password'] === 'form_check'){
// if(isset($_POST['edit_password'])){
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $username = $_POST['patient_uname'];
    //$confirm_password = $_POST['confirm_password'];
    $get_password_stmt = $connection->prepare("SELECT password FROM tbl_patients where username = ?");

    /* Prepared statement, stage 2: bind and execute */
    $get_password_stmt->bind_param("s", $username); // "is" means that $id is bound as an integer and $label as a string
    $get_password_stmt->execute();
    $pass_result = $get_password_stmt->get_result();

    if($pass_result->num_rows>0){

        $pass_row = $pass_result->fetch_assoc();
        
        if(password_verify($password,$pass_row['password'])){
            //password correct.
           
            // prepare
            $up_password_stmt = $connection->prepare("UPDATE tbl_patients SET password = ? WHERE username = ?");

            //execute
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $up_password_stmt->bind_param("ss", $hashed_password,$username); // "is" means that $id is bound as an integer and $label as a string

            $up_password_stmt->execute();
            //header("Location: patient_profile.php");
                echo '1';
        }
        else{
            echo '0';
        }
    }
    
}


?>