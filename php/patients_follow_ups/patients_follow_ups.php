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
    <title>Patients Request</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css -->
    <link href='../../css/patients_follow_ups.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/nav.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/patients_follow_ups.js"></script>
    <script src="../../js/nav.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body id="body-pd">

<?php include_once '../admin_nav.php';

$limit = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$get_request_stmt = $connection->prepare("SELECT * FROM tbl_requests WHERE request_status = 'sent' ORDER BY request_date,request_time DESC LIMIT ?,?;");
$get_request_stmt ->bind_param("is", $start, $limit);
/* Prepared statement, stage 2: bind and execute */ 
$get_request_stmt->execute();
$request_result = $get_request_stmt->get_result();

$get_count_stmt = $connection->prepare("SELECT count(request_id) as id FROM tbl_requests WHERE request_status = 'sent';");
/* Prepared statement, stage 2: bind and execute */ 
$get_count_stmt->execute();
$count_result = $get_count_stmt->get_result();
$count_row = $count_result->fetch_array(MYSQLI_ASSOC);
$total = $count_row['id']; 
$pages =  ceil($total/$limit);   
$Previous = $page - 1;
$Next = $page + 1; 


?>

    <div class="row">
        <div class="col-12">
                                    <div class="row justify-content-center">
                                        <div class="col-10 mx-5 my-3">
                                            <h2>Patients Follow Ups</h2>
                                        </div>
                                    </div>
                                                <!-- search box -->
                                                <div class="row justify-content-center my-3">
                                                    <div class="col-4">

                                                        <form>
                                                            <div class="form-group shadow-lg">
                                                                <input type="text" class="form-control" id="search_request" placeholder="Search Request">
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                                <!-- search box end -->

                                                <!-- page button -->
                                                <div class="row justify-content-center">
                                                    <div class="col-10">

                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination">
                                                                
                                                                <?php

                                                                    if($Previous>0)
                                                                    {
                                                                       echo' <li class="page-item">
                                                                            <a class="page-link" href="patients_follow_ups.php?page='.$Previous.'">Previous</a>
                                                                        </li>';
                                                                    }else{
                                                                        echo' <li class="page-item disabled">
                                                                            <a class="page-link" href="#">Previous</a>
                                                                        </li>';
                                                                    }


                                                                    for($i=1; $i<=$pages; $i++)
                                                                    {
                                                                        echo '<li class="page-item"><a class="page-link" href="patients_follow_ups.php?page='.$i.'">'.$i.'</a></li>';
                                                                    }

                                                                    
                                                                    if($Next<=$pages)
                                                                    {
                                                                       echo' <li class="page-item">
                                                                            <a class="page-link" href="patients_follow_ups.php?page='.$Next.'">Next</a>
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
                                                <!-- page button end -->

                                                <!-- table row  -->
                                                <div class="row justify-content-center my-1">
                                                    <div class="col-md-10">

                                                        <table class="table">
                                                            <thead class="text-white">
                                                                <tr>
                                                                    <th scope="col">Request ID</th>
                                                                    <th scope="col">Patient ID</th>
                                                                    <th scope="col">Requested Result</th> 
                                                                    <th scope="col">Date</th>  
                                                                    <th scope="col" class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="laboratory">
                                                                
                                                                    <?php
                                                                    
                                                                    include_once '../dbconn.php';
                                                                    /* Prepared statement, stage 1: prepare */
                                                                    

                                                                     


                                                                    while ($row = $request_result->fetch_array(MYSQLI_ASSOC)) {
                                                                        
                                                                        echo "<tr>
                                                                        <td>".$row['request_id']."</td>
                                                                        <td>".$row['patient_id']."</td>
                                                                        <td>".ucwords(str_replace("_"," ",$row['result_type']))."</td>
                                                                        <td>".$row['request_date']."</td>
                                                                        <td class='text-center'>
                                                                            <i class='bx bxs-envelope mx-1 btn border respond' id=".$row['patient_id'].'_'.$row['request_id']." title='Repond'></i>
                                                                            <i class='bx bxs-x-square mx-1 btn border not_avail' id=".$row['patient_id'].'_'.$row['request_id']." title='Not Available'></i>
                                                                            <i class='bx bxs-check-square mx-1 btn border avail' id=".$row['patient_id'].'_'.$row['request_id']." title='Already Available'></i>
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