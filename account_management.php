<?php
session_start();

//error validator
$errorUname="";
$errorPass="";
$errorCPass="";
$errorEmpId="";
$errorExist="";

if(!isset($_SESSION['Username'])){
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

    

    //if user exists
    $usersql = "SELECT * FROM tbl_accounts WHERE username = '$registerUname'";
    $userResult = mysqli_query($conn,$usersql);
    $userExist = mysqli_num_rows($userResult);

    //if employeeID exists
    $empsql = "SELECT * FROM tbl_accounts WHERE emp_id ='$registerEmpId'"; 
    $empResult = mysqli_query($conn,$empsql);
    $empExist = mysqli_num_rows($empResult);

    if($userExist>0){
      $errorUname = "User already exists";
      $errorExist .= $errorUname;
      // echo '<script type = "text/javascript">';
      // echo 'alert("'.$errorUname.'");';
      // echo '</script>';
    }
    if($registerPword != $registerCPword){
      $errorPass = "Passwords did not match";
      $errorCPass = "Passwords did not match";
      $errorExist .= $errorPass;
      // echo '<script type = "text/javascript">';
      // echo 'alert("'.$errorPass.'");';
      // echo '</script>';
    }
    if($empExist>0){
      $errorEmpId = "Employee ID already exists";
      $errorExist .= $errorEmpId;
      // echo '<script type = "text/javascript">';
      // echo 'alert("'.$errorEmpId.'");';
      // echo '</script>';
    }


    if(empty($errorExist)){
    $insertSql = "INSERT INTO tbl_accounts(username, password, first_name, middle_name, last_name, emp_id, position) VALUES ('$registerUname','$registerPword','$registerFname','$registerMname','$registerLname','$registerEmpId','$registerPosition');";
    mysqli_query($conn,$insertSql);
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script type = "text/javascript">';
    // echo "Swal.fire('Good job!','You clicked the button!','success')";
    echo "alert('insert success')";
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/account_management.js"></script>
  <script src="js/NavigationScript.js" type="text/javascript"></script>
</head>
<body>  
    <div class="title_bar">
        <div class="hospital_name">Ofelia E. Mendoza Maternity and General Hospital</div>
    </div>

    <div class="sidebar active">

        <div class="burger_div">
            <i class='bx bx-menu' id="burger"></i>
        </div>

       <div class="title_logo">
         <img class="logo" src="images/ofelia_logo.png" alt="Logo">
       </div>
      <ul class="nav_list">
        <li>
            <a href="#">
                <i class='bx bxs-user-circle' ></i>
                <span class="name">&nbsp;<?php include_once 'getName.php';?></span>
            </a>
        </li>
        <li>
             <a href="#">
                 <i class='bx bxs-dashboard' ></i>
                 <span class="dashboard">&nbsp;Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-library' ></i>
                <span class="record_management">&nbsp;Record Management</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-report' ></i>
                <span class="report_generation">&nbsp;Generate Report</span>
            </a>
        </li>
        <li>
            <a href="./account_management.php" id="account_management_link">
                <i class='bx bxs-cog'></i>
                <span class="account_management">&nbsp;Account Management</span>
            </a>
        </li>
        <li>
            <a href="logout.php" id="log_out_a">
                <i class='bx bx-power-off'></i>
                <span class="logout_account">&nbsp;Log Out</span>
            </a>
        </li>
        
      </ul>
    </div>

    <div class="page_content_div">
        <div class="account_management_div">

            <div class="tab">
              <button class="tablinks" id="account_btn">Accounts</button>
              <button class="tablinks" id="registration_btn">Register</button>
            </div>

            <div  id="accounts" class="tab_content">
                    <form>
                      <input type="text" class="search_bar" autocomplete="off">
                    </form>
                    <table>     
                        <?php include_once 'fetch_Accounts.php';?>   
                    </table>
            </div>

            <div id="registration" class="tabcontent">
                <form class="registerForm" method="post" action="account_management.php">
      
                  <input type="text" class="registerFields" name="registerUname" placeholder="Username" required="" value="<?php echo isset($_POST['registerUname']) ? $_POST["registerUname"] : "";?>"><br/>
                  <?php if($errorUname): ?>
                  <p class = "errorRegister"><?php echo $errorUname; ?></p>
                  <?php endif; ?>
                 
                  <input type="password" class="registerFields" name="registerPword" placeholder="Password" required=""><br/>
                  <?php if($errorPass): ?>
                  <p class = "errorRegister"><?php echo $errorPass; ?></p>
                  <?php endif; ?>
                  
                  <input type="password" class="registerFields" name="registerCPword" placeholder="Confirm Password" required=""><br/>
                  <?php if($errorPass): ?>
                  <p class = "errorRegister"><?php echo $errorCPass; ?></p>
                  <?php endif; ?>

                  <input type="text" class="registerFields name" name="registerFname" placeholder="First Name" required=""  value="<?php echo isset($_POST['registerFname']) ? $_POST["registerFname"] : '';?>">
                  <input type="text" class="registerFields name" name="registerMname" placeholder="Middle Name"  value="<?php echo isset($_POST['registerMname']) ? $_POST['registerMname'] : '';?>">
                  <input type="text" class="registerFields name" name="registerLname" placeholder="Last Name" required="" value="<?php echo isset($_POST['registerLname']) ? $_POST['registerLname'] : '';?>"><br/>

                  <input type="text" class="registerFields" name="registerEmpId" placeholder="Employee ID" required="" value="<?php echo isset($_POST['registerEmpId']) ? $_POST['registerEmpId'] : '';?>"><br/>
                  <?php if($errorEmpId): ?>
                  <p class = "errorRegister"><?php echo $errorEmpId; ?></p>
                  <?php endif; ?>
                  <label for="position">Position:</label>
                  <select id="position" class="registerFields" name="registerPosition">
                      <option value="Administrator">Administrator</option>
                      <option value="Doctor">Doctor</option>
                      <option value="Nurse">Nurse</option>
                  </select><br/>
                  <!-- <input type="text" class="registerFields" name="registerImage" placeholder="User Image" required=""> -->
                  <input class="button" class="" type="submit" name="registerButton" value="Register">
                  </form>
            </div>

        </div>  
    </div>



</body>
</html>

