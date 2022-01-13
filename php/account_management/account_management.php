<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
if(isset($_SESSION['position']) && $_SESSION['position']!='Administrator'){
    header("Location: ../../index.php");
}
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



$limit = 50;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;


/* Prepared statement, stage 1: prepare */
$get_accounts_stmt = $connection->prepare("SELECT * FROM tbl_accounts where acc_id != ? ORDER BY date_created DESC, time_created DESC LIMIT $start,$limit");

/* Prepared statement, stage 2: bind and execute */
$get_accounts_stmt->bind_param("s", $_SESSION['ID']); // "is" means that $id is bound as an integer and $label as a string
$get_accounts_stmt->execute();
$accounts_result = $get_accounts_stmt->get_result();

$get_count_stmt = $connection->prepare("SELECT count(acc_id) as id FROM tbl_accounts where acc_id != ?;");
/* Prepared statement, stage 2: bind and execute */ 
$get_count_stmt->bind_param("s", $_SESSION['ID']); 
$get_count_stmt->execute();
$count_result = $get_count_stmt->get_result();
$count_row = $count_result->fetch_array(MYSQLI_ASSOC);
$total = $count_row['id']; 
$pages =  ceil($total/$limit);   
$Previous = $page - 1;
$Next = $page + 1; 






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
 


    <div class="row">
        <div class="col-12">

                        <div class="row justify-content-center">
                            <div class="col-10 mx-5 my-3">
                                <h2>Account Management</h2>
                            </div>
                        </div>
                        
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

                                <!-- add button -->
                                <div class="row my-2">
                                    <div class="col-4 col-md-2">
                                        <form>
                                            <a href="registration.php"> 
                                                <div class="form-group btn add_patient text-white">
                                                    Registration
                                                </div>
                                            </a>
                                        </form>
                                    </div>


                                    <div class="col-8 col-md-10">

                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination">
                                                                
                                                                <?php

                                                                    if($Previous>0)
                                                                    {
                                                                       echo' <li class="page-item">
                                                                            <a class="page-link" href="account_management.php?page='.$Previous.'">Previous</a>
                                                                        </li>';
                                                                    }else{
                                                                        echo' <li class="page-item disabled">
                                                                            <a class="page-link" href="#">Previous</a>
                                                                        </li>';
                                                                    }


                                                                    for($i=1; $i<=$pages; $i++)
                                                                    {
                                                                        echo '<li class="page-item"><a class="page-link" href="account_management.php?page='.$i.'">'.$i.'</a></li>';
                                                                    }

                                                                    
                                                                    if($Next<=$pages)
                                                                    {
                                                                       echo' <li class="page-item">
                                                                            <a class="page-link" href="account_management.php?page='.$Next.'">Next</a>
                                                                        </li>';
                                                                    }else{
                                                                        echo' <li class="page-item disabled">
                                                                            <a class="page-link" href="#">Next</a>
                                                                        </li>';
                                                                    }

                                                                ?>

                                                            </ul>
                                                        </nav>

                                    </div>

                                </div>
                                <!-- add button end-->

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

                                            


                                            if($accounts_result->num_rows>0)
                                            {
                                                while($row_account = $accounts_result -> fetch_assoc())
                                                {       
                                                    echo "
                                                    <tr>
                                                        <th scope='row'>".$row_account["acc_id"]."</th>
                                                        <td>".$row_account["emp_id"]."</td>
                                                        <td>".$row_account["username"]."</td>
                                                        <td>".$row_account["first_name"]." ".$row_account["middle_name"]." ".$row_account["last_name"]."</td>
                                                        <td>".$row_account["position"]."</td>
                                                        <td class='text-center'><i class='bx bxs-trash-alt btn border delete' id='".$row_account["acc_id"]."' title='Delete'></i></td>
                                                    </tr>";                  
                                                }
                                            
                                            }
                                                
                                            ?>
                                    
                                    </tbody>
                                </table>


                            </div>
                        </div>            

                </div>
        </div>
    

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>