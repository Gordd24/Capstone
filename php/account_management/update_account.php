<?php
    session_start();
    if(!isset($_SESSION['Username'])){
        header("Location: ../../index.php");
    }
    include_once '../dbconn.php';

    if(isset($_POST['saveChangesButton'])){

        //post inputs
        $viewUname = $_POST['viewUname'];
        $viewPword = $_POST['viewPword'];
        $viewFname = $_POST['viewFname'];
        $viewMname = $_POST['viewMname'];
        $viewLname = $_POST['viewLname'];
        $viewEmpId = $_POST['updateAccID'];
        $viewPosition = $_POST['viewPosition'];
        //$registerImage = $_POST['registerImage'];

        //error validator
        $errorUname="";
        $errorPass="";
        $errorExist="";

        //if user exists
        // $usersql = "SELECT * FROM tbl_accounts WHERE username = '$registerUname'";
        // $userResult = mysqli_query($conn,$usersql);
        // $userExist = mysqli_num_rows($userResult);

        // if($userExist>0){
        // $errorUname = "User already exists";
        // $errorExist .= $errorUname;
        // echo '<script type = "text/javascript">';
        // echo 'alert("'.$errorUname.'");';
        // echo '</script>';
        // }

        // if(empty($errorExist)){


        $updateSql = "UPDATE tbl_accounts
                      SET username = '".$viewUname."', password = '".$viewPword."', first_name = '".$viewFname."', middle_name = '".$viewMname."', last_name = '".$viewLname."', emp_id = '"
                      .$viewEmpId."', position = '".$viewPosition."' WHERE emp_id = '".$viewEmpId."';";

        mysqli_query($conn,$updateSql);
        // echo '<script type = "text/javascript">';
        // echo 'alert("update success");';
        // echo '</script>';
        header("Location: account_management.php");
        // }
    }

?>