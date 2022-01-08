<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Result</title>
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
    if(isset($_GET['id'])){
    include_once '../dbconn.php';
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
                                        <h3>Laboratory Result</h3>
                                    </div>
                                </div>
                                <!-- title row container end -->
                                

                               <!-- form row container -->
                                <div class="row my-3">
                                     <!-- form col container-->
                                    <div class="col">
                                        <form method="POST" id='lab_form'  enctype="multipart/form-data">

                                            <!-- input group -->
                                            <div class="row input_group active_group" id="physician_group">  
                                                <div class="col">  

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

                                                    <!-- radio group  -->
                                                    <div class="row my-5">
                                                        <div class="col">

                                                            <div class="row">
                                                                <div class="col">
                                                                    <label>Laboratory Result Type</label>
                                                                </div>
                                                            </div>

                                                            <!-- group 1 -->
                                                            <div class="row my-3">

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="complete_blood_count" value="complete_blood_count" checked>
                                                                        <label class="form-check-label" for="complete_blood_count">
                                                                            Complete Blood Count (CBS)
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="platelet_count" value="platelet_count">
                                                                        <label class="form-check-label" for="platelet_count">
                                                                            Platelet Count
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="blood_typing" value="blood_typing">
                                                                        <label class="form-check-label" for="blood_typing">
                                                                            Blood Typing
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="cross_matching" value="cross_matching">
                                                                        <label class="form-check-label" for="cross_matching">
                                                                            Cross Matching
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- group 1 end -->

                                                            <!-- group 2 -->
                                                            <div class="row my-3">

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="hepatitis_b" value="hepatitis_b">
                                                                        <label class="form-check-label" for="hepatitis_b">
                                                                            Hepatitis B
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="blood_urea_nitrogen" value="blood_urea_nitrogen">
                                                                        <label class="form-check-label" for="blood_urea_nitrogen">
                                                                            Blood Urea Nitrogen
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="creatinine" value="creatinine">
                                                                        <label class="form-check-label" for="creatinine">
                                                                            Creatinine
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="fasting_blood_sugar" value="fasting_blood_sugar">
                                                                        <label class="form-check-label" for="fasting_blood_sugar">
                                                                            Fasting Blood Sugar
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- group 2 end -->

                                                            <!-- group 3 -->
                                                            <div class="row my-3">

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="fecalysis" value="fecalysis">
                                                                        <label class="form-check-label" for="fecalysis">
                                                                            Fecalysis
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="cholesterol" value="cholesterol">
                                                                        <label class="form-check-label" for="cholesterol">
                                                                            Cholesterol
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="uric_acid" value="uric_acid">
                                                                        <label class="form-check-label" for="uric_acid">
                                                                            Uric Acid
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">                                               
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="result" id="urinalysis" value="urinalysis">
                                                                        <label class="form-check-label" for="urinalysis">
                                                                            Urinalysis
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- group 3 end -->


                                                        </div>
                                                    </div>

                                                    <!-- radio group end -->

                                                    <div class="row my-5">
                                                        <div class="col">                                               
                                                                <label for="lab_res" class="form-label"><i class='bx bx-test-tube'></i> Upload Laboratory Result</label>
                                                                <input class="form-control file_upload" type="file" id="patient_lab_res" name="patient_lab_res">
                                                                <input type="hidden" name="hidden_field_labres" id="hidden_field_labres" value="form_check">
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 m-3">
                                                                    <input type="submit" class="form-control btn next p-2" name="labres" id="laboratory_submit_btn">
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







