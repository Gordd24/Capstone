<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: index.php");
}
include_once 'dbconn.php';

  if(isset($_POST['registerButton'])){

    //post inputs
    $registerUname = $_POST['registerUname'];
    $registerPword = $_POST['registerPword'];
    $registerCPword = $_POST['registerCPword'];
    $registerFname = $_POST['registerFname'];
    $registerMname = $_POST['registerMname'];
    $registerLname = $_POST['registerLname'];
    $registerEmpId = $_POST['registerEmpId'];
    $registerPosition = $_POST['registerPosition'];
    //$registerImage = $_POST['registerImage'];

    //error validator
    $errorUname="";
    $errorPass="";
    $errorExist="";

    //if user exists
    $usersql = "SELECT * FROM tbl_accounts WHERE username = '$registerUname'";
    $userResult = mysqli_query($conn,$usersql);
    $userExist = mysqli_num_rows($userResult);

    if($userExist>0){
      $errorUname = "User already exists";
      $errorExist .= $errorUname;
      echo '<script type = "text/javascript">';
      echo 'alert("'.$errorUname.'");';
      echo '</script>';
    }
    if($registerPword != $registerCPword){
      $errorPass = "Passwords did not match";
      $errorExist .= $errorPass;
      echo '<script type = "text/javascript">';
      echo 'alert("'.$errorPass.'");';
      echo '</script>';
    }

    if(empty($errorExist)){
    $insertSql = "INSERT INTO tbl_accounts(username, password, first_name, middle_name, last_name, emp_id, position) VALUES ('$registerUname','$registerPword','$registerFname','$registerMname','$registerLname','$registerEmpId','$registerPosition');";
    mysqli_query($conn,$insertSql);
    echo '<script type = "text/javascript">';
      echo 'alert("insert success");';
      echo '</script>';

    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account Management</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/account_management.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/account_management.js"></script>
  <script src="js/NavigationScript.js" type="text/javascript"></script>
</head>
<body>  
    
    <?php include_once 'navigation_header.php'; ?>

    <div class="page_content_div">
        <div class="account_management_div">

            <div class="tab">
              <button class="tablinks" id="account_btn">Accounts</button>
              <button class="tablinks" id="registration_btn">Register</button>
            </div>

            <div  id="accounts" class="tab_content">

                    <div class="view_account">
                      <i class='bx bxs-x-circle'></i>
                      <div class="view_form_div"> </div>
                    </div>           
                    <form class="search_form">
                      <input type="text" class="search_bar" autocomplete="off">
                    </form>
                    <table>     
                        <?php include_once 'fetch_Accounts.php';?>   
                    </table>
            </div>

            <div id="registration" class="tabcontent">
                <form class="registerForm" method="post" action="account_management.php">
                  <input type="text" class="registerFields" name="registerUname" placeholder="Username" required=""><br/>
                  <input type="password" class="registerFields" name="registerPword" placeholder="Password" required=""><br/>
                  <input type="password" class="registerFields" name="registerCPword" placeholder="Confirm Password" required=""><br/>
                  <input type="text" class="registerFields name" name="registerFname" placeholder="First Name" required="">
                  <input type="text" class="registerFields name" name="registerMname" placeholder="Middle Name" >
                  <input type="text" class="registerFields name" name="registerLname" placeholder="Last Name" required=""><br/>
                  <input type="text" class="registerFields id" name="registerEmpId" placeholder="Employee ID" required="">
                  <label for="position">Position:</label>
                  <select id="position" class="registerFields" name="registerPosition">
                      <option value="Administrator">Administrator</option>
                      <option value="Doctor">Doctor</option>
                      <option value="Nurse">Nurse</option>
                  </select><br/>
                  <!-- <input type="text" class="registerFields" name="registerImage" placeholder="User Image" required=""> -->
                  <input class="button" type="submit" name="registerButton" value="Register">
                  </form>
            </div>

        </div>  
    </div>



</body>
</html>

