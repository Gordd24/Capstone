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
  <title>Account Management</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/tabtest.css">
</head>
<style>
  .tab button.active {
  background-color: #ccc;
}
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
</style>
<body>

<!-- <div class="sidebar">
  
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
</div>  -->

<div class="account_management_div">
 
  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'Accounts')">Accounts</button>
    <button class="tablinks" onclick="openTab(event, 'Register')">Register</button>
  </div>

  <div  id="Accounts" class="tabcontent">
    <div class="search_bar">
      <form>
        <input type="text">
      </form>
    </div>
      <table border="1">
            
        <tr>
            <th>Employee ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Action</th>
        </tr>

        <?php include_once 'fetch_Accounts.php';?>   
      </table>
    </div>
  
  <div id="Register" class="tabcontent">
    <h3>Register</h3>
    
  </div>
</div>

<script>
    function openTab(evt, content) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }


      document.getElementById(content).style.display = "block";
      evt.currentTarget.className += " active";
    }
  </script>


</body>
</html>

