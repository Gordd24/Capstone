<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
include_once '../dbconn.php';

if(isset($_POST['upd_username_check'])){
    $viewUname = $_POST['viewUname'];
    
    //check if user exists
    $selectUser = "SELECT username FROM tbl_accounts WHERE username = '$viewUname'";
    $userResult = mysqli_query($conn,$selectUser);
    $userRowCount = mysqli_num_rows($userResult);

    if($userRowCount>0){
        //user exist
        echo "0";
    }
    else{
        //user does not exist
        echo "1";
    }
    exit();
}
if (isset($_POST['upd_password_check'])){
    $currentUname = $_POST['currentUname'];
    $currentPword = $_POST['currentPword'];

    $select = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$currentUname' AND password = '$currentPword'");
    $selectUname = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$currentUname'");

    $row = mysqli_fetch_array($selectUname);
        
        if(password_verify($currentPword, $row['password'])){
            //password correct
            echo '1';
        }
        else{
            //password not correct.
            echo '0';
        }
} 

if(isset($_POST['saveChangesButton'])){

    $viewUname = $_POST['viewUname'];
    $newPword = $_POST['newPword'];
    $viewFname = $_POST['viewFname'];
    $viewMname = $_POST['viewMname'];
    $viewLname = $_POST['viewLname'];
    $viewEmpId = $_POST['updateAccID'];
    $viewPosition = $_POST['viewPosition'];

    if(empty($newPword)){
        $updateSql = "UPDATE tbl_accounts
                SET username = '".$viewUname."', first_name = '".$viewFname."', middle_name = '".$viewMname."', last_name = '".$viewLname."', position = '".$viewPosition."' WHERE emp_id = '".$viewEmpId."';";
        if(mysqli_query($conn,$updateSql)){
           //header('Location: account_management.php');
           echo '1';
        }else{
            echo mysqli_error($conn);
        }
    }else{

        $hashedUpdatePword = password_hash($newPword, PASSWORD_DEFAULT);

        $updateSql = "UPDATE tbl_accounts
                    SET username = '".$viewUname."', password = '".$hashedUpdatePword."', first_name = '".$viewFname."', middle_name = '".$viewMname."', last_name = '".$viewLname."', position = '".$viewPosition."' WHERE emp_id = '".$viewEmpId."';";
        if(mysqli_query($conn,$updateSql)){
            //header('Location: account_management.php');
            echo '1';
        }else{
            echo mysqli_error($conn);
        }
    }
}

?>