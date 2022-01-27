<?php

include_once '../dbconn.php';

date_default_timezone_set('Asia/Manila');

if(isset($_POST['register']))
{

    $today = date("Y-m-d"); 
    $time = date("H:i:s");
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $position = $_POST['position'];
    $emp_id = $_POST['emp_id'];
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    // prepare
    $stmt = $connection->prepare("INSERT INTO tbl_accounts(username, password, first_name, middle_name, last_name, email, emp_id, position,date_created,time_created) VALUES 
    (?,?,?,?,?,?,?,?,?,?);");


    //execute
    $stmt->bind_param("ssssssssss",$username,$hashed_pass,$first_name,$middle_name,$last_name,$email,$emp_id,$position,$today,$time); // "is" means that $id is bound as an integer and $label as a string
    $stmt->execute();
    header("Location: account_management.php");

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css -->
    <link rel="stylesheet" href="../../css/account_management.css">
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
 
<div class="container-lg py-1">

    <div class="row">
        <div class="col-12">
            
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-account-tab" data-bs-toggle="tab" data-bs-target="#nav-account" type="button" role="tab" aria-controls="nav-account" aria-selected="true">Accounts</button>
                        <button class="nav-link" id="nav-registration-tab" data-bs-toggle="tab" data-bs-target="#nav-registration" type="button" role="tab" aria-controls="nav-registration" aria-selected="false">Registration</button>
                    </div>
                </nav>
                <div class="row tab-content" id="nav-tabContent">

                    <!-- accounts -->
                    <div class="col tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
                    
                        <!-- search-box -->
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-4">
                                <form>
                                        <div class="form-group shadow-lg">
                                            <input type="text" class="form-control" id="search_account" placeholder="Search Account">
                                        </div>
                                </form>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                
                                <table class="table">
                                    <thead class="text-white">
                                        <tr>
                                            <th scope="col">Account ID</th>
                                            <th scope="col">Employee ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Position</th>
                                            <th scope="col" class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            include_once '../dbconn.php';

                                            $connection->real_query("SELECT * FROM tbl_accounts ORDER BY date_created,time_created DESC");
                                            $accounts_result = $connection->use_result();
                                            foreach ($accounts_result as $row_account) {
                                                
                                                if($row_account['acc_id'] != 37)
                                                {
                                                    echo "
                                                    <tr>
                                                        <th scope='row'>".$row_account["acc_id"]."</th>
                                                        <td>".$row_account["emp_id"]."</td>
                                                        <td>".$row_account["username"]."</td>
                                                        <td>".$row_account["first_name"]." ".$row_account["middle_name"]." ".$row_account["last_name"]."</td>
                                                        <td>".$row_account["position"]."</td>
                                                        <td class='text-center'><i class='bx bxs-trash-alt btn border' id='delete' title='Delete'></i></td>
                                                    </tr>";
                                                }
                                            }
                                                
                                            ?>
                                    
                                    </tbody>
                                </table>


                            </div>
                        </div>

                    </div>
                    <!-- accounts end -->


                    <!-- registration -->
                    <div class="col tab-pane fade" id="nav-registration" role="tabpanel" aria-labelledby="nav-registration-tab">
                        
                        <!-- container row -->
                        <div class="row justify-content-center p-3">

                            <!-- container column -->
                            <div class="col-7">

                                <!-- progressbar row container -->
                                <div class="row">
                                    <!-- progressbar column container -->
                                    <div class="col">

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
                                        <form method="POST">
                                            <!-- input group -->
                                            <div class="row input_group active_group" id="account_group">

                                                <div class="col">

                                                    <div class="row my-1">
                                                        <div class="col">
                                                            <h3>Account Information</h3>
                                                        </div>
                                                     </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" required autocomplete="off" >
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required autocomplete="off" >
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg btn-primary m-3 p-2" id="account_next_btn">
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
                                                            <h3>Personal Information</h3>
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="first_name" class="form-label">First Name *</label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name" required autocomplete="off" > 
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="middle_name" class="form-label">Middle Name</label>
                                                            <input type="text" class="form-control" id="middle_name" name="middle_name" autocomplete="off" >
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="last_name" class="form-label">Last Name *</label>
                                                            <input type="text" class="form-control" id="last_name" name="last_name" required autocomplete="off" >
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg btn-secondary m-3 p-2" id="personal_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 btn shadow-lg btn-primary m-3 p-2" id="personal_next_btn">
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
                                                            <h3>Employee Information</h3>
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="position" class="form-label">Position</label>
                                                            <select class="form-select" id="position" name="position" aria-label="Default select example">
                                                                <option value="Administrator">Administrator</option>
                                                                <option value="Doctor">Doctor</option>
                                                                <option value="Nurse">Nurse</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row my-1 my-2">
                                                        <div class="col">
                                                            <label for="emp_id" class="form-label">Employee ID</label>
                                                            <input type="text" class="form-control" id="emp_id" name="emp_id" required autocomplete="off">
                                                        </div>
                                                    </div>


                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg btn-secondary m-3 p-2" id="emp_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 m-3">
                                                                    <input type="submit" class="form-control btn btn-primary p-2" name="register" id="emp_submit_btn">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- input group end -->


                                            
                                        </form>
                                    </div>
                                    <!-- form col container end -->
                                </div>
                                <!-- form row container end -->

                            </div>
                             <!-- container column end -->

                        </div>
                         <!-- container row end -->

                    </div>
                    <!-- registration end -->                      

                </div>
        </div>
    </div>
    

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>