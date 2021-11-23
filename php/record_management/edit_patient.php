<?php 

include_once '../dbconn.php';
$patient = $_GET['id'];

if(isset($_POST['edit_patient_submit'])){


    $updateSql = "UPDATE tbl_patients
                  SET first_name='".$_POST['patient_fname']."', middle_name = '".$_POST['patient_mname']."', last_name='".$_POST['patient_lname']."', contact_no='".$_POST['patient_contact_no']."', 
                  sex = '".$_POST['patient_sex']."', religion = '".$_POST['patient_religion']."', address='".$_POST['patient_address']."', occupation = '".$_POST['patient_occupation']."'  WHERE patient_id = '".$patient."';";

    mysqli_query($conn,$updateSql);
    header("Location: record_management.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patient</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>
  <script src="../../js/edit_patient.js" type="text/javascript"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/edit_patient.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
  
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">

        <div class="record_management_div">

            <div class="record_management_edit_div">
                <div class="cancel_edit_patient_btn_div">
                    
                    <?php
                         echo "<a href='view_patient.php?id=".base64_encode(base64_encode($patient))."'><i class='bx bxs-x-circle'></i></a>";
                    ?>
                   <h2>Patient Information</h2> 
                </div>
                <div class="edit_patient_form_div">
                    
                    <?php 
                        
                       
                        $sql = "SELECT * FROM tbl_patients where patient_id = '".$patient."'";
                        $result = $conn -> query($sql);

                        if($result->num_rows>0)
                        {
                            $viewPatient = $result -> fetch_assoc();

                        }    
                    
                    ?>
   
                    <form class="edit_patient_form" method="POST">
                        
                        <div class="mutable">
                        <h4 id='edit_stat'>Double Click Any Field To Enable Edit Mode</h4> 
                            <div class="edit_cont_div name">
                                <div class="edit_cont fname">
                                    <label for="patient_fname">First Name</label><br>
                                    <input id="patient_fname" type="text" name="patient_fname" placeholder="First Name" required="" value="<?php echo $viewPatient['first_name']; ?>" autocomplete="off" readonly>
                                </div>
                                <div class="edit_cont mname">
                                    <label for="patient_mname">Middle Name</label><br>
                                    <input id="patient_mname" type="text" name="patient_mname" placeholder="Middle Name (Optional)" value="<?php echo $viewPatient['middle_name']; ?>" autocomplete="off" readonly>
                                </div>
                                <div class="edit_cont lname">
                                    <label for="patient_lname">Last Name</label><br>
                                    <input id="patient_lname" type="text" name="patient_lname" placeholder="Last Name" required="" value="<?php echo $viewPatient['last_name']; ?>" autocomplete="off" readonly>    
                                </div>
                            </div>

                        <div class="edit_cont_div sex_bday">
                            <div class='edit_cont sex'>
                                <p>Sex</p>
                                <?php
                                    if($viewPatient['sex']=='Male')
                                    {
                                        echo"
                                        <input type='radio' id='patient_sex_male' name='patient_sex' value='Male' checked='checked' readonly>
                                        <label for='patient_sex_male'>Male</label>
                                        <input type='radio' id='patient_sex_female' name='patient_sex' value='Female' readonly>
                                        <label for='patient_sex_female'>Female</label><br><br>";
                                    }
                                    else{
                                        echo"
                                        <input type='radio' id='patient_sex_male' name='patient_sex' value='Male' readonly>
                                        <label for='patient_sex_male'>Male</label>
                                        <input type='radio' id='patient_sex_female' name='patient_sex' checked='checked' value='Female' readonly>
                                        <label for='patient_sex_female'>Female</label><br><br>";
                                    }
                                    
                                ?>
                            </div>
                            <div class='edit_cont bday'>
                                <label for='patient_birthday'>Birthday:</label><br>
                                <input type='date' id='patient_birthday' name='patient_birthday' required='required' value="<?php echo $viewPatient['birthdate']; ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class='edit_cont_div contact_address'>
                            <div class='edit_cont contact'>                
                                <label for="patient_contact_no">Contact No</label><br>
                                <input id="patient_contact_no" type="text" name="patient_contact_no" placeholder="Contact No. (Optional)" value="<?php echo $viewPatient['contact_no']; ?>" autocomplete="off" readonly>
                            </div>
                            <div class='edit_cont address'>   
                                <label for="patient_address">Address</label><br>
                                <input id="patient_address" type="text" name="patient_address" placeholder="Address" required="" value="<?php echo $viewPatient['address']; ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class='edit_cont_div occupation_religion'>
                            <div class='edit_cont occupation'>  
                                <label for="patient_occupation">Occupation</label><br>
                                <input id="patient_occupation" type="text" name="patient_occupation" placeholder="Occupation (Optional)" value="<?php echo $viewPatient['occupation']; ?>" autocomplete="off" readonly>
                            </div>
                            <div class='edit_cont religion'>  
                                <label for="patient_religion">Religion</label><br>
                                <input id="patient_religion" type="text" name="patient_religion" placeholder="Religion (Optional)" value="<?php echo $viewPatient['religion']; ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                        </div>
                        <input class="button" type="submit" name="edit_patient_submit" value="Save Changes" disabled>    
                    </form>
                </div>
            </div>

        </div>
        
        

   

    </div>
        
      

</body>
</html>