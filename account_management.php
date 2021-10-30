<?php
session_start();

//error validator
$errorUname="";
$errorPass="";
$errorCPass="";
$errorEmpId="";
$errorExist="";
?>
<script>

 
</script>
<?php
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
    }
    if($registerPword != $registerCPword){
      $errorPass = "Passwords did not match";
      $errorCPass = "Passwords did not match";
      $errorExist .= $errorPass;

    }
    if($empExist>0){
      $errorEmpId = "Employee ID already exists";
      $errorExist .= $errorEmpId;
      
    }

    //select last_id
    


    if(empty($errorExist)){
      //encrypt password
      $hashedRegisterPword = password_hash($registerPword, PASSWORD_DEFAULT);
      $insertSql = "INSERT INTO tbl_accounts(username, password, first_name, middle_name, last_name, emp_id, position) VALUES ('$registerUname','$hashedRegisterPword','$registerFname','$registerMname','$registerLname','$registerEmpId','$registerPosition');";
      $insert_result = mysqli_query($conn,$insertSql);
      if($insert_result){
        $last_id = mysqli_insert_id($conn);
        
        if($last_id){
          $auto_id = "EMP_".$last_id;
          $auto_id_query = "UPDATE tbl_accounts SET auto_id = '".$auto_id."' WHERE acc_id='".$last_id."'";
          mysqli_query($conn,$auto_id_query);    
        }
      }
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
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
                <form id="reg_form_id" class="registerForm" method="post">
      
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
                  <input id="submit_btn" class="button" type="submit" name="registerButton" value="Register">
                  </form>
            </div>
        </div>  
    </div>
</body>
</html>

