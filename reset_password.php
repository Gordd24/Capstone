<?php
include_once 'php/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/pass_reset.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Reset Password</title>

</head>
<body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                    
                    if (isset($_GET["key"]) && isset($_GET['email']) && isset($_GET["categ"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST['action'])){
                        $key = $_GET['key'];
                        $categ = $_GET['categ'];
                        $email = $_GET['email'];
                        $curDate = date("Y-m-d H:i:s");
                        $stmt = $connection->prepare('SELECT * FROM tbl_password_reset WHERE email_key=?');
                        $stmt -> bind_param('s', $key);
                        $stmt -> execute();
                        // $stmt -> store_result();
                        $result = $stmt -> get_result();
                        $row = $stmt->num_rows;
                        if ($row == "") {
                            echo 'invalid link';
                        } else {
                            $row = $result-> fetch_array(MYSQLI_ASSOC);
                            $expDate = $row['exp_date'];
                            
                            if ($expDate >= $curDate) {
                                ?> 
                                <div class="row border rounded shadow-lg my-4 p-3">
                                    <div class="col">

                                        <h2 class="text-center">Reset Password</h2>   
                                        <form method="post" id="reset_form" >

                                            <div class="row my-4">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label><strong>Enter New Password:</strong></label>
                                                        <input type="password"  id='new_password' name="new_password"  class="form-control"/>
                                                        <div class="error" id="password_error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row my-4">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label><strong>Re-Enter New Password:</strong></label>
                                                        <input type="password" id='confirm_password' name="confirm_password"  class="form-control"/>
                                                        <div class="error" id="cpassword_error"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                                            <input type="hidden" name="category" value="<?php echo $categ; ?>"/>

                                            <div class="row justify-content-center">
                                                <div class="col text-center">
                                                    <div class="form-group">
                                                        <input type="submit" id="reset" value="Reset Password" name='reset_submit'  class="btn text-white" style="background-color: rgb(27, 73, 101)"/>
                                                        <input type="hidden" name="hidden_field_reset" id="hidden_field_reset" value="form_check">
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </form>

                                    </div>
                                </div>
                                <?php
                            } else {
                                echo '<h2>Link Expired</h2>';
                            }
                        }
                        
                    }
                    ?>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>


    </body>


</html>