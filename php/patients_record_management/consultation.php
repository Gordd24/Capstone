<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/favicon.ico" />
    <title>Consultation</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css -->
    <link href='../../css/patients_records.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/nav.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/patients_records.js"></script>
    <script src="../../js/nav.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body id="body-pd">

<?php include_once '../admin_nav.php';?>

<div class="container-lg">

    <!-- pre values -->
    <?php
    include_once '../dbconn.php';
    $sql = "SELECT acc_id,first_name,last_name,position FROM tbl_accounts WHERE position NOT IN ('Medical Technologist')";
    $all_accounts = mysqli_query($conn,$sql);

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        /* Prepared statement, stage 1: prepare */
        $stmt = $connection->prepare("SELECT * FROM tbl_patients where patient_id = ?");

        /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $sex_field = '';

        if($row['sex']=='Male')
        {
            $sex_field .= '<div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="Male" checked>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>';
        }else if($row['sex']=='Female')
        {
            $sex_field .= '<div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="Female" checked>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>';
        }
    }

    ?>

    <div class="row justify-content-center p-5">
        <div class="col-7">

                                <!-- title row container -->
                                <div class="row my-3 ">
                                    <!-- title column container -->
                                    <div class="col text-center">
                                        <h3>Consultation Form</h3>
                                    </div>
                                </div>
                                <!-- title row container end -->

                                <!-- progressbar row container -->
                                <div class="row">
                                    <!-- progressbar column container -->
                                    <div class="col">

                                        <!-- actual progress bar -->
                                        <div class="progress shadow-lg">
                                            <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- progressbar row container end -->

                              
                                

                               <!-- form row container -->
                                <div class="row my-5">
                                     <!-- form col container-->
                                    <div class="col">
                                        <form method="POST" id='consultation_form'>
                                             <!-- input group -->
                                            <div class="row input_group active_group" id="consultation_personal_group">

                                                <div class="col">

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <h5>Personal Information</h5>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="patient_id" class="form-label">Patient ID</label>
                                                            <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $row['patient_id']; ?>"  required autocomplete="off" readonly> 
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="first_name" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name"  value="<?php echo $row['first_name']; ?>" required autocomplete="off" readonly> 
                                                        </div>
                                                        <div class="col">
                                                            <label for="middle_name" class="form-label">Middle Name</label>
                                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $row['middle_name']; ?>" autocomplete="off" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="last_name" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required autocomplete="off" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="birthday" class="form-label">Date of Birth</label>
                                                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $row['birthdate']; ?>" required autocomplete="off" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="address" class="form-label required">Address</label>
                                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>" required autocomplete="off">
                                                            <div class="error" id="address_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">

                                                        <div class="col-6">
                                                            <label for="contact_no" class="form-label required">Contact No.</label>
                                                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo $row['contact_no']; ?>" required autocomplete="off">
                                                            <div class="error" id="contact_error"></div>
                                                        </div>

                                                    
                                                        <div class="col-2">
                                                            <label for="age" class="form-label required">Age</label>
                                                            <input type="number" min='0' class="form-control" id="age" name="age" required autocomplete="off">
                                                            <div class="error" id="age_error"></div>
                                                        </div>

                                                        <!-- radio button -->
                                                        <div class="col-4">

                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label required">Sex</label>
                                                                </div>
                                                            </div>

                                                            <?php echo $sex_field; ?>
        
                                                        </div>
                                                        <!-- radio button end-->

                                                    </div>
                                                    
                                                    
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="consultation_personal_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                   

                                                </div>

                                            </div>
                                            <!-- input group end -->

                                            <!-- input group -->
                                            <div class="row input_group" id="vital_group">

                                                <div class="col">

                                                    <div class="row my-1">
                                                        <div class="col">
                                                            <h5>Vital Signs</h5>
                                                        </div>
                                                     </div>

                                                     <div class="row my-3">
                                                        <div class="col">
                                                            <label for="weight" class="form-label required">Weight</label>
                                                            <input type="text" class="form-control" id="weight" name="weight" required autocomplete="off">
                                                            <div class="error" id="weight_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="bp" class="form-label required">Blood Pressure</label>
                                                            <input type="text" class="form-control" id="bp" name="bp" required autocomplete="off">
                                                            <div class="error" id="bp_error"></div>
                                                        </div>
                                                        <div class="col">
                                                            <label for="temp" class="form-label required">Temperature</label>
                                                            <input type="text" class="form-control" id="temp" name="temp" required autocomplete="off">
                                                            <div class="error" id="temp_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="rr" class="form-label required">Respiratory Rate</label>
                                                            <input type="text" class="form-control" id="rr" name="rr" required autocomplete="off">
                                                            <div class="error" id="rr_error"></div>
                                                        </div>
                                                        <div class="col">
                                                            <label for="pr" class="form-label required">Pulse Rate</label>
                                                            <input type="text" class="form-control" id="pr" name="pr" required autocomplete="off">
                                                            <div class="error" id="pr_error"></div>
                                                        </div>
                                                    </div>


                                                    <div class="row my-4 justify-content-center">
                                                        <div class="col-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="ob_patient">
                                                                <label class="form-check-label" for="ob_patient">
                                                                    Ob Patient?
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3 ob_patient">
                                                        <div class="col">
                                                            <label for="lmp" class="form-label required">Last Menstrual Period</label>
                                                            <input type="text" class="form-control ob" id="lmp" name="lmp" autocomplete="off">
                                                            <div class="error" id="lmp_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3 ob_patient">
                                                        <div class="col">
                                                            <label for="aog" class="form-label required">Age of Gestation</label>
                                                            <input type="text" class="form-control ob" id="aog" name="aog"  autocomplete="off">
                                                            <div class="error" id="aog_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3 ob_patient">
                                                        <div class="col">
                                                            <label for="edc" class="form-label required">Estimated Date of Confinement </label>
                                                            <input type="text" class="form-control ob" id="edc" name="edc"  autocomplete="off">
                                                            <div class="error" id="edc_error"></div>
                                                        </div>
                                                    </div>

                                                   

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="vital_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="vital_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                
                                            </div>
                                            <!-- input group end -->

                                            <!-- input group -->
                                            <div class="row input_group" id="complaint_group">

                                                <div class="col">

                                                    <div class="row my-1">
                                                        <div class="col">
                                                            <h5 class='required'>Chief Complaint</h5>
                                                        </div>
                                                     </div>

                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <textarea class="form-control required" id="complaint" name="complaint" rows="8"></textarea>
                                                                <div class="error" id="complaint_error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="consult_by" class="form-label required">Consulted by:</label>
                                                            <!-- <input type="text" class="form-control" id="consult_by" name="consult_by"> -->
                                                            <select class="form-select"  name="consult_by" id="consult_by">
                                                            <option value="">--Select who consulted the patient--</option>
                                                                <?php
                                                                    while ($account = mysqli_fetch_array(
                                                                        $all_accounts,MYSQLI_ASSOC)):; 
                                                                   ?>
                                                                  
                                                                   <option value="<?php echo $account["first_name"] . " ". $account["last_name"];?>">
                                                                   <?php echo $account["first_name"] . " ". $account["last_name"] ;?>
                                                                </option>
                                                                <?php endwhile?>
                                                            </select>
                                                            <div class="error" id="consult_by_error"></div> 
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="complaint_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 m-3">
                                                                    <input type="submit" class="form-control btn next p-2" name="consultation" id="consult_submit_btn">
                                                                    <input type="hidden" name="hidden_field_consultation" id="hidden_field_consultation" value="form_check">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            <!-- input group end -->


                                            
                                        </form>
                                    </div>
                                    <div class="legend">Fields that have (<span class='required'></span> ) are required. </span></div>
                                    <!-- form col container end -->
                                </div>
                                <!-- form row container end -->
    

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
