<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
if(isset($_SESSION['position']) && $_SESSION['position']!='Administrator'){
    header("Location: ../../index.php");
}
include_once '../dbconn.php';



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/favicon.ico" />
    <title>Report Generation</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css -->
    <link href='../../css/report_generation.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/nav.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/nav.js"></script>
    <script src="report_generation.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body id="body-pd">

<?php include_once '../admin_nav.php';
   
date_default_timezone_set('Asia/Manila');
?>

    <div class="row">
        <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-10 mx-5 my-3">
                                                        <h2>Report Generation</h2>
                                                    </div>
                                                </div>
                                                <!-- table row  -->
                                                <div class="row justify-content-center my-3">
                                                    <div class="col-md-10">


                                                        <table class="table">
                                                            <thead class="text-white">
                                                                <tr>
                                                                    <th scope="col">Available Census Today</th>
                                                                    <th scope="col">Count</th>   
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td scope="col" class="text-white">...</td>
                                                                    <td scope="col" class="text-white">...</td>
                                                                </tr>

                                                                <tr class="total" >
                                                                    <td scope="col">Total Admissions</td>
                                                                    <?php
                                                                        
                                                                     
                                                                        /* Prepared statement, stage 1: prepare */
                                                                        $today = date("Y-m-d"); 

                                                                        $get_admitted_stmt = $connection->prepare("SELECT * FROM tbl_admission where date = ?;");

                                                                        /* Prepared statement, stage 2: bind and execute */
                                                                        $get_admitted_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                        $get_admitted_stmt->execute();
                                                                        $admitted_result = $get_admitted_stmt->get_result();

                                                                        echo '<td scope="col" class="nums">'.$admitted_result->num_rows.'</td>';

                                                                    ?>
                                                                          
                                                                </tr>

                                                                <tr>
                                                                    <td scope="col" class="text-white">...</td>
                                                                    <td scope="col" class="text-white">...</td>
                                                                </tr>

                                                                <!-- discharge -->
                                                                <tr>
                                                                    <td scope="col">Discharge (Discharge)</td>      
                                                                    <?php
                                                                        /* Prepared statement, stage 1: prepare */
                                                                        $today = date("Y-m-d"); 

                                                                        $get_discharge_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'discharged';");

                                                                        /* Prepared statement, stage 2: bind and execute */
                                                                        $get_discharge_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                        $get_discharge_stmt->execute();
                                                                        $discharge_result = $get_discharge_stmt->get_result();

                                                                        echo '<td scope="col" class="nums">'.$discharge_result->num_rows.'</td>';

                                                                    ?>
                                                                </tr>
                                                                <!-- discharge  end-->

                                                                <!-- transferred -->
                                                                <tr>
                                                                    <td scope="col">Discharge (transferred)</td>      
                                                                    <?php
                                                                        /* Prepared statement, stage 1: prepare */
                                                                        $today = date("Y-m-d"); 

                                                                        $get_transferred_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'transferred';");

                                                                        /* Prepared statement, stage 2: bind and execute */
                                                                        $get_transferred_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                        $get_transferred_stmt->execute();
                                                                        $transferred_result = $get_transferred_stmt->get_result();

                                                                        echo '<td scope="col" class="nums">'.$transferred_result->num_rows.'</td>';

                                                                    ?>
                                                                </tr>
                                                                <!-- transferred  end-->

                                                                <!-- hama -->
                                                                <tr>
                                                                    <td scope="col">Discharge (HAMA)</td>      
                                                                    <?php
                                                                        /* Prepared statement, stage 1: prepare */
                                                                        $today = date("Y-m-d"); 

                                                                        $get_hama_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'hama';");

                                                                        /* Prepared statement, stage 2: bind and execute */
                                                                        $get_hama_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                        $get_hama_stmt->execute();
                                                                        $hama_result = $get_hama_stmt->get_result();

                                                                        echo '<td scope="col" class="nums">'.$hama_result->num_rows.'</td>';

                                                                    ?>
                                                                </tr>
                                                                <!-- hama  end-->

                                                                <!-- absconded -->
                                                                <tr>
                                                                    <td scope="col">Discharge (Absconded)</td>      
                                                                    <?php
                                                                        /* Prepared statement, stage 1: prepare */
                                                                        $today = date("Y-m-d"); 

                                                                        $get_absconded_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'absconded';");

                                                                        /* Prepared statement, stage 2: bind and execute */
                                                                        $get_absconded_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                        $get_absconded_stmt->execute();
                                                                        $absconded_result = $get_absconded_stmt->get_result();

                                                                        echo '<td scope="col" class="nums">'.$absconded_result->num_rows.'</td>';

                                                                    ?>
                                                                </tr>
                                                                <!-- absconded  end-->


                                                                <tr>
                                                                    <td scope="col" class="summary">Discharges (Alive)</td>
                                                                    <!-- alive --> 
                                                                    <?php
                                                                            /* Prepared statement, stage 1: prepare */
                                                                            $today = date("Y-m-d"); 

                                                                            $get_alive_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition != 'died';");

                                                                            /* Prepared statement, stage 2: bind and execute */
                                                                            $get_alive_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                            $get_alive_stmt->execute();
                                                                            $alive_result = $get_alive_stmt->get_result();

                                                                            echo '<td scope="col" class="nums">'.$alive_result->num_rows.'</td>';

                                                                        ?>
                                                                    <!-- alive  end-->   
                                                                </tr>

                                                                <tr>
                                                                    <td scope="col" class="summary">Discharges (Deaths)</td>
                                                                    <!-- died --> 
                                                                        <?php
                                                                            /* Prepared statement, stage 1: prepare */
                                                                            $today = date("Y-m-d"); 

                                                                            $get_died_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'died';");

                                                                            /* Prepared statement, stage 2: bind and execute */
                                                                            $get_died_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                            $get_died_stmt->execute();
                                                                            $died_result = $get_died_stmt->get_result();

                                                                            echo '<td scope="col" class="nums">'.$died_result->num_rows.'</td>';

                                                                        ?>
                                                                    <!-- died  end-->      
                                                                </tr>

                                                                <tr class="total"> 
                                                                    <td scope="col">Total Discharges</td>
                                                                    <!-- died --> 
                                                                    <?php
                                                                            /* Prepared statement, stage 1: prepare */
                                                                            $today = date("Y-m-d"); 

                                                                            $get_total_discharge_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ?;");

                                                                            /* Prepared statement, stage 2: bind and execute */
                                                                            $get_total_discharge_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
                                                                            $get_total_discharge_stmt->execute();
                                                                            $total_discharge_result = $get_total_discharge_stmt->get_result();

                                                                            echo '<td scope="col" class="nums">'.$total_discharge_result->num_rows.'</td>';

                                                                        ?>
                                                                    <!-- died  end-->      
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                    
                                                    
                                                    </div>
                                                </div>
                                                <!-- table row end -->
                                                 <!-- add button -->
                                                <div class="row justify-content-center my-3">
                                                    <div class="col-md-10">

                                                        <form action='report.php' method="POST" id='generate_form' enctype="multipart/form-data">
                                                        <div class="row my-4">
                                                                <div class="col-5">                                               
                                                                        <label for="signature" class="form-label required">Upload Signature</label>
                                                                        <input class="form-control file_upload" type="file" id="signature" name="signature">
                                                                        <div class="error" id="sign_error"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col">
                                                                    <div class="row  justify-content-center">
                                                                        <div class="col-4 m-3">
                                                                            <input type="submit" value="Generate Report" class="form-control btn generate text-white" name="generate" id="generate">
                                                                            <input type="hidden" name="hidden_field_generate" id="hidden_field_generate" value="form_check">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- <div class="row justify-content-center">
                                                            <div class="col-md-10 text-center">
                                                                    <a href="display_report.php" target='_blank'> 
                                                                        <div class="btn generate text-white">
                                                                                Generate Report
                                                                        </div>
                                                                    </a>
                                                            </div>
                                                        </div> -->
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- add button end-->
                
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>