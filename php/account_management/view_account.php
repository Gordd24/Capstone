
<head>

<link rel="stylesheet" href="../../css/account_management.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/account_management.js"></script>
</head>


<?php

include_once '../dbconn.php';


$view = $_POST['view'];
$sql = "SELECT * FROM tbl_accounts where emp_id = '".$view."'";
$result = $conn -> query($sql);


if($result->num_rows>0)
{
    $viewAcc = $result -> fetch_assoc();
    echo    "<form id='view_form' method='POST'>
    <div>
    <label for='viewUname'>Username:</label>
    <input type='text' class='viewFields' id='viewUname' name='viewUname' placeholder='Username' required='' value='".$viewAcc['username']."'>
    <span></span><br/>
    </div>
    <label for='viewFname'>Name:</label>
    <input type='text' class='viewFields name' id='viewFname' name='viewFname' placeholder='First Name' required='' value='".$viewAcc['first_name']."'>
    <input type='text' class='viewFields name' id='viewMname' name='viewMname' placeholder='Middle Name' value='".$viewAcc['middle_name']."'>
    <input type='text' class='viewFields name' id='viewLname' name='viewLname' placeholder='Last Name' required='' value='".$viewAcc['last_name']."'><br/>
    <label for='viewEmpId'>Employee ID:</label>
    <input type='text' class='viewFields id' id='viewEmpId' name='viewEmpId' placeholder='Employee ID' required='' value='".$viewAcc['emp_id']."'>
    <label for='viewPosition'>Position:</label>
        ";

        echo"
        <select id='viewPosition' class='viewFields' name='viewPosition' selected='Doctor'>";

        if($viewAcc['position']=="Administrator")
        {
            echo " <option value='Administrator' selected='selected'>Administrator</option>
                   <option value='Doctor'>Doctor</option>
                   <option value='Nurse'>Nurse</option>";
        }
        else if($viewAcc['position']=="Doctor")
        {
            echo " <option value='Administrator'>Administrator</option>
                   <option value='Doctor' selected='selected'>Doctor</option>
                   <option value='Nurse'>Nurse</option>";
        }
        else if($viewAcc['position']=="Nurse")
        {
            echo " <option value='Administrator' selected='selected'>Administrator</option>
                   <option value='Doctor'>Doctor</option>
                   <option value='Nurse' selected='selected'>Nurse</option>";
        }
           
           


        echo"    
        </select><br/><br>
        <h5 style='font-weight:bold;'>Reset Password</h5>
        <!--<div>
        <label for='currentPword'>Current Password:</label>
        <input type='text' class='viewFields' id='currentPword' name='currentPword' placeholder='Current Password'>
        <span></span><br/>
        </div>-->
        <label for='newPword'>New Password:</label>
        <input type='password' class='viewFields' id='newPword' name='newPword' placeholder='New Password' ><br/>
        <label for='confirmPword'>Confirm New Password:</label>
        <input type='password' class='viewFields' id='confirmPword' name='confirmPword' placeholder='Confirm Password' ><br/>
        <!-- <input type='text' class='viewFields' name='registerImage' placeholder='User Image' > -->
        <input type='text' id='updateAccID' name='updateAccID' placeholder=''style='visibility:hidden' value='".$viewAcc['emp_id']."'>
        <input class='button'  type='submit' name='saveChangesButton' value='Save Changes'>
        </form>";

}


?>