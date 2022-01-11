<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
include_once '../dbconn.php';


$view = $_POST['view'];
$sql = "SELECT * FROM tbl_accounts where emp_id = '".$view."'";
$result = $conn -> query($sql);


if($result->num_rows>0)
{
    $viewAcc = $result -> fetch_assoc();
    echo    "

    <form id='view_form' method='POST'>
        <div class='immutable'>
            <div class='edit_acc_cont acc_id'>
                <label for='acc_id'>Account ID:</label><br>
                <input type='text' id='acc_id' name='acc_id' value='".$viewAcc['acc_id']."' readonly>
            </div>
        </div>


        <div class='mutable'>
            <h4>Double Click any of the following fields to update information</h4> 

    <div class='edit_acc_cont username'>
        <label for='viewUname'>Username: *</label><br>
        <input type='text' class='viewFields' id='viewUname' name='viewUname' placeholder='Username' required='' value='".$viewAcc['username']."'  required readonly>
        <span></span>
    </div>

    <div class='edit_acc_div name'>
        <div class='edit_acc_cont fname'>
            <label for='viewFname'>First Name: *</label><br>
            <input type='text' class='viewFields name' id='viewFname' name='viewFname' placeholder='First Name' required='' value='".$viewAcc['first_name']."'  required readonly>
        </div>

        <div class='edit_acc_cont mname'>
            <label for='viewMname'>Middle Name:</label><br>
            <input type='text' class='viewFields name' id='viewMname' name='viewMname' placeholder='Middle Name' value='".$viewAcc['middle_name']."'  readonly>
        </div>

        <div class='edit_acc_cont lname'>
            <label for='viewLname'>Last Name: *</label><br>
            <input type='text' class='viewFields name' id='viewLname' name='viewLname' placeholder='Last Name' required='' value='".$viewAcc['last_name']."'  required readonly>
        </div>
    </div>


    <div class='edit_acc_div emp_id_positon'>
        <div class='edit_acc_cont emp_id'>
            <label for='viewEmpId'>Employee ID: *</label><br>
            <input type='text' class='viewFields id' id='viewEmpId' name='viewEmpId' placeholder='Employee ID' required='' value='".$viewAcc['emp_id']."'  required readonly>
        </div>

        <div class='edit_acc_cont position'>
        <label for='viewPosition'>Position: *</label><br>
            ";

            echo"
            <select id='viewPosition' class='viewFields' name='viewPosition' selected='Doctor'>";

            if($viewAcc['position']=="Administrator")
            {
                echo " <option value='Administrator' selected='selected' disabled>Administrator</option>
                    <option value='Doctor' disabled>Doctor</option>
                    <option value='Nurse' disabled>Nurse</option>";
            }
            else if($viewAcc['position']=="Doctor")
            {
                echo " <option value='Administrator' disabled>Administrator</option>
                    <option value='Doctor' selected='selected' disabled>Doctor</option>
                    <option value='Nurse' disabled>Nurse</option>";
            }
            else if($viewAcc['position']=="Nurse")
            {
                echo " <option value='Administrator' selected='selected' disabled>Administrator</option>
                    <option value='Doctor' disabled>Doctor</option>
                    <option value='Nurse' selected='selected' disabled>Nurse</option>";
            }
            
            


            echo"    
            </select>
        </div>
    </div>
    </div>
    <div class='mutable'>
    <div class='edit_acc_cont new_password'>
        <label for='newPword'>New Password: *</label><br>
        <input type='password' class='viewFields' id='newPword' name='newPword' placeholder='New Password' required readonly>
    </div>

    <div class='edit_acc_cont confirm_new_password'>
        <label for='confirmPword'>Confirm New Password: *</label><br>
        <input type='password' class='viewFields' id='confirmPword' name='confirmPword' placeholder='Confirm Password' required readonly>
    </div>
    </div>

        <input class='button'  type='submit' name='saveChangesButton' value='Apply Changes'>

        </form>
        
        ";
        

}


?>