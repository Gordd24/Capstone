
<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/nav.js"></script>
    <script src="../../js/view_profile.js"></script>
    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/view_profile.css">
   

</head>
<body id="body-pd">
<?php include_once '../admin_nav.php';?>

<?php
 /* Prepared statement, stage 1: prepare */
 $stmt = $connection->prepare("SELECT * FROM tbl_accounts where acc_id = ?");

 /* Prepared statement, stage 2: bind and execute */
 $id = $_SESSION['ID'];
 $stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
 $stmt->execute();
 $result = $stmt->get_result();
 $row = $result->fetch_assoc();

if(isset($_POST['edit_info']))
{
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];

    // prepare
    $stmt = $connection->prepare("UPDATE tbl_accounts
    SET  first_name = ?, middle_name = ?, last_name = ? WHERE acc_id = ?");


    //execute
    $stmt->bind_param("sssi", $fname,$mname,$lname,$id); // "is" means that $id is bound as an integer and $label as a string
    $stmt->execute();
    header("Location: view_profile.php");
}


if(isset($_POST['edit_username']))
{
    $username = $_POST['username'];

    /* Prepared statement, stage 1: prepare */
    $get_username_stmt = $connection->prepare("SELECT username FROM tbl_accounts where username = ?");

    /* Prepared statement, stage 2: bind and execute */
    $get_username_stmt->bind_param("s", $username); // "is" means that $id is bound as an integer and $label as a string
    $get_username_stmt->execute();
    $username_result = $get_username_stmt->get_result();

    if(!$username_result->num_rows>0)
    {
         // prepare
        $up_username_stmt = $connection->prepare("UPDATE tbl_accounts SET username = ? WHERE acc_id = ?");

        //execute
        $up_username_stmt->bind_param("si", $username,$id); // "is" means that $id is bound as an integer and $label as a string
        $up_username_stmt->execute();
        header("Location: view_profile.php");
    }else{
        echo "<script>alert('This Username is Already Exist');</script>";
    }
}


// if(isset($_POST['edit_password']))
// {
//     $password = $_POST['password'];
//     $new_password = $_POST['new_password'];
//     $confirm_password = $_POST['confirm_password'];

//     $get_password_stmt = $connection->prepare("SELECT password FROM tbl_accounts where acc_id = ?");

//     /* Prepared statement, stage 2: bind and execute */
//     $get_password_stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
//     $get_password_stmt->execute();
//     $pass_result = $get_password_stmt->get_result();
   
//     if($pass_result->num_rows>0)
//     {
//         $pass_row = $pass_result->fetch_assoc();
//         if(password_verify($password,$pass_row['password'])){
//             //password correct.
//             if($new_password==$confirm_password){
//                 //password match.

//                 // prepare
//                 $up_password_stmt = $connection->prepare("UPDATE tbl_accounts SET password = ? WHERE acc_id = ?");

//                 //execute
//                 $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
//                 $up_password_stmt->bind_param("si", $hashed_password,$id); // "is" means that $id is bound as an integer and $label as a string
//                 $up_password_stmt->execute();
//                 echo "<script>alert('Successfully updated the Password');</script>";
//                 header("Location: view_profile.php");

//             }else{
//                  //password not match.
//                 echo "<script>alert('Confirm Your Password');</script>";
//             }
//         }else{
//             //password not correct.
//             echo "<script>alert('Wrong Password');</script>";
//         }
//     }

   
// }

?>
<div>
    <div class="row justify-content-center">
        <div class="col-10 mx-5 my-3">
            <h2>My Profile</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-5 container-lg border rounded my-5 p-2" id="edit_info_div">
        
            <form method="POST">
            <h3>Personal Information</h3>
                <div class="form-check my-3">
                <input class="form-check-input" type="checkbox" value="" id="edit_info">
                <label class="form-check-label" for="edit_info">
                    Update Information
                </label>
                </div>

                <div class="row mb-3 justify-content-center">
                    <div class="col">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control edit_info" id="first_name" name="first_name"  value="<?php echo $row['first_name']; ?>" required readonly>
                    </div>
                </div>

                <div class="row mb-3  justify-content-center">
                    <div class="col">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control edit_info" id="middle_name" name="middle_name"  value="<?php echo $row['middle_name']; ?>"  required readonly>
                    </div>
                </div>
                <div class="row mb-3  justify-content-center">
                    <div class="col">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control edit_info" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>"  required readonly>
                    </div>
                </div>
                <div class="row mb-3  justify-content-center d-none" id="up_info_btn">
                    <div class="col">
                        <input type="submit" id="update_name_submit" class="form-control btn apply_btn text-white" name="edit_info" value="Apply Changes">
                    </div>
                </div>
            </form>
        </div>
    </div>    

    <div class="row">
        <div class="col-5 container-lg border rounded my-5 p-2" id="edit_username_div">
            <form method="POST">
            <h3>Update Username</h3>
                <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" value="" id="edit_username">
                    <label class="form-check-label" for="edit_username">
                        Update Username
                    </label>
                </div>
                <div class="row mb-3  justify-content-center">
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control edit_username" id="username" name="username" value="<?php echo $row['username']; ?>" required readonly>
                    </div>
                </div>

                <div class="row mb-3  justify-content-center d-none" id="up_username_btn">
                    <div class="col">
                        <input type="submit" id="update_username_submit"  class="form-control btn apply_btn text-white" name="edit_username"  value="Apply Changes">
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-5 container-lg border rounded my-5 p-2" id="edit_password_div">
            <form method="POST" id="form_password">
                <h3>Change Password</h3>
                <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" value="" id="edit_password">
                    <label class="form-check-label" for="edit_password">
                        Update Password
                    </label>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col">
                        <label for="password" class="form-label">Current Password</label>
                        <input type="password" class="form-control edit_password" id="password" name="password" required readonly>
                    </div>
                </div>

                <div class="row mb-3  justify-content-center">
                    <div class="col">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control edit_password" id="new_password" name="new_password" required readonly>
                    </div>
                </div>
                <div class="row mb-3  justify-content-center">
                    <div class="col">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control edit_password" id="confirm_password" name="confirm_password" required readonly>
                    </div>
                </div>
                <div class="row mb-3  justify-content-center d-none" id="up_password_btn">
                    <div class="col">
                        <input type="submit" class="form-control btn apply_btn text-white" id="password_submit" name="edit_password"  value="Apply Changes">
                        <input type="hidden" name="edit_password" value = "1">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
