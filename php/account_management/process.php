<?php
include_once '../dbconn.php';

// if (isset($_POST['hidden_field']) && $_POST['hidden_field'] === 'form_check'){
if (isset($_POST['register'])){  
    echo 'pumasok';
    // $username = $_POST['username'];
    // $password = $_POST['password'];
    // $confirm_password = $_POST['confirm_password'];
    // $first_name = $_POST['first_name'];
    // $middle_name = $_POST['middle_name'];
    // $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    // $emp_id = $_POST['emp_id'];
    // $position = $_POST['position'];

    // $hashedP = password_hash($password, PASSWORD_DEFAULT);

    // $selectUser = $connection->prepare("SELECT username FROM tbl_accounts WHERE username = ?");
    // $selectUser->bind_param('s',$username);
    // $selectUser->execute();
    // $selectUser->store_result();
    // //echo $username . ' ' . $hashedP . ' ' .$first_name. ' ' . $middle_name . ' ' . $last_name . ' ' . $email . ' ' . $emp_id . ' ' . $position; 
    
    // if($selectUser->num_rows>0){
    //     echo 'exist';
    //     $selectUser->close();
    // }else{
    //     $selectUser->close();
    //     /* Prepared statement, stage 1: prepare */
    //     $insert = "INSERT INTO tbl_accounts(username, password, first_name, middle_name, last_name, email, emp_id, position,date_created,time_created) VALUES 
    //     (?,?,?,?,?,?,?,?,?,?)";
    //     if($stmt = $connection->prepare($insert)){
    //         /* Prepared statement, stage 2: bind and execute */
    //         $stmt->bind_param("ssssssssss", $username, $hashedP, $first_name, $middle_name, $last_name, $email, $emp_id, $position, $today, $time); // "is" means that $id is bound as an integer and $label as a string
    //         if($stmt->execute()){
    //             $stmt->close();
    //             $last_id = mysqli_insert_id($connection);
    //             if($last_id){
    //                 $auto_id = "EMP_".$last_id;
    //                 $insertID = "UPDATE tbl_accounts SET auto_id = ? WHERE acc_id = ?";
    //                 $stmt_insert_id = $connection->prepare($insertID);
    //                 $stmt_insert_id->bind_param("si",$auto_id,$last_id);
    //                 $stmt_insert_id->execute();
                    
    //                 echo 'success';
    //             }else{

    //                 $error = $connection->errno . ' ' . $connection->error;
    //                         echo 'error ' .$error;
                    
    //             }
    //             $stmt_insert_id -> close();
    //         }
            
    //     }else{

    //         $error = $connection->errno . ' ' . $connection->error;
    //                 echo 'error ' .$error;
    //         $stmt -> close();
    //     }
    // }
}else{
    echo 'di pumasok';
}
// if(isset($_POST['register'])){
// }  
?>