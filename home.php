<?php
session_start();
if(!isset($_SESSION['Username'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Title of the document</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/home.css">
</head>
<body>

<div class="sidebar">
  
     <div class="logo">
         <i class='bx bxl-firebase' ></i>
     </div>

    <i class='bx bx-menu' id="burger"></i>
    <ul class="nav_list">
        <li>
            <a href="#">
                <i class='bx bxs-user-circle' ></i>
                <span class="username"><?php echo $_SESSION['Username']; ?></span>
            </a>
        </li>
        <li>
             <a href="#">
                 <i class='bx bxs-dashboard' ></i>
                 <span class="dashboard">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-library' ></i>
                <span class="record_management">Record Management</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-report' ></i>
                <span class="report_generation">Generate Report</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-cog'></i>
                <span class="account_management">Account Management</span>
            </a>
        </li>
        <li>
            <a href="logout.php">
                <i class='bx bxs-log-out'></i>
                <span class="logout_account">Logout</span>
            </a>
        </li>
    </ul>
</div>
<div class="title_bar">
    <div class="hospital_name">
        Ofelia E. Mendoza Maternity and General Hospital
    </div>
</div>


</body>
</html>