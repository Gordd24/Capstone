<?php
session_start();
if(isset($_SESSION["ID"])){
    header("Location:php/dashboard/dashboard.php");
}

if(isset($_SESSION["PATIENT_ID"])){
    header("Location:patient_website/profile/patient_profile.php");
}
include_once 'php/dbconn.php';

if(isset($_POST['username_check'])){
    
    $username = $_POST['username'];

    //check if user exists
    $selectUsername;
    
    $selectUsername = $connection->prepare("SELECT username FROM tbl_accounts WHERE username = ?");
    
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
    
    if(isset($_POST['account'])&&$_POST["account"]=="Personnel"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $get_user_account = $connection->prepare("SELECT acc_id, username,password,position FROM tbl_accounts WHERE username = ?");
        $get_user_account->bind_param("s", $username); // "is" means that $id is bound as an integer and $label as a string
        $get_user_account->execute();
        $user_account = $get_user_account->get_result();
        if($user_account->num_rows>0)
        {
            while ($row = $user_account->fetch_array(MYSQLI_ASSOC)) {
                $test_pass = $row['password'];
                $acc_id = $row['acc_id'];
                $position = $row['position'];
            }
            if(password_verify($password, $test_pass)){
                $_SESSION["ID"] = $acc_id;
                $_SESSION["position"] = $position;
                echo "1";
            }
            else{
                echo '0';
            }
        }
    }        
}
?>