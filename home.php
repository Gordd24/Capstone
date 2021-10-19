<?php
session_start();
if(!isset($_SESSION['Username'])){
    header("Location: index.php");
}
include_once 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/navigation.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <a href="./account_management.php">
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


</body>
</html>