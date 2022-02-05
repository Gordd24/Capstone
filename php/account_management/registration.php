<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
if(isset($_SESSION['position']) && $_SESSION['position']!='Administrator'){
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/favicon.ico" />
    <title>Registration</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css -->
    <link href='../../css/account_management.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/nav.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/account_management.js"></script>
    <script src="../../js/nav.js"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body id="body-pd">

<?php include_once '../admin_nav.php';?>
    <div class="row justify-content-center p-5">
        <div class="col-12">

        <!-- container row -->
        <div class="row justify-content-center p-3">

            <!-- container column -->
            <div class="col-7">

                <!-- progressbar row container -->
                <div class="row">
                    <!-- progressbar column container -->
                    <div class="col">
                        <div class="row my-1">
                            <div class="col text-center">
                                <h3>Registration</h3>
                            </div>
                        </div>                   
                        <!-- actual progress bar -->
                        <div class="progress shadow-lg">
                            <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>
                </div>
                <!-- progressbar row container end -->

            <!-- form row container -->
                <div class="row my-5">
                    <!-- form col container-->
                    <div class="col">
                        <form method="POST" id='regform' >
                            <!-- input group -->
                            <div class="row input_group active_group" id="account_group">

                                <div class="col">

                                    <div class="row my-1">
                                        <div class="col">
                                            <h5>Account Information</h5>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="username" class="form-label required">Username</label>
                                            <input type="text" class="form-control account-inputs" id="username" name="username" required autocomplete="off">
                                            <div class="error" id="uname_error"></div>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="email" class="form-label required">Email</label>
                                            <input type="email" class="form-control account-inputs" id="email" name="email" required autocomplete="off">
                                            <div class="error" id="email_error"></div>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="password" class="form-label required">Password</label>
                                            <input type="password" class="form-control account-inputs" id="password" name="password" required autocomplete="off" >
                                            <div class="error" id="pword_error"></div>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="confirm_password" class="form-label required">Confirm Password</label>
                                            <input type="password" class="form-control account-inputs" id="confirm_password" name="confirm_password" required autocomplete="off" >
                                            <div class="error" id="cpword_error"></div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="row  justify-content-center">
                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="account_next_btn">
                                                    Next
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                            <!-- input group end -->


                            <!-- input group -->
                            <div class="row input_group" id="personal_group">

                                <div class="col">

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <h5>Personal Information</h5>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="first_name" class="form-label required">First Name</label>
                                            <input type="text" class="form-control personal-inputs" id="first_name" name="first_name" required autocomplete="off" > 
                                            <div class="error" id="fname_error"></div>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="middle_name" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control personal-inputs" id="middle_name" name="middle_name" autocomplete="off" >
                                            
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="last_name" class="form-label required">Last Name</label>
                                            <input type="text" class="form-control personal-inputs" id="last_name" name="last_name" required autocomplete="off" >
                                            <div class="error" id="lname_error"></div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="row  justify-content-center">
                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="personal_prev_btn">
                                                    Previous
                                                </div>
                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="personal_next_btn">
                                                    Next
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- input group end -->

                            <!-- input group -->
                            <div class="row input_group" id="emp_group">

                                <div class="col">

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <h5>Employee Information</h5>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="position" class="form-label required">Position</label>
                                            <select class="form-select" id="position" name="position" aria-label="Default select example">
                                                <option value="Administrator">Administrator</option>
                                                <option value="Doctor">Doctor</option>
                                                <option value="Nurse">Nurse</option>
                                                <option value="Medical Technologist">Medical Technologist</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row my-1 my-2">
                                        <div class="col">
                                            <label for="emp_id" class="form-label required">Employee ID</label>
                                            <input type="text" class="form-control emp-inputs" id="emp_id" name="emp_id" required autocomplete="off">
                                            <div class="error" id="empid_error"></div>
                                            <input type="hidden" name="hidden_field" id="hidden_field" value="form_check">

                                        </div>
                                    </div>


                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="row  justify-content-center">
                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="emp_prev_btn">
                                                    Previous
                                                </div>
                                                <div class="col-4 m-3">
                                                    <input type="submit" class="form-control btn next p-2 reg-submit" name="register" id="emp_submit_btn">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- input group end -->
                        </form>
                    </div>
                    <div class="legend">Fields that have (<span class='required'></span> ) are required. </span></div>
                    <!-- form col container end -->
                </div>
                <!-- form row container end -->
                
            </div>
            <!-- container column end -->

            </div>
            <!-- container row end -->
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


