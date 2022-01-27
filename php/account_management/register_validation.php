<?php
session_start();

if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
if(isset($_SESSION['position']) && $_SESSION['position']!='Administrator'){
    header("Location: ../../index.php");
}
date_default_timezone_set('Asia/Manila');
$today = date("Y-m-d"); 
$time = date("H:i:s");


include_once '../dbconn.php';

if(isset($_POST['username_check'])){
    $uname = $_POST['username'];

    //check if user exists
    $selectUser = $connection->prepare("SELECT username FROM tbl_accounts WHERE username = ?");
    $selectUser->bind_param('s',$uname);
    $selectUser->execute();
    $selectUser->store_result();

    if($selectUser->num_rows>0){
        //user exist
        echo "0";
    }
    else{
        //user does not exist
        echo "1";
    }
    $selectUser->close();
}

if(isset($_POST['empid_check'])){
    $emp_id=$_POST["employeeId"];
    
    //check if emp id exists
    $selectEmpid = $connection->prepare("SELECT emp_id FROM tbl_accounts WHERE emp_id = ?");
    $selectEmpid->bind_param('s',$emp_id);
    $selectEmpid->execute();
    $selectEmpid->store_result();

    if($selectEmpid->num_rows>0){
        //emp id exist
        echo "0";
    }
    else{
        //emp id does not exist
        echo "1";
    }
    exit();
}

if(isset($_POST['email_check'])){
    $email = $_POST['email'];

    //check if user exists
    $selectEmail = $connection->prepare("SELECT email FROM tbl_accounts WHERE email = ?");
    $selectEmail->bind_param('s',$email);
    $selectEmail->execute();
    $selectEmail->store_result();

    if($selectEmail->num_rows>0){
        //user exist
        echo "0";
    }
    else{
        //user does not exist
        echo "1";
    }
    $selectEmail->close();
}

//substitute to submit since ajax can't see the submit button
if (isset($_POST['hidden_field']) && $_POST['hidden_field'] === 'form_check'){
    // if (isset($_POST['register'])){  
        echo 'pumasok';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $emp_id = $_POST['emp_id'];
        $position = $_POST['position'];
    
        $hashedP = password_hash($password, PASSWORD_DEFAULT);
    
        $selectUser = $connection->prepare("SELECT username FROM tbl_accounts WHERE username = ?");
        $selectUser->bind_param('s',$username);
        $selectUser->execute();
        $selectUser->store_result();
        //echo $username . ' ' . $hashedP . ' ' .$first_name. ' ' . $middle_name . ' ' . $last_name . ' ' . $email . ' ' . $emp_id . ' ' . $position; 
        
        if($selectUser->num_rows>0){
            echo 'exist';
            $selectUser->close();
        }else{
            echo 'pasok2';
            $selectUser->close();
            /* Prepared statement, stage 1: prepare */
            $defAutoId = 'EMP';
            $insert = "INSERT INTO tbl_accounts(username,auto_id, password, first_name, middle_name, last_name, email, emp_id, position,date_created,time_created) VALUES 
            (?,?,?,?,?,?,?,?,?,?,?)";
            if($stmt = $connection->prepare($insert)){
                echo 'pasok3';
                /* Prepared statement, stage 2: bind and execute */
                $stmt->bind_param("sssssssssss", $username,$defAutoId , $hashedP, $first_name, $middle_name, $last_name, $email, $emp_id, $position, $today, $time); // "is" means that $id is bound as an integer and $label as a string
                if($stmt->execute()){
                    echo 'pasok4';
                    $stmt->close();
                    $last_id = mysqli_insert_id($connection);
                    if($last_id){
                        echo 'pasok5';
                        $auto_id = "EMP_".$last_id;
                        $insertID = "UPDATE tbl_accounts SET auto_id = ? WHERE acc_id = ?";
                        $stmt_insert_id = $connection->prepare($insertID);
                        $stmt_insert_id->bind_param("si",$auto_id,$last_id);
                        $stmt_insert_id->execute();
                        
                        echo 'success';
                    }else{
    
                        $error = $connection->errno . ' ' . $connection->error;
                                echo 'error ' .$error;
                        
                    }
                    $stmt_insert_id -> close();
                }else{
                    $error = $connection->errno . ' ' . $connection->error;
                        echo 'error ' .$error;
                $stmt -> close();
                }
                
            }else{
    
                $error = $connection->errno . ' ' . $connection->error;
                        echo 'error ' .$error;
                $stmt -> close();
            }
        }
    }
?>