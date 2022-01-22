<?php
include_once 'dbconn.php';

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
    header("Location: ../index.php");
}
if(isset($_SESSION['ID'])){
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/favicon.ico" />
    <link rel="stylesheet" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/pass_reset.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Change Password</title>

</head>
<body>

        <div class="container-fluid">
            <div class="row justify-content-center mx-2">
                <div class="col-12 col-sm-4">
                                <div class="row border rounded shadow-lg my-4 p-3">
                                    <div class="col">

                                        <h2 class="text-center">Change Password</h2>   
                                        <form method="post" id="reset_form" >
                                            <div class="row my-4">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label><strong>Password:</strong></label>
                                                        <input type="password"  id='new_password' name="new_password"  class="form-control"/>
                                                        <div class="error" id="password_error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row my-4">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label><strong>Confirm Password:</strong></label>
                                                        <input type="password" id='confirm_password' name="confirm_password"  class="form-control"/>
                                                        <div class="error" id="cpassword_error"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col text-center">
                                                    <div class="form-group">
                                                        <input type="submit" value="Apply Changes" name='submit_pass'  class="btn text-white" style="background-color: rgb(27, 73, 101)"/>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </form>

                                    </div>
                                </div>

                </div>
            </div>
        </div>


    </body>


</html>