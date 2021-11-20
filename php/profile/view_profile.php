<?php 

include_once '../dbconn.php';

session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}



if(isset($_POST['edit_profile_submit'])){

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
                    <span><strong>Account ID: </strong> <?php echo $view_profile['acc_id']; ?> </span><br>
                    <span><strong>Position: </strong> <?php echo $view_profile['position']; ?> </span><br>
                    <span><strong>Username: </strong> <?php echo $view_profile['username']; ?> </span><br>
                    <span><strong>Name: </strong> <?php echo $view_profile['first_name']." ".$view_profile['middle_name']." ".$view_profile['last_name']; ?> </span><br>
                    <span><strong>Employee ID: </strong> <?php echo $view_profile['emp_id']; ?> </span><br>
                    <form class="edit_profile_form" method="POST">
                        </select><br>
                        <h5>Change Password</h5><br>
                        <label for='currentPword'>Current Password:</label><br>
                        <input type='password' class='viewFields' id='currentPword' name='currentPword' placeholder='Current Password'><br>
                        <label for='newPword'>New Password:</label><br>
                        <input type='password' class='viewFields' id='newPword' name='newPword' placeholder='New Password' ><br/>
                        <label for='confirmPword'>Confirm New Password:</label><br>
                        <input type='password' class='viewFields' id='confirmPword' name='confirmPword' placeholder='Confirm Password' ><br/>
                        <input type='text' id='updateAccID' name='updateAccID' placeholder='' style='visibility:hidden' value='<?php echo $view_profile['acc_id']; ?>'>
                        <input class='button' type='submit' name='edit_profile_submit' value='Save Changes'>
                    </form>
                </div>
            </div>
        </div>
        
        

   

    </div>
        
      

</body>
</html>