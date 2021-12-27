<?php 

include_once '../dbconn.php';

session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

if (isset($_POST['upd_password_check'])){
    $currentUname = $_POST['currentUname'];
    $currentPword = $_POST['currentPword'];

    $select = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$currentUname' AND password = '$currentPword'");
    $selectUname = mysqli_query($conn,"SELECT password FROM tbl_accounts WHERE username = '$currentUname'");

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

/* if(isset($_POST['edit_profile_submit'])){

    $newPword = $_POST['newPword'];
    $currentPword = $_POST['currentPword'];
    $confirmPword = $_POST['confirmPword'];
    $viewAccId = $_POST['updateAccID'];

    $selectUser = "SELECT password FROM tbl_accounts WHERE acc_id = '".$viewAccId."';";
    $result = $conn -> query($selectUser);
    if($result->num_rows>0)
    {
       while($row = $result -> fetch_assoc())
       {
            if(password_verify($currentPword, $row['password'])){
                
                if(!empty($newPword)){
                    if($confirmPword==$newPword)
                    {
                        $hashedUpdatePword = password_hash($newPword, PASSWORD_DEFAULT);
                        $updateSql = "UPDATE tbl_accounts SET password = '".$hashedUpdatePword."' WHERE acc_id = '".$viewAccId."';";
                        mysqli_query($conn,$updateSql);
                        echo "<script> alert('Success'); </script>";
                    }else{
                        echo "<script> alert('Confirm Your New Password'); </script>";
                    }
                }else{
                    echo "<script> alert('Empty New Password'); </script>";
                }
            }else{
                echo "<script> alert('Your Current Password is Wrong'); </script>";
            }
        }

    }
} */

?>