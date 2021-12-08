<?php

if (!isset($_SESSION)) {
    session_start();
  }
    include_once '../dbconn.php';
    
    $sql1 = "SELECT * FROM tbl_patients";
    $total_patient = $conn -> query($sql1);
    $sql2 = "SELECT * FROM tbl_patients WHERE sex = 'Male'";
    $total_male_patient = $conn -> query($sql2);
    $sql3 = "SELECT * FROM tbl_patients WHERE sex = 'Female'";
    $total_female_patient = $conn -> query($sql3);
    $sql4 = "SELECT * FROM tbl_consult";
    $total_consult = $conn -> query($sql4);
    $sql5 = "SELECT * FROM tbl_admission";
    $total_admission = $conn -> query($sql5);
    $sql6 = "SELECT * FROM tbl_med_cert";
    $total_med_cert = $conn -> query($sql6);
    $sql7 = "SELECT * FROM tbl_lab_result";
    $total_lab_res = $conn -> query($sql7);
    $sql8 = "SELECT * FROM tbl_patients WHERE status = 'Admitted'";
    $total_admitted = $conn -> query($sql8);
    $total_records = $total_med_cert->num_rows+$total_lab_res->num_rows+$total_admission->num_rows+$total_consult->num_rows;




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <script src="../../js/nav.js"></script>
    
   
    <link rel="stylesheet" href="../../css/dashboard.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        var consult = <?php  echo $total_consult->num_rows; ?>;
        var admission = <?php  echo $total_admission->num_rows; ?>;
        var med_cert = <?php  echo $total_med_cert->num_rows; ?>;
        var lab_res = <?php  echo $total_lab_res->num_rows; ?>;
        
        function drawChart() {

            if(consult==0&&admission==0&&med_cert==0&&lab_res==0)
            {
                var data = google.visualization.arrayToDataTable([
                ['Created', 'Records Today'],
                ['No Records', 1]
                ]);
            }
            else{
                var data = google.visualization.arrayToDataTable([
                ['Created', 'Hours per Day'],
                ['Consultation', consult],
                ['Admission', admission],
                ['Medical Certificate', med_cert],
                ['Laboratory Results', lab_res]
                ]);
            }
          

            var options = {
                title: ''
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body id="body-pd">
<?php include_once '../admin_nav.php';?>
    <!-- <div id=nav_holder>
        <script>
        $(function(){
        $("#nav_holder").load("../admin_nav.php");
        });
        </script>
    </div> -->

    <!--Container Main start-->
    <div class="height-100 bg-light">
    <div class="container-lg align-items-center my-3 p-3">
        <h1>Dashboard</h1>
        <div class="row m-5">
            <h3>Patients</h3>
            <div class="col-6 col-md-3">
                <div class="card shadow-sm" style="max-width: 13rem;">
                    <div class="card-header text-white">Total Patients</div>
                    <div class="card-body btn btn-muted text-center">
                        <h1 class="card-title"><?php  echo $total_patient->num_rows; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card shadow-sm" style="max-width: 13rem;">
                    <div class="card-header text-white">Admitted</div>
                    <div class="card-body btn btn-muted text-center">
                        <h1 class="card-title"><?php  echo $total_admitted->num_rows; ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-5">
            <h3>Pending Request</h3>
            <div class="col-6 col-md-3">
                <div class="card shadow-sm" style="max-width: 13rem;">
                    <div class="card-header text-white">Laboratory Results</div>
                    <div class="card-body btn btn-muted text-center">
                        <h1 class="card-title">7</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-5">
            <h3>Patient Records</h3>
            <div class="col-6 my-3 col-md-3">
                <div class="card shadow-sm" style="max-width: 13rem;">
                    <div class="card-header text-white">Consultation</div>
                    <div class="card-body btn btn-muted text-center">
                        <h1 class="card-title"> <?php  echo $total_consult->num_rows; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-6 my-3 col-md-3">
                <div class="card shadow-sm" style="max-width: 13rem;">
                    <div class="card-header text-white">Admission</div>
                    <div class="card-body btn btn-muted text-center">
                        <h1 class="card-title"><?php  echo $total_admission->num_rows; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-6 my-3 col-md-3">
                <div class="card shadow-sm" style="max-width: 13rem;">
                    <div class="card-header text-white">Medical Certificate</div>
                    <div class="card-body btn btn-muted text-center">
                        <h1 class="card-title"><?php  echo $total_med_cert->num_rows; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-6 my-3 col-md-3">
                <div class="card shadow-sm" style="max-width: 13rem;">
                    <div class="card-header text-white">Laboratory Results</div>
                    <div class="card-body btn btn-muted text-center">
                        <h1 class="card-title"><?php  echo $total_lab_res->num_rows; ?></h1>
                    </div>
                </div>
            </div>
        </div>
       
       
        
        <div class="container m-5 d-none d-md-block">
        <h3>Created Record Today</h3>

        <div id="piechart"  style="width: 900px; height: 500px;"></div>
        </div>
        
    </div>
    </div>
    <!--Container Main end-->

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>