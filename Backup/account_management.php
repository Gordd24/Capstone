<?php
session_start();


if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

if(isset($_SESSION["position"]) && $_SESSION["position"]!="Administrator"){
    header("Location:../dashboard/dashboard.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="../../js/NavigationScript.js" type="text/javascript"></script>
    <script src="../../js/view_profile.js" type="text/javascript"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/navigation.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="../../css/nav.css">
    <script src="../../js/nav.js"></script>


    <link rel="stylesheet" href="../../css/account_management.css">
    <script src="../../js/account_management.js"></script>


</head>
<body id='body-pd'>  
    
    <?php //include_once '../navigation_header.php'; 
    include_once '../admin_nav.php'
    ?>
    <div class="height-100 bg-light">
    <!-- <div class="page_content_div"> -->
        <div class="account_management_div">

            <div class="tab">
              <button class="tablinks" id="account_btn">Accounts</button>
              <button class="tablinks" id="registration_btn">Register</button>
            </div>

            <div  id="accounts" class="tab_content">

                    <div class="view_account">
                        <div class='cancel_form_btn_div'>
                            <i class='bx bxs-x-circle'></i>
                        </div>
                        <div class="view_form_div"> </div>
                    </div>           
                    <form class="search_form">
                      <input type="text" class="search_bar" autocomplete="off">
                    </form>
                    
                    <div class="accounts_table_div">
                        <table>     
                            <?php include_once 'fetch_Accounts.php';?>   
                        </table>
                    </div>
                    
            </div>
            <div id="registration" class="tabcontent">
            <div class="registration_div">
                  <form method="post" id="regForm" class="form-signin">
                  <div id="show_message" class="alert alert-success" style="display: none">Insert Success</div>
                  <div id="error" class="alert alert-danger" style="display: none"></div>
                  <div id="error2" class="alert alert-danger" style="display: none"></div>

                <div class="mutable">
                    <div class="reg_cont username">
                          <label>Username: *</label><br>
                          <input type="text" name="regUname" id="regUname" required autocomplete="off">
                    </div> 
                    
                    <div class="reg_cont_div password">
                        <div class="reg_cont password">
                            <label>Password: *</label><br>
                            <input  class="form-control" type="password" name="regPword" id="regPword" required >
                        </div> 

                        <div class="reg_cont confirm_password">
                            <label>Confirm Password: *</label><br>
                            <input  class="form-control" type="password" name="regCPword" id="regCPword" required >
                        </div> 
                    </div>
                      
                    <div class="reg_cont_div name">
                        <div class="reg_cont first_name">
                            <label>First Name: *</label><br>
                            <input class="form-control" type="text" name="regFname" id="regFname" required autocomplete="off">
                        </div> 
                        
                        <div class="reg_cont middle_name">
                            <label>Middle Name:</label><br>
                            <input class="form-control" type="text" name="regMname" id="regMname" autocomplete="off">
                        </div> 
                        
                        <div class="reg_cont last_name">
                            <label>Last Name: *</label><br>
                            <input class="form-control" type="text" name="regLname" id="regLname" required autocomplete="off">
                        </div> 
                    </div>
                      
                    <div class="reg_cont_div emp_id_position">
                        <div class="reg_cont emp_id">
                            <label>Employee ID: *</label><br>
                            <input class="form-control" type="text" name="regEmpId" id="regEmpId" required autocomplete="off">
                            
                        </div>
                        
                        <div class="reg_cont position">
                            <label>Select Position: *</label><br>
                            <select id="regPosition" class="form-select" name="regPosition">
                                    <option value="Administrator">Administrator</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Nurse">Nurse</option>
                                </select>
                        </div>
                    </div>
                     
                    </div>
                    <button type="submit" name="regSubmit" id="regSubmit" class="btn btn-primary">Register</button>
                      

                  </form>
                </div>
            </div>
        </div>  
    </div>
</body>
</html>

