<?php

include_once 'dbconn.php';

$view = $_POST['view'];
$sql = "SELECT * FROM tbl_accounts where emp_id = '".$view."'";
$result = $conn -> query($sql);


if($result->num_rows>0)
{
    $viewAcc = $result -> fetch_assoc();
    echo    "<form id='view_form' method='POST' action='update_account.php'>
        <label for='viewUname'>Username:</label>
        <input type='text' class='viewFields' id='viewUname' name='viewUname' placeholder='Username' required='' value='".$viewAcc['username']."'><br/>
        <label for='viewPword'>Password:</label>
        <input type='text' class='viewFields' id='viewPword' name='viewPword' placeholder='Password' required='' value='".$viewAcc['password']."'><br/>
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
        </select><br/>
        <!-- <input type='text' class='viewFields' name='registerImage' placeholder='User Image' required=''> -->
        <input type='text' id='updateAccID' name='updateAccID' placeholder=''style='visibility:hidden' value='".$viewAcc['emp_id']."'>
        <input class='button' class='' type='submit' name='saveChangesButton' value='Save Changes'>
        </form>";

}


?>