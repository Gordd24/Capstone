<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css -->
    <link href='../../css/patients.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/nav.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/patients.js"></script>
    <script src="../../js/nav.js"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body id="body-pd">

<?php include_once '../admin_nav.php';?>

<div class="container-lg">

    <div class="row justify-content-center p-5">
        <div class="col-7">

                                <!-- title row container -->
                                <div class="row my-3 ">
                                    <!-- title column container -->
                                    <div class="col text-center">
                                        <h3>Add Patient</h3>
                                    </div>
                                </div>
                                <!-- title row container end -->

                                <!-- progressbar row container -->
                                <div class="row">
                                    <!-- progressbar column container -->
                                    <div class="col">

                                        <!-- actual progress bar -->
                                        <div class="progress shadow-lg">
                                            <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- progressbar row container end -->

                              
                                

                               <!-- form row container -->
                                <div class="row my-5">
                                     <!-- form col container-->
                                    <div class="col">
                                        <form method="POST" id='patient_form'>

                                             <!-- input group -->
                                            <div class="row input_group active_group" id="patient1_group">

                                                <div class="col">

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <h5>Patient Information</h5>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="first_name" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name" required autocomplete="off"> 
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="middle_name" class="form-label">Middle Name</label>
                                                            <input type="text" class="form-control" id="middle_name" name="middle_name" autocomplete="off"> 
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="last_name" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="last_name" name="last_name" autocomplete="off"> 
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" autocomplete="off"> 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg next border m-3 p-2" id="patient1_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   

                                                </div>

                                            </div>
                                            <!-- input group end -->

                                             <!-- input group -->
                                             <div class="row input_group" id="patient2_group">

                                                <div class="col">

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <h5>Patient Information</h5>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="row my-3">

                                                        <div class="col-8">
                                                            <label for="birthdate" class="form-label">Date of Birth</label>
                                                            <input type="date" class="form-control" id="birthdate" name="birthdate" required autocomplete="off">
                                                        </div>

                                                        <!-- radio button -->
                                                        <div class="col-4">

                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label">Sex</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
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
                                                            </div>
        
                                                        </div>
                                                        <!-- radio button end-->

                                                    </div>



                                                    <div class="row my-3">

                                                        <div class="col">
                                                            <label for="address" class="form-label">Address</label>
                                                            <input type="text" class="form-control" id="address" name="address" required autocomplete="off">
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev border m-3 p-2" id="patient2_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 btn shadow-lg next border m-3 p-2" id="patient2_next_btn">
                                                                    Next
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                

                                                </div>

                                            </div>
                                            <!-- input group end -->


                                            <!-- input group -->
                                            <div class="row input_group" id="patient3_group">

                                                <div class="col">

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <h5>Patient Information (Optional)</h5>
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="occupation" class="form-label">Occupation</label>
                                                            <input type="text" class="form-control" id="occupation" name="occupation" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label for="religion" class="form-label">Religion</label>
                                                            <input type="text" class="form-control" id="religion" name="religion" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <div class="row  justify-content-center">
                                                                <div class="col-4 btn shadow-lg prev border m-3 p-2" id="patient3_prev_btn">
                                                                    Previous
                                                                </div>
                                                                <div class="col-4 m-3">
                                                                    <input type="submit" class="form-control btn next border p-2" name="patient" id="patient_submit_btn">
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


