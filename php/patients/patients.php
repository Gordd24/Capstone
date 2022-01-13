<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

include_once '../dbconn.php';

$limit = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;



$get_count_stmt = $connection->prepare("SELECT count(patient_id) as id FROM tbl_patients;");
/* Prepared statement, stage 2: bind and execute */ 
$get_count_stmt->execute();
$count_result = $get_count_stmt->get_result();
$count_row = $count_result->fetch_array(MYSQLI_ASSOC);
$total = $count_row['id']; 
$pages =  ceil($total/$limit);   
$Previous = $page - 1;
$Next = $page + 1; 


$connection->real_query("SELECT * FROM tbl_patients ORDER BY date_added DESC,time_added DESC LIMIT $start,$limit");
$patients_result = $connection->use_result();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
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

    <div class="row my-3">
        <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-10 mx-5 my-3">
                                <h2>Patients</h2>
                            </div>
                        </div>
                        <!-- search-box -->
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-4">
                                <form>
                                        <div class="form-group shadow-lg">
                                            <input type="text" class="form-control" id="search_patient" placeholder="Search Patient" autocomplete="off">
                                        </div>
                                </form>
                            </div>
                        </div>
                        <!-- search-box -->
                       
            
                        <!-- table row  -->
                        <div class="row justify-content-center">
                            <div class="col-md-10">

                                 <!-- add button -->
                                <div class="row my-2">
                                    <div class="col-4 col-md-2">
                                        <form>
                                               <a href="add_patient.php"> 
                                                   <div class="form-group btn add_patient text-white">
                                                        Add Patient
                                                   </div>
                                               </a>
                                        </form>
                                    </div>
                                    <div class="col-8 col-md-10">

                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination">
                                                                
                                                                <?php

                                                                    if($Previous>0)
                                                                    {
                                                                       echo' <li class="page-item">
                                                                            <a class="page-link" href="patients.php?page='.$Previous.'">Previous</a>
                                                                        </li>';
                                                                    }else{
                                                                        echo' <li class="page-item disabled">
                                                                            <a class="page-link" href="#">Previous</a>
                                                                        </li>';
                                                                    }


                                                                    for($i=1; $i<=$pages; $i++)
                                                                    {
                                                                        echo '<li class="page-item"><a class="page-link" href="patients.php?page='.$i.'">'.$i.'</a></li>';
                                                                    }

                                                                    
                                                                    if($Next<=$pages)
                                                                    {
                                                                       echo' <li class="page-item">
                                                                            <a class="page-link" href="patients.php?page='.$Next.'">Next</a>
                                                                        </li>';
                                                                    }else{
                                                                        echo' <li class="page-item disabled">
                                                                            <a class="page-link" href="#">Next</a>
                                                                        </li>';
                                                                    }

                                                                ?>

                                                            </ul>
                                                        </nav>

                                                    </div>
                                </div>
                                <!-- add button end-->

                                <table class="table">
                                    <thead class="text-white">
                                        <tr>
                                            <th scope="col">Patient ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php

                                            foreach ($patients_result as $row_patient) {
                                                    echo "
                                                    <tr>
                                                        <th scope='row'>".$row_patient["patient_id"]."</th>
                                                        <td>".$row_patient["first_name"]." ".$row_patient["middle_name"]." ".$row_patient["last_name"]."</td>
                                                        <td>".$row_patient["email"]."</td>
                                                        <td>".$row_patient["status"]."</td>
                                                        <td class='text-center'>
                                                            <i class='bx bxs-user mx-1 btn border view_patient' id='".$row_patient["patient_id"]."' title='View Patient'></i>";

                                                    if($row_patient["status"]=="Admitted"){
                                                        echo "<i class='bx bxs-user-minus mx-1 btn border discharge_patient' id='".$row_patient["patient_id"]."' title='Discharge Patient'></i>";
                                                    }
                                                        
                                                    echo"
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>