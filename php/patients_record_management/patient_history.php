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
    <title>Patient History</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css -->
    <link href='../../css/patients_records.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/nav.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/patient_history.js"></script>
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
        }
    ?>

    <div class="row justify-content-center p-3">
        <div class="col-12">

                        <div class="row justify-content-center mb-3">
                            <div class="col-4">
                                <h2>Patient's History</h2>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>

                         <!-- SELECT ROW -->
                         <div class="row justify-content-center">
                            <div class="col-5">

                                <select class="form-select record_type" id="<?php echo $id; ?>">
                                    <option value="admission">Admissions</option>
                                    <option value="consultation">Consultations</option>
                                    <option value="med_cert">Medical Certifications</option>
                                    <option value="lab_res" selected>Laboratory Results</option>
                                </select>

                            </div>        
                        </div>
                        <!-- SELECT ROW END -->        

                        <div class="row">
                            <div class="col history_div">

                                <!-- lab -->
                                <div class="row mt-5 justify-content-center">

                                    <div class="col-3">
                                        <form>
                                                <div class="form-group shadow-lg">
                                                    <input type="text" class="form-control" id="search_patient" placeholder="Search History">
                                                </div>
                                        </form>
                                    </div>

                                    <div class="col-2">
                                        <select class="form-select" id="search_by">
                                            <option value="date">Search By Date</option>
                                            <option value="type" Selected>Search By Type</option>
                                        </select>
                                    </div>    

                                    <div class="col-2">
                                    </div>    

                                    <div class="col-3">
                                        <select class="form-select" id="sort_by">
                                            <option value="date_asc">Date Ascending</option>
                                            <option value="date_desc">Date Descending</option>
                                        </select>
                                    </div> 

                                </div>

                                <!-- table row  -->
                                <div class="row justify-content-center my-3">
                                    <div class="col-10">

                                        <table class="table">
                                            <thead class="text-white">
                                                <tr>
                                                    <th scope="col">Result Type</th>
                                                    <th scope="col">Release By</th>   
                                                    <th scope="col">Uploaded By</th>
                                                    <th scope="col">Uploaded On</th>
                                                    <th scope="col">Followed Up On</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- table row end -->
                                <!-- lab -->

                                

                                

                            </div>
                        </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

