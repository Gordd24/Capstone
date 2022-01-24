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
    <title>Patient Records</title>
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

<?php include_once '../admin_nav.php';

$id = $_GET['id'];
?>

    <div class="row">
        <div class="col-12 my-5">
            
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-admission-tab" data-bs-toggle="tab" data-bs-target="#nav-admission" type="button" role="tab" aria-controls="nav-admission" aria-selected="true">Admission Records</button>
                        <button class="nav-link" id="nav-consultation-tab" data-bs-toggle="tab" data-bs-target="#nav-consultation" type="button" role="tab" aria-controls="nav-consultation" aria-selected="false">Consultation Records</button>
                        <button class="nav-link" id="nav-medical-tab" data-bs-toggle="tab" data-bs-target="#nav-medical" type="button" role="tab" aria-controls="nav-medical" aria-selected="false">Medical Certificates</button>
                        <button class="nav-link" id="nav-laboratory-tab" data-bs-toggle="tab" data-bs-target="#nav-laboratory" type="button" role="tab" aria-controls="nav-laboratory" aria-selected="false">Laboratory Results</button>
                    </div>
                </nav>
                <div class="row tab-content" id="nav-tabContent">

                    <!-- admission -->
                    <div class="col tab-pane fade show active" id="nav-admission" role="tabpanel" aria-labelledby="nav-admission-tab">
                                    <div class="row my-3">
                                        <div class="col-12">

                                                <!-- SELECT ROW -->
                                                <div class="row justify-content-center m-5">
                                                    <div class="col-3">

                                                        <select class="form-select" id="admission_select_search">
                                                            <option value="year">Search By Year</option>
                                                            <option value="month">Search By Month</option>
                                                            <option value="date">Search By Date</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-1 p-0">
                                                        <div class="btn refresh_btn border admission select_all"  id="<?php echo $id; ?>">
                                                            <i class='bx bx-refresh'></i>
                                                        </div>
                                                    </div>            

                                                    
                                                </div>
                                                <!-- SELECT ROW END -->

                                                <!-- table row  -->
                                                <div class="row justify-content-center">
                                                    <div class="col-md-10">

                                                        <!-- select year row -->
                                                        <div class="row my-2 mx-1 align-items-center admission select_year">
                                                            <div class="col-2 p-0">
                                                                <input type="number" class="form-control" id="admission_select_year" min="1900" max="2099" step="1" value="2016" />
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border admission select_year"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select year row end -->

                                                         <!-- select month row -->
                                                        <div class="row my-2 mx-1 align-items-center admission select_month">

                                                            <div class="col-2 p-0">
                                                                <select class="form-select" id="admission_select_month">
                                                                    <option value="01">January</option>
                                                                    <option value="02">February</option>
                                                                    <option value="03">March</option>
                                                                    <option value="04">April</option>
                                                                    <option value="05">May</option>
                                                                    <option value="06">June</option>
                                                                    <option value="07">July</option>
                                                                    <option value="08">August</option>
                                                                    <option value="09">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border admission select_month"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>

                                                            

                                                            
                                                        </div>
                                                         <!-- select month row end -->  

                                                        <!-- select date row -->
                                                        <div class="row my-2 mx-1  align-items-center admission select_date">
                                                            <div class="col-2 p-0">
                                                                <input type="date" class="form-control" id="admission_select_date"/>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border admission select_date"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select date row end --> 

                                                        <table class="table">
                                                            <thead class="text-white">
                                                                <tr>
                                                                    <th scope="col">File Name</th>
                                                                    <th scope="col">Date</th>   
                                                                    <th scope="col" class="text-center">Action</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody id="admission">
                                                                
                                                                    <?php

                                                                    include_once '../dbconn.php';
                                                                    /* Prepared statement, stage 1: prepare */
                                                                   
                                                                    $get_med_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE patient_id = ? ORDER BY date DESC, record_admission_id DESC;");

                                                                    /* Prepared statement, stage 2: bind and execute */
                                                                    $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
                                                                    $get_med_stmt->execute();
                                                                    $med_result = $get_med_stmt->get_result();

                                                                    while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                                                                        
                                                                        echo "<tr>
                                                                        <td>".$row['file_name']."</td>
                                                                        <td>".$row['date']."</td>
                                                                        <td class='text-center'>
                                                                            <i class='bx bxs-book-open mx-1 btn border open_file admission' id='".$row['file_name']."' title='Open File'></i>
                                                                        </td>
                                                                            </tr>";

                                                                    }
                                                                        

                                                                        
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- table row end -->
                                        </div>
                                    </div>
                       


                    </div>
                    <!-- admission end -->


                    <!-- consultation -->
                    <div class="col tab-pane fade" id="nav-consultation" role="tabpanel" aria-labelledby="nav-consultation-tab">
                                    <div class="row my-3">
                                        <div class="col-12">

                                                <!-- SELECT ROW -->
                                                <div class="row justify-content-center m-5">
                                                    <div class="col-3">

                                                        <select class="form-select" id="consultation_select_search">
                                                            <option value="year">Search By Year</option>
                                                            <option value="month">Search By Month</option>
                                                            <option value="date">Search By Date</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-1 p-0">
                                                        <div class="btn refresh_btn border consultation select_all"  id="<?php echo $id; ?>">
                                                            <i class='bx bx-refresh'></i>
                                                        </div>
                                                    </div>            

                                                    
                                                </div>
                                                <!-- SELECT ROW END -->

                                                <!-- table row  -->
                                                <div class="row justify-content-center">
                                                    <div class="col-md-10">

                                                        <!-- select year row -->
                                                        <div class="row my-2 mx-1 align-items-center consultation select_year">
                                                            <div class="col-2 p-0">
                                                                <input type="number" class="form-control" id="consultation_select_year" min="1900" max="2099" step="1" value="2016" />
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border consultation select_year"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select year row end -->

                                                         <!-- select month row -->
                                                        <div class="row my-2 mx-1 align-items-center consultation select_month">

                                                            <div class="col-2 p-0">
                                                                <select class="form-select" id="consultation_select_month">
                                                                    <option value="01">January</option>
                                                                    <option value="02">February</option>
                                                                    <option value="03">March</option>
                                                                    <option value="04">April</option>
                                                                    <option value="05">May</option>
                                                                    <option value="06">June</option>
                                                                    <option value="07">July</option>
                                                                    <option value="08">August</option>
                                                                    <option value="09">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border consultation select_month"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>

                                                            

                                                            
                                                        </div>
                                                         <!-- select month row end -->  

                                                        <!-- select date row -->
                                                        <div class="row my-2 mx-1  align-items-center consultation select_date">
                                                            <div class="col-2 p-0">
                                                                <input type="date" class="form-control" id="consultation_select_date"/>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border consultation select_date"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select date row end --> 

                                                        <table class="table">
                                                            <thead class="text-white">
                                                                <tr>
                                                                    <th scope="col">File Name</th>
                                                                    <th scope="col">Date</th>   
                                                                    <th scope="col" class="text-center">Action</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody id="consultation">
                                                                
                                                                    <?php

                                                                    include_once '../dbconn.php';
                                                                    /* Prepared statement, stage 1: prepare */
                                                                   
                                                                    $get_med_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE patient_id = ? ORDER BY date DESC, record_cons_id DESC;");

                                                                    /* Prepared statement, stage 2: bind and execute */
                                                                    $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
                                                                    $get_med_stmt->execute();
                                                                    $med_result = $get_med_stmt->get_result();

                                                                    while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                                                                        
                                                                        echo "<tr>
                                                                        <td>".$row['file_name']."</td>
                                                                        <td>".$row['date']."</td>
                                                                        <td class='text-center'>
                                                                        <i class='bx bxs-book-open mx-1 btn border open_file consultation' id='".$row['file_name']."' title='Open File'></i>
                                                                        </td>
                                                                            </tr>";

                                                                    }
                                                                        

                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- table row end -->
                                        </div>
                                    </div>

                    </div>
                    <!-- consultation end -->      
                    
                    <!-- medical -->
                    <div class="col tab-pane fade" id="nav-medical" role="tabpanel" aria-labelledby="nav-medical-tab">

                                <div class="row my-3">
                                        <div class="col-12">

                                                <!-- SELECT ROW -->
                                                <div class="row justify-content-center m-5">
                                                    <div class="col-3">

                                                        <select class="form-select" id="medical_select_search">
                                                            <option value="year">Search By Year</option>
                                                            <option value="month">Search By Month</option>
                                                            <option value="date">Search By Date</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-1 p-0">
                                                        <div class="btn refresh_btn border medical select_all"  id="<?php echo $id; ?>">
                                                            <i class='bx bx-refresh'></i>
                                                        </div>
                                                    </div>            

                                                </div>
                                                <!-- SELECT ROW END -->

                                                <!-- table row  -->
                                                <div class="row justify-content-center">
                                                    <div class="col-md-10">

                                                        <!-- select year row -->
                                                        <div class="row my-2 mx-1 align-items-center medical select_year">
                                                            <div class="col-2 p-0">
                                                                <input type="number" class="form-control" id="medical_select_year" min="1900" max="2099" step="1" value="2016" />
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border medical select_year"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select year row end -->

                                                         <!-- select month row -->
                                                        <div class="row my-2 mx-1 align-items-center medical select_month">

                                                            <div class="col-2 p-0">
                                                                <select class="form-select" id="medical_select_month">
                                                                    <option value="01">January</option>
                                                                    <option value="02">February</option>
                                                                    <option value="03">March</option>
                                                                    <option value="04">April</option>
                                                                    <option value="05">May</option>
                                                                    <option value="06">June</option>
                                                                    <option value="07">July</option>
                                                                    <option value="08">August</option>
                                                                    <option value="09">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border medical select_month"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>

                                                            

                                                            
                                                        </div>
                                                         <!-- select month row end -->  

                                                        <!-- select date row -->
                                                        <div class="row my-2 mx-1  align-items-center medical select_date">
                                                            <div class="col-2 p-0">
                                                                <input type="date" class="form-control" id="medical_select_date"/>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border medical select_date"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select date row end --> 

                                                        <table class="table">
                                                            <thead class="text-white">
                                                                <tr>
                                                                    <th scope="col">File Name</th>
                                                                    <th scope="col">Date</th>   
                                                                    <th scope="col" class="text-center">Action</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody id="medical">
                                                                
                                                                    <?php

                                                                    include_once '../dbconn.php';
                                                                    /* Prepared statement, stage 1: prepare */
                                                                   
                                                                    $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? ORDER BY date DESC, record_med_cert_id DESC;");

                                                                    /* Prepared statement, stage 2: bind and execute */
                                                                    $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
                                                                    $get_med_stmt->execute();
                                                                    $med_result = $get_med_stmt->get_result();

                                                                    while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                                                                        
                                                                        echo "<tr>
                                                                        <td>".$row['file_name']."</td>
                                                                        <td>".$row['date']."</td>
                                                                        <td class='text-center'>
                                                                        <i class='bx bxs-book-open mx-1 btn border open_file medical' id='".$row['file_name']."' title='Open File'></i>
                                                                        </td>
                                                                            </tr>";

                                                                    }
                                                                        

                                                                        
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- table row end -->
                                    </div>
                                </div>

                    </div>
                    <!-- medical end -->  

                    <!-- laboratory -->
                    <div class="col tab-pane fade" id="nav-laboratory" role="tabpanel" aria-labelledby="nav-laboratory-tab">
                                     <div class="row my-3">
                                        <div class="col-12">

                                                <!-- SELECT ROW -->
                                                <div class="row justify-content-center m-5">
                                                    <div class="col-3">
                                                    
                                                        <select class="form-select" id="laboratory_select_search">
                                                            <option value="year">Search By Year</option>
                                                            <option value="month">Search By Month</option>
                                                            <option value="date">Search By Date</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-1 p-0">
                                                        <div class="btn refresh_btn border laboratory select_all"  id="<?php echo $id; ?>">
                                                            <i class='bx bx-refresh'></i>
                                                        </div>
                                                    </div>            

                                                    
                                                </div>
                                                <!-- SELECT ROW END -->

                                                <!-- table row  -->
                                                <div class="row justify-content-center">
                                                    <div class="col-md-10">

                                                        <!-- select year row -->
                                                        <div class="row my-2 mx-1 align-items-center laboratory select_year">
                                                            <div class="col-2 p-0">
                                                                <input type="number" class="form-control" id="laboratory_select_year" min="1900" max="2099" step="1" value="2016" />
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border laboratory select_year"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select year row end -->

                                                         <!-- select month row -->
                                                        <div class="row my-2 mx-1 align-items-center laboratory select_month">

                                                            <div class="col-2 p-0">
                                                                <select class="form-select" id="laboratory_select_month">
                                                                    <option value="01">January</option>
                                                                    <option value="02">February</option>
                                                                    <option value="03">March</option>
                                                                    <option value="04">April</option>
                                                                    <option value="05">May</option>
                                                                    <option value="06">June</option>
                                                                    <option value="07">July</option>
                                                                    <option value="08">August</option>
                                                                    <option value="09">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border laboratory select_month"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>

                                                            

                                                            
                                                        </div>
                                                         <!-- select month row end -->  

                                                        <!-- select date row -->
                                                        <div class="row my-2 mx-1  align-items-center laboratory select_date">
                                                            <div class="col-2 p-0">
                                                                <input type="date" class="form-control" id="laboratory_select_date"/>
                                                            </div>
                                                            <div class="col-1 mx-1 p-0">
                                                                <div class="btn search_btn border laboratory select_date"  id="<?php echo $id; ?>">
                                                                    <i class='bx bx-search'></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- select date row end --> 

                                                        <table class="table">
                                                            <thead class="text-white">
                                                                <tr>
                                                                    <th scope="col">File Name</th>
                                                                    <th scope="col">Date</th>   
                                                                    <th scope="col" class="text-center">Action</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody id="laboratory">
                                                                
                                                                    <?php

                                                                    include_once '../dbconn.php';
                                                                    /* Prepared statement, stage 1: prepare */
                                                                   
                                                                    $get_med_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? ORDER BY date DESC, lab_result_id DESC;");

                                                                    /* Prepared statement, stage 2: bind and execute */
                                                                    $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
                                                                    $get_med_stmt->execute();
                                                                    $med_result = $get_med_stmt->get_result();

                                                                    while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                                                                        
                                                                        echo "<tr>
                                                                        <td>".$row['file_name']."</td>
                                                                        <td>".$row['date']."</td>
                                                                        <td class='text-center'>
                                                                        <i class='bx bxs-book-open mx-1 btn border open_file laboratory' id='".$row['file_name']."' title='Open File'></i>
                                                                        </td>
                                                                            </tr>";

                                                                    }
                                                                        

                                                                        
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- table row end -->
                                        </div>
                                    </div>


                    </div>
                    <!-- laboratory end -->  

                </div>
        </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>