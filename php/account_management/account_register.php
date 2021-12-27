<?php
session_start();

if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}


date_default_timezone_set('Asia/Manila');
$today = date("Y-m-d"); 
$time = date("H:i:s");

include_once '../dbconn.php';

    if(isset($_POST['username_check'])){
        $regUname = $_POST['regisUname'];

        //check if user exists
        $selectUser = "SELECT username FROM tbl_accounts WHERE username = '$regUname'";
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

    if(isset($_POST['empid_check'])){
        $regEmpId=$_POST["employeeId"];
        
        //check if emp id exists
        $selectEmpId = "SELECT emp_id FROM tbl_accounts WHERE emp_id = '$regEmpId'";
        $empResult = mysqli_query($conn,$selectEmpId);
        $empRowCount = mysqli_num_rows($empResult);

        if($empRowCount>0){
            //emp id exist
            echo "0";
        }
        else{
            //emp id does not exist
            echo "1";
        }
        exit();
    }

    if (isset($_POST['regSubmit'])){

        //post inputs
        $registerUname = $_POST['regUname'];
        $registerPword = $_POST['regPword'];
        $registerCPword = $_POST['regCPword'];
        $registerFname = $_POST['regFname'];
        $registerMname = $_POST['regMname'];
        $registerLname = $_POST['regLname'];
        $registerEmpId = $_POST['regEmpId'];
        $registerPosition = $_POST['regPosition'];
        //$registerImage = $_POST['registerImage'];

        $selectUser = "SELECT username FROM tbl_accounts WHERE username = '$registerUname'";
        $userResult = mysqli_query($conn,$selectUser);
        $userRowCount = mysqli_num_rows($userResult);

        if($userRowCount>0){
            //user exist
            echo "exist";
            exit();
        }
        else{
            //encrypt password
            $hashedRegisterPword = password_hash($registerPword, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO tbl_accounts(username, password, first_name, middle_name, last_name, emp_id, position,date_created,time_created) VALUES 
            ('$registerUname','$hashedRegisterPword','$registerFname','$registerMname','$registerLname','$registerEmpId','$registerPosition','".$today."','".$time."');";
            $insertResult= mysqli_query($conn,$insertQuery);
            if($insertResult){
                $last_id = mysqli_insert_id($conn);
        
                if($last_id){
                    $auto_id = "EMP_".$last_id;
                    $auto_id_query = "UPDATE tbl_accounts SET auto_id = '".$auto_id."' WHERE acc_id='".$last_id."'";
                    mysqli_query($conn,$auto_id_query);  
                    echo "saved";
                    
                    exit();  
                }
            }
            
        }
        
    }

?>