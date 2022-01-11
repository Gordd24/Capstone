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
    <title>Account Management</title>
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

                <!-- modal -->
                        <div class="option_modal_div" tabindex="0">
                        <div class="option_modal_exit_div">
                            <i class='bx bxs-x-circle'></i>
                        </div>
                        <div class="modal_options_div">
                            <p class="option_buttons" id="consultation"><i class='bx bx-notepad' ></i> Consultation Record</p>
                            <p class="option_buttons" id="admission"><i class='bx bx-user-plus' ></i> Admission Record</p>
                            <p class="option_buttons" id="med_cert"><i class='bx bx-certification'></i> Medical Certificate</p>
                            <p class="option_buttons" id="lab_res"><i class='bx bx-test-tube'></i> Lab Result</p>
                        </div>
                        </div>
                <!-- modal end -->

                <!-- modal -->
                <div class="option_modal_div2" tabindex="0">
                        <div class="option_modal_exit_div2">
                            <i class='bx bxs-x-circle'></i>
                        </div>
                        <div class="modal_options_div2">
                            <p class="option_buttons2" id="consultation"><i class='bx bx-notepad' ></i> Consultation Record</p>
                            <p class="option_buttons2" id="discharge"><i class='bx bx-user-minus' ></i> Discharge Record</p>
                            <p class="option_buttons2" id="med_cert"><i class='bx bx-certification'></i> Medical Certificate</p>
                            <p class="option_buttons2" id="lab_res"><i class='bx bx-test-tube'></i> Lab Result</p>
                        </div>
                        </div>
                <!-- modal end -->

                <div class="row my-3">
                        <div class="col-12">
                                        <!-- search-box -->
                                        <div class="row my-4 justify-content-center">
                                            <div class="col-md-4">
                                                <form>
                                                        <div class="form-group shadow-lg">
                                                            <input type="text" class="form-control" id="search_patient" placeholder="Search Patient">
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                            
                                        <!-- table row  -->
                                        <div class="row justify-content-center">
                                            <div class="col-md-10">

                                                <table class="table">
                                                    <thead class="text-white">
                                                        <tr>
                                                            <th scope="col">Patient ID</th>
                                                            <th scope="col">Name</th>   
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <?php
                                                            include_once '../dbconn.php';

                                                            $connection->real_query("SELECT * FROM tbl_patients ORDER BY date_added,time_added DESC");
                                                            $patients_result = $connection->use_result();
                                                            foreach ($patients_result as $row_patient) {
                                                                    if($row_patient['record_status']=='Active'){
                                                                        echo "
                                                                        <tr>
                                                                            <th scope='row'>".$row_patient["patient_id"]."</th>
                                                                            <td>".$row_patient["first_name"]." ".$row_patient["middle_name"]." ".$row_patient["last_name"]."</td>
                                                                            <td class='text-center'> ";
                                                                                if($row_patient['status']=="Admitted")    
                                                                                {
                                                                                    echo "<i class='bx bxs-file-plus mx-1 btn border create_record discharge' id='".$row_patient['patient_id']."' title='Create Record'></i>";
                                                                                }else{
                                                                                    echo "<i class='bx bxs-file-plus mx-1 btn border create_record' id='".$row_patient['patient_id']."' title='Create Record'></i>";
                                                                                }                 
                                                                                


                                                                                echo"
                                                                                <i class='bx bxs-folder-open mx-1 btn border view_records' id='".$row_patient['patient_id']."' title='View Records'></i>
                                                                                <i class='bx bxs-archive mx-1 btn border archive' id='".$row_patient['patient_id']."' title='Archive'></i>
                                                                            </td>
                                                                        </tr>";
                                                                    }
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>