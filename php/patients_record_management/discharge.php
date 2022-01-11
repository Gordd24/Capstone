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
    <title>Discharge</title>
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
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        /* Prepared statement, stage 1: prepare */
        $stmt = $connection->prepare("SELECT * FROM tbl_patients where patient_id = ?");

        /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

}

    ?>

    <div class="row justify-content-center p-5">
        <div class="col-7">

                                <!-- title row container -->
                                <div class="row my-3 ">
                                    <!-- title column container -->
                                    <div class="col text-center">
                                        <h3>Discharge Form</h3>
                                    </div>
                                </div>
                                <!-- title row container end -->

                                <!-- progressbar row container -->
                                <div class="row">
                                    <!-- progressbar column container -->
                                    <div class="col">

                                        <!-- actual progress bar -->
                                        <div class="progress shadow-lg">
                                            <div class="progress-bar" role="progressbar" style="width: 16%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- progressbar row container end -->

                              
                                

                               <!-- form row container -->
                                <div class="row my-5">
                                     <!-- form col container-->
                                    <div class="col">
                                        <form method="POST" id='discharge_form'>

                                             <!-- input group -->
                                            <div class="row input_group active_group" id="discharge_personal_group">

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
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="discharge_personal_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   

                                                </div>

                                            </div>
                                            <!-- input group end -->

                                            <!-- input group -->
                                            <div class="row input_group" id="discharging_group">

                                                <div class="col">

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <h5>Discharging Information</h5>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="date_discharged" class="form-label">Date Discharged</label>
                                                            <input type="date" class="form-control" id="date_discharged" name="date_discharged" autocomplete="off"> 
                                                            <div class="error" id="date_error"></div>
                                                        </div>
                                                        <div class="col">
                                                            <label for="time_discharged" class="form-label">Time Discharged</label>
                                                            <input type="time" class="form-control" id="time_discharged" name="time_discharged" autocomplete="off"> 
                                                            <div class="error" id="time_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="discharged_by" class="form-label">Discharged By</label>
                                                            <input type="text" class="form-control" id="discharged_by" name="discharged_by" autocomplete="off"> 
                                                            <div class="error" id="dischargeby_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="discharging_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="discharging_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            <!-- input group end -->

                                             <!-- input group -->
                                             <div class="row input_group" id="transfer_group">

                                                <div class="col">

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <h5>Room Transfer (Optional)</h5>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="transfer_room" class="form-label">Transfer To Room</label>
                                                            <input type="text" class="form-control" id="transfer_room" name="transfer_room"> 
                                                            <div class="error" id="trans_error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="transfer_date" class="form-label">Date</label>
                                                            <input type="date" class="form-control" id="transfer_date" name="transfer_date"> 
                                                            <div class="error" id="trans_date_error"></div>
                                                        </div>

                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="transfer_time" class="form-label">Time</label>
                                                            <input type="time" class="form-control" id="transfer_time" name="transfer_time"> 
                                                            <div class="error" id="trans_time_error"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="transfer_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="transfer_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                

                                                </div>

                                            </div>
                                            <!-- input group end -->

                                            <!-- input group -->
                                            <div class="row input_group" id="diagnosis_group">
                                                <div class="col">
                                                    <div class="row my-3">
                                                            <div class="col">
                                                                <h5>Final Diagnosis</h5>
                                                            </div>
                                                    </div>    

                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="8"></textarea>
                                                                <div class="error" id="diag_error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="diagnosis_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="diagnosis_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            <!-- input group end -->


                                             <!-- input group -->
                                             <div class="row input_group" id="code_group">

                                                <div class="col">

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <h5>Code</h5>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="icd" class="form-label">ICD 10 CODE</label>
                                                            <input type="text" class="form-control" id="icd" name="icd" autocomplete="off"> 
                                                            <div class="error" id="icd_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="rvs" class="form-label">RVS CODE</label>
                                                            <input type="text" class="form-control" id="rvs" name="rvs" autocomplete="off"> 
                                                            <div class="error" id="rvs_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="code_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 btn shadow-lg next m-3 p-2" id="code_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- input group end -->

                                            <!-- input group -->
                                            <div class="row input_group" id="operation_group">
                                                <div class="col">
                                                    <div class="row my-3">
                                                            <div class="col">
                                                                <h5>Operation/s</h5>
                                                            </div>
                                                    </div>    

                                            

                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <textarea class="form-control" id="operation" name="operation" rows="8"></textarea>
                                                                <div class="error" id="operation_error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                                <div class="col">
                                                                    <h5>Disposition</h5>
                                                                </div>
                                                        </div>   
                                                        
                                                        <div class="row ">
                                                            <div class="col text-center">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="disposition" id="discharged" value="discharged" checked>
                                                                    <label class="form-check-label" for="discharged">Discharged</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="disposition" id="transferred" value="transferred">
                                                                    <label class="form-check-label" for="transferred">Transferred</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="disposition" id="hama" value="hama">
                                                                    <label class="form-check-label" for="hama">HAMA</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="disposition" id="absconded" value="absconded">
                                                                    <label class="form-check-label" for="absconded">Absconded</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="disposition" id="died" value="died">
                                                                    <label class="form-check-label" for="died">Died</label>
                                                                    <input type="hidden" name="hidden_field_discharge" id="hidden_field_discharge" value="form_check">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev m-3 p-2" id="operation_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 m-3">
                                                                    <input type="submit" class="form-control btn next p-2" name="discharge" id="admission_submit_btn">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- input group end -->

                                          
                                            
                                        </form>
                                    </div>
                                    <!-- form col container end -->
                                </div>
                                <!-- form row container end -->
    

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


