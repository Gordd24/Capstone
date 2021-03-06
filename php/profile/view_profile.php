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
    <link rel="shortcut icon" href="../../images/favicon.ico" />
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



?>
<div>
    <div class="row justify-content-center">
        <div class="col-10 mx-5 my-3">
            <h2>My Profile</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-5 container-lg border rounded my-5 p-2" id="edit_info_div">
        <form method="POST" id='form_name' action="view_profile_update.php?id=<?php echo $id; ?>">
            
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
                        <input type="text" class="form-control edit_info" id="middle_name" name="middle_name"  value="<?php echo $row['middle_name']; ?>"  readonly>
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
            <form method="POST" id = 'form_username'>
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
                        <input type="hidden" name="orig_uname" id="orig_uname" value="<?php echo $row['username']; ?>">
                        <input type="hidden" name="hidden_field_username" id="hidden_field_username" value="form_check">
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
                        <div class="error" id="password_error"></div>
                    </div>
                </div>

                <div class="row mb-3  justify-content-center">
                    <div class="col">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control edit_password" id="new_password" name="new_password" required readonly>
                        <div class="error" id="new_password_error"></div>
                    </div>
                </div>
                <div class="row mb-3  justify-content-center">
                    <div class="col">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control edit_password" id="confirm_password" name="confirm_password" required readonly>
                        <div class="error" id="confirm_password_error"></div>
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

    <div class="row">
        <div class="col-5 container-lg border rounded my-5 p-2" id="edit_email_div">
            <form method="POST" id="form_email">
                <h3>Email</h3>
                <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" value="" id="edit_email">
                    <label class="form-check-label" for="edit_email">
                        Update Email
                    </label>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control edit_email" id="email" name="email"  value="<?php echo $row['email']; ?>" required readonly>
                        <input type="hidden" name="orig_email" id="orig_email" value="<?php echo $row['email']; ?>">
                        <div class="error" id="email_error"></div>
                    </div>
                </div>
                <div class="row mb-3  justify-content-center d-none" id="up_email_btn">
                    <div class="col">
                        <input type="submit" class="form-control btn apply_btn text-white" id="email_submit" name="edit_email"  value="Apply Changes">
                        <input type="hidden" name="hidden_field_email" id="hidden_field_email" value="form_check">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>




    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
