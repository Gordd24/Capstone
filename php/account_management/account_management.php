<?php
session_start();


if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
include_once '../dbconn.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account Management</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/account_management.css">
  <!-- Jquery + bootstrap js + sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" 
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/account_management.js"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&display=swap" rel="stylesheet">
</head>
<body>  
    
    <?php include_once '../navigation_header.php'; ?>

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
            <div id="registration" class="tabcontent" >
              <div class ="container mt-5" style="max-width: 500px">
                  <form method="post" id="regForm" class="form-signin">
                  <div id="show_message" class="alert alert-success" style="display: none">Insert Success</div>
                  <div id="error" class="alert alert-danger" style="display: none"></div>
                  <div id="error2" class="alert alert-danger" style="display: none"></div>
                
                  
                      <div class="form-group">
                          <label>Username:</label>
                          <input class="form-control" type="text" name="regUname" id="regUname" placeholder="mike123">
                          <span></span>
                      </div>
                      <div class="form-group">
                          <label>Password:</label>
                          <input  class="form-control" type="password" name="regPword" id="regPword" placeholder="Sample_Passw0rd">
                      </div>
                      <div class="form-group">
                          <label>Confirm Password:</label>
                          <input  class="form-control" type="password" name="regCPword" id="regCPword" placeholder="Sample_Passw0rd">
                      </div>
                      <div class="form-group">
                          <label>First Name:</label>
                          <input class="form-control" type="text" name="regFname" id="regFname" placeholder="Michael">
                      </div>
                      <div class="form-group">
                          <label>Middle Name (Optional):</label>
                          <input class="form-control" type="text" name="regMname" id="regMname" placeholder="Johnson">
                      </div>
                      <div class="form-group">
                          <label>Last Name:</label>
                          <input class="form-control" type="text" name="regLname" id="regLname" placeholder="Myers">
                      </div>
                      <div class="form-group">
                          <label>Employee ID:</label>
                          <input class="form-control" type="text" name="regEmpId" id="regEmpId" placeholder="123">
                          <span></span>
                      </div>
                      <div class="form-group">
                          <label>Select Position:</label>
                          <select id="regPosition" class="form-select" name="regPosition">
                                <option value="Administrator">Administrator</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Nurse">Nurse</option>
                            </select>
                      </div>
                      
                      <br>
                      <button type="submit" name="regSubmit" id="regSubmit" class="btn btn-primary">Register</button>
                      

                  </form>
              </div>
            </div>
        </div>  
    </div>
</body>
</html>

