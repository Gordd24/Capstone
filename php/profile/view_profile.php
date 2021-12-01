<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>
  <script src="../../js/view_profile.js" type="text/javascript"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/view_profile.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  
</head>
<body>
  
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">
        <div class="profile_management_div">
            <div class="profile_management_edit_div">
            <h2>Account Profile</h2> 
                <div class="edit_profile_form_div">   
                    <?php 
                        $sql = "SELECT * FROM tbl_accounts where acc_id = '".$_SESSION['ID']."'";
                        $result = $conn -> query($sql);

                        if($result->num_rows>0)
                        {
                            $view_profile = $result -> fetch_assoc();
                        }    
                    ?>
                   
                    <div class="account_info_div">
                        <form class="view_profile_form">
                            <h5>Account Profile</h5><br>
                            <input type="hidden" id="currentUname" value="<?php echo $view_profile['username']; ?>">
                            <label  for='acc_id'>Account ID:</label><br>
                            <input type='text' id='acc_id'class='viewFields'  value="<?php echo $view_profile['acc_id']; ?>" readonly><br>
                            <label  for='emp_id'>Employee ID:</label><br>
                            <input type='text' id='emp_id' class='viewFields'  value="<?php echo $view_profile['emp_id']; ?>" readonly><br>
                            <label  for='name'>Name:</label><br>
                            <input type='text' id='name' class='viewFields'  value="<?php echo $view_profile['position']." ".$view_profile['first_name']." ".$view_profile['middle_name']." ".$view_profile['last_name']; ?>" readonly><br>
                            <label  for='username'>Username:</label><br>
                            <input type='text' id='username' class='viewFields'  value="<?php echo $view_profile['username']; ?>" readonly><br>
                        </form>
                            
                  
                        <div class="password_info_div">
                            <form class="edit_profile_form" id="edit_profile_form" method="POST">
                                <h5>Change Password</h5><br>
                                <label for='currentPword'>Current Password:</label><br>
                                <input type='password' class='viewFields pass_field' id='currentPword' name='currentPword' placeholder='Current Password'><br>
                                <label for='newPword'>New Password:</label><br>
                                <input type='password' class='viewFields pass_field' id='newPword' name='newPword' placeholder='New Password' ><br/>
                                <label for='confirmPword'>Confirm New Password:</label><br>
                                <input type='password' class='viewFields pass_field' id='confirmPword' name='confirmPword' placeholder='Confirm Password' ><br/>
                                <input type='text' id='updateAccID' name='updateAccID' placeholder='' style='visibility:hidden' value='<?php echo $view_profile['acc_id']; ?>'><br>
                                <input class='button' type='submit' name='edit_profile_submit' value='Save Changes' disabled>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        

   

    </div>
        
      

</body>
</html>