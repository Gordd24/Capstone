<?php
include_once 'dbconn.php';

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
   }
}

echo " <div class=\"title_bar\">
<div class=\"hospital_name\">Ofelia E. Mendoza Maternity and General Hospital</div>
</div>

<div class=\"sidebar active\">

<div class=\"burger_div\">
    <i class='bx bx-menu' id=\"burger\"></i>
</div>

<div class=\"title_logo\">
 <img class=\"logo\" src=\"../../images/ofelia_logo.png\" alt=\"Logo\">
</div>
<ul class=\"nav_list\">
<li>
    <a href=\"../profile/view_profile.php\" id=\"profile_link\">
        <i class='bx bxs-user-circle' ></i>
        <span class=\"name\">&nbsp;".$active_account_name."</span>
    </a>
</li>
<li>
     <a href=\"../dashboard/dashboard.php\" id=\"dashboard_link\">
         <i class='bx bxs-dashboard' ></i>
         <span class=\"dashboard\">&nbsp;Dashboard</span>
    </a>
</li>
<li>
    <a href=\"../record_management/record_management.php\" id=\"record_management_link\">
        <i class='bx bx-library' ></i>
        <span class=\"record_management\">&nbsp;Record Management</span>
    </a>
</li>";
if(isset($_SESSION["position"]) && $_SESSION["position"]=="Administrator"){
    echo"
    <li>
        <a href=\"../report_generation/report_generation.php\" id=\"report_generation_link\">
            <i class='bx bxs-report' ></i>
            <span class=\"report_generation\">&nbsp;Generate Report</span>
        </a>
    </li>
    <li>
        <a href=\"../account_management/account_management.php\" id=\"account_management_link\">
            <i class='bx bxs-cog'></i>
            <span class=\"account_management\">&nbsp;Account Management</span>
        </a>
    </li>";
}

echo"
<li>
    <a href=\"../logout.php\" id=\"log_out_a\">
        <i class='bx bx-power-off'></i>
        <span class=\"logout_account\">&nbsp;Log Out</span>
    </a>
</li>

</ul>
</div>
";


?>