<?php 
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
include_once '../dbconn.php';

$stmt = $connection->prepare("SELECT * FROM tbl_accounts where acc_id = ?");
$id = $_SESSION['ID'];
$stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();



if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

if (isset($_POST['upd_uname_check'])){
    $uname = $_POST['uname'];

    $get_uname_stmt = $connection->prepare("SELECT username FROM tbl_accounts WHERE username = ?");
    $get_uname_stmt -> bind_param("s",$uname);
    $get_uname_stmt -> execute();
    $result = $get_uname_stmt->get_result();

    if($result->num_rows>0){
        //username already used
        echo '1';

    }else{
        //username available
        echo '0';
        
    }
}

if(isset($_POST['edit_info']))
    {
        $fname = $_POST['first_name'];
        $mname = $_POST['middle_name'];
        $lname = $_POST['last_name'];
        $id = $_GET['id'];
        echo $fname . $mname . $lname;
        // prepare
        $stmt = $connection->prepare("UPDATE tbl_accounts
        SET  first_name = ?, middle_name = ?, last_name = ? WHERE acc_id = ?");
        //execute
        $stmt->bind_param("sssi", $fname,$mname,$lname,$id); // "is" means that $id is bound as an integer and $label as a string
        $stmt->execute();
       header("Location: view_profile.php");
    }
if (isset($_POST['hidden_field_username']) && $_POST['hidden_field_username'] === 'form_check'){
// if(isset($_POST['edit_username'])){
    $origUname = $_POST['orig_uname'];
    $username = $_POST['username'];

         // prepare
        $up_username_stmt = $connection->prepare("UPDATE tbl_accounts SET username = ? WHERE username = ?");

        //execute
        $up_username_stmt->bind_param("ss", $username,$origUname); // "is" means that $id is bound as an integer and $label as a string
        $up_username_stmt->execute();
        
}


if (isset($_POST['upd_password_check'])){
    $currentUname = $_POST['currentUname'];
    $currentPword = $_POST['currentPword'];

    
    // $select = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$currentUname' AND password = '$currentPword'");
    // $selectUname = mysqli_query($conn,"SELECT password FROM tbl_accounts WHERE username = '$currentUname'");

    $get_password_stmt = $connection->prepare("SELECT password FROM tbl_accounts where username = ?");
    $get_password_stmt->bind_param("s", $currentUname); // "is" means that $id is bound as an integer and $label as a string
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

if(isset($_POST['edit_profile_submit'])){
    $newPword = $_POST['newPword'];
    $currentPword = $_POST['currentPword'];
    $confirmPword = $_POST['confirmPword'];
    $viewAccId = $_POST['updateAccID'];

    if(!empty($newPword)){
        $hashedUpdatePword = password_hash($newPword, PASSWORD_DEFAULT);

        $updateSql = "UPDATE tbl_accounts SET password = '".$hashedUpdatePword."' WHERE acc_id = '".$viewAccId."';";
                        mysqli_query($conn,$updateSql);
                        
        if(mysqli_query($conn,$updateSql)){
            //header('Location: account_management.php');
            echo '1';
        }else{
            echo mysqli_error($conn);
        }
    }
}

if(isset($_POST['edit_password']))
{
    
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    //$confirm_password = $_POST['confirm_password'];
    
    $get_password_stmt = $connection->prepare("SELECT password FROM tbl_accounts where acc_id = ?");

    /* Prepared statement, stage 2: bind and execute */
    $get_password_stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
    $get_password_stmt->execute();
    $pass_result = $get_password_stmt->get_result();
    
    if($pass_result->num_rows>0){
        $pass_row = $pass_result->fetch_assoc();
        
        if(password_verify($password,$pass_row['password'])){
            //password correct.
            
                // prepare
                $up_password_stmt = $connection->prepare("UPDATE tbl_accounts SET password = ? WHERE acc_id = ?");

                //execute
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $up_password_stmt->bind_param("si", $hashed_password,$id); // "is" means that $id is bound as an integer and $label as a string
                
                //echo "<script>alert('Successfully updated the Password');</script>";
                //header("Location: view_profile.php");
                $up_password_stmt->execute();
                    echo '1';
        }
        else{
            echo '0';
        }
    }
    
}

?>