<?php 

include_once '../dbconn.php';

session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

if(isset($_POST['edit_profile_submit'])){

    $selectUser = "SELECT username FROM tbl_accounts WHERE username = '".$_POST['profile_username']."'";
    $userResult = mysqli_query($conn,$selectUser);
    $userRowCount = mysqli_num_rows($userResult);

    if($userRowCount)
    {
        $updateSql = "UPDATE tbl_accounts
        SET username = '".$_POST['profile_username']."', first_name='".$_POST['profile_fname']."', middle_name = '".$_POST['profile_mname']."', last_name='".$_POST['profile_lname']."', 
        emp_id = '".$_POST['profile_emp_id']."' WHERE acc_id = '".$_SESSION['ID']."';";
        mysqli_query($conn,$updateSql);
        header("Location: view_profile.php");
    }else{
        echo "<script>alert('Username is already taken.');</script>";
    }

   
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>
  <script src="../../js/view_profile.js" type="text/javascript"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/view_profile.css">
</head>
<body>
  
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">

        <div class="profile_management_div">

            <div class="profile_management_edit_div">
                <div class="edit_profile_form_div">
                    <h2>Account Profile</h2> 

                  
                    
                    <?php 
                        
                       
                        $sql = "SELECT * FROM tbl_accounts where acc_id = '".$_SESSION['ID']."'";
                        $result = $conn -> query($sql);

                        if($result->num_rows>0)
                        {
                            $view_profile = $result -> fetch_assoc();

                        }    
                    
                    ?>
   
                    <form class="edit_profile_form" method="POST">
                        <label for="profile_acc_id">Account ID</label><br>
                        <input id="profile_acc_id" type="text" name="profile_acc_id" value="<?php echo $view_profile['acc_id']; ?>" autocomplete="off" readonly><br>
                        <label for="profile_position">Position:</label><br>
                        <input id="profile_position" type="text" name="profile_position" value="<?php echo $view_profile['position']; ?>" autocomplete="off" readonly><br><br><br>

                        <h4 id='edit_stat'>Double Click any of the following Field to Enable Edit Mode</h4> 
                        <label for="profile_username">Username</label><br>
                        <input class="profile_editable" id="profile_username" type="text" name="profile_username" placeholder="Username" value="<?php echo $view_profile['username']; ?>" autocomplete="off" readonly><br><br>
                        
                        <label for="profile_fname">First Name</label><br>
                        <input class="profile_editable" id="profile_fname" type="text" name="profile_fname" placeholder="First Name" required="" value="<?php echo $view_profile['first_name']; ?>" autocomplete="off" readonly><br>
                        <label for="profile_mname">Middle Name</label><br>
                        <input class="profile_editable" id="profile_mname" type="text" name="profile_mname" placeholder="Middle Name (Optional)" value="<?php echo $view_profile['middle_name']; ?>" autocomplete="off" readonly><br>
                        <label for="profile_lname">Last Name</label><br>
                        <input class="profile_editable" id="profile_lname" type="text" name="profile_lname" placeholder="Last Name" required="" value="<?php echo $view_profile['last_name']; ?>" autocomplete="off" readonly><br>
                        <label for="profile_emp_id">Employee ID</label><br>
                        <input class="profile_editable" id="profile_emp_id" type="text" name="profile_emp_id" required="" placeholder="Employee ID" value="<?php echo $view_profile['emp_id']; ?>" autocomplete="off" readonly><br>

                              

                        
                        
                        
                        


                        <input class="button" type="submit" name="edit_profile_submit" value="Save Changes" disabled>    
                    </form>
                </div>
            </div>

        </div>
        
        

   

    </div>
        
      

</body>
</html>