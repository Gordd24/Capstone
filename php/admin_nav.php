<?php
include_once '../dbconn.php';
if (!isset($_SESSION)) {
    session_start();
  }
 

$ID = $_SESSION['ID'];
 
 $sql = "SELECT * FROM tbl_accounts where acc_id = '$ID'";
 $result = $conn -> query($sql);
 $active_account_name = "";
  
 if($result->num_rows>0)
 {
    while($row = $result -> fetch_assoc())
    {
         $active_account_name = $row['first_name']." ".$row['last_name']; 
         echo '
        <header class="header" id="header">
            <div class="header_toggle"> <i class="bx bx-menu" id="header-toggle"></i> </div>
            <div>  Ofelia L. Mendoza Maternity and General Hospital </div>
            <!-- <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div> -->
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav nav_class"> 
                <div> 
                    <div class="title_logo">
                        <img class="logo" src="../images/ofelia_logo.png" alt="Logo">
                    </div>
                    <!-- <a href="#" class="nav_logo"> <i class="bx bx-layer nav_logo-icon"></i> <span class="nav_logo-name">OLMMGH</span> </a> -->
                    <div class="nav_list"> 
                        <a href="../profile/view_profile.php" class="nav_link" id="profile_link"> <i class="bx bxs-user-circle nav_icon"></i> <span class="nav_name">'.$active_account_name.'</span> </a> 
                        <a href="../dashboard/dashboard.php" class="nav_link" id="dashboard_link"> <i class="bx bxs-dashboard nav_icon"></i> <span class="nav_name">Dashboard</span> </a> 
                        <a href="../patients_record_management/patients_records.php" class="nav_link" id="record_management_link"> <i class="bx bx-library nav_icon"></i> <span class="nav_name">Records Management</span> </a> 
                        <a href="../patients/patients.php" class="nav_link"> <i class="bx bxs-user-badge nav_icon"></i> <span class="nav_name">Patients</span> </a>
                        ';
                        if(isset($_SESSION["position"]) && $_SESSION["position"]=="Administrator"){
                        echo' 
                        <a href="../account_management/account_management.php" class="nav_link" id="account_management_link"> <i class="bx bxs-cog nav_icon"></i> <span class="nav_name">Accounts Management</span> </a> 
                        <a href="../report_generation/report_generation.php" class="nav_link" id="report_generation_link"> <i class="bx bxs-report nav_icon"></i> <span class="nav_name">Generate Reports</span> </a>
                        ';}
                        echo'
                        <!-- <a href="#" class="nav_link"> <i class="bx bx-bar-chart-alt-2 nav_icon"></i> <span class="nav_name">Stats</span> </a> -->
                    </div>
                </div> 
                <a href="../logout.php" class="nav_link"> <i class="bx bx-log-out nav_icon"></i> <span class="nav_name">Log out</span> </a>
            </nav>
        </div>';
    }
 }

?>