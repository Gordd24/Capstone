<?php 

include_once '../dbconn.php';



session_start();
$stmt = $connection->prepare("SELECT * FROM tbl_accounts where acc_id = ?");
$id = $_SESSION['ID'];
$stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
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
        echo 'asdadwewae';
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