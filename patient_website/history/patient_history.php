<?php
session_start();

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}

if(isset($_SESSION['PASS_STATUS']) && $_SESSION['PASS_STATUS'] === 'default'){
  header("Location: ../../patient_website/change_patient_pass.php");
}
include_once '../dbconn.php';

$stmt = $connection->prepare("UPDATE tbl_responses SET view_status = 'viewed' WHERE patient_id = ? and view_status='sent'; ");
$patient_id = $_SESSION['PATIENT_ID'];
$stmt->bind_param("s", $patient_id);
$stmt->execute();
$id = $_SESSION['PATIENT_ID'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../../images/favicon.ico" />
  <title>Responses</title>
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../nav/patient_header.css">
  <link rel="stylesheet" href="patient_history.css">
   <!-- boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../nav/patient_header.js"></script>

  <!-- javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/notification.js"></script>
  <script src="patient_history.js"></script>
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

    <div class="row">
      <div class="col wrapper">

                         <!-- SELECT ROW -->
                         <div class="row justify-content-center mt-3">
                            <div class="col-10 col-md-5">

                                <select class="form-select record_type" id="<?php echo $id; ?>">
                                    <option value="med_cert">Medical Certifications</option>
                                    <option value="lab_res" selected>Laboratory Results</option>
                                </select>

                            </div>        
                        </div>
                        <!-- SELECT ROW END -->        

                        <div class="row">
                            <div class="col history_div">

                            <!-- lab -->
                            <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <strong>Date Uploaded: </strong><br><span class="date_uploaded"></span><br><br>
                                            </div>
                                            <div style="margin-bottom:5px;">
                                                <strong>Type of Result: </strong><br><span style="margin-left:50px;" class="result_type"></span>
                                            </div>
                                            <div style="margin-bottom:5px;">
                                                <strong>Release By: </strong><br><span style="margin-left:50px;" class="release_by"></span>
                                            </div>
                                            <div style="margin-bottom:5px;">
                                                <strong>Upload By: </strong><br><span style="margin-left:50px;" class="uploaded_by"></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                            </div>

                              
                                <div class="row mt-5 justify-content-center">

                                    <div class="col-10 col-md-3  mt-1">
                                        <select class="form-select" data-type="lab_result" data-id="<?php echo $id; ?>" id="select_by_type">
                                            <option value="all" selected>Select All</option>
                                            <option value="complete_blood_count">Complete Blood Count</option>
                                            <option value="platelet_count">Platelet Count</option>
                                            <option value="blood_typing">Blood Typing</option>
                                            <option value="cross_matching">Cross Matching</option>
                                            <option value="hepatitis_b">Hepatitis B</option>
                                            <option value="blood_urea_nitrogen">Blood Urea Nitrogen</option>
                                            <option value="creatinine">Creatinine</option>
                                            <option value="fasting_blood_sugar">Fasting Blood Sugar</option>
                                            <option value="fecalysis">Fecalysis</option>
                                            <option value="cholesterol">Cholesterol</option>
                                            <option value="uric_acid">Uric Acid</option>
                                            <option value="urinalysis">Urinalysis</option>
                                        </select>
                                    </div> 

                                    <div class="col-10 col-md-3 mt-1">
                                        <form>
                                                <div class="form-group shadow-lg">
                                                    <input type="date" class="form-control" id="search_record_date" data-type="lab_result" data-id="<?php echo $id; ?>">
                                                </div>
                                        </form>
                                    </div>  

                                    <div class="col-10 col-md-1 mt-1">
                                    </div>    

                                    <div class="col-10 col-md-3 mt-1">
                                        <select class="form-select" data-type="lab_result" data-id="<?php echo $id; ?>" id="sort_by">
                                            <option value="date_asc">Date Ascending</option>
                                            <option value="date_desc" selected>Date Descending</option>
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
                                                    <th scope="col">Uploaded On</th>
                                                </tr>
                                            </thead>
                                            <tbody class="lab_tbody">
                                                <?php

                                                   include_once '../dbconn.php';
                                                    /* Prepared statement, stage 1: prepare */
                                                    $record_type="lab_result";
                                                   
                                                    $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");

                                                    /* Prepared statement, stage 2: bind and execute */
                                                    $get_hist_stmt->bind_param("ss", $id, $record_type); // "is" means that $id is bound as an integer and $label as a string
                                                    $get_hist_stmt->execute();
                                                    $hist_result = $get_hist_stmt->get_result();

                                                    while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                                                        $get_lab_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and lab_result_id = ?;");

                                                        /* Prepared statement, stage 2: bind and execute */
                                                        $get_lab_stmt->bind_param("ss", $id, $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                                                        $get_lab_stmt->execute();
                                                        $lab_result = $get_lab_stmt->get_result();
                                                        $lab_row = $lab_result->fetch_array(MYSQLI_ASSOC);
                                                        
                                                        echo "<tr class='show_mods' data-date_uploaded=\"".$lab_row['date']."\" data-result_type=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-release_by=\"".'Dummy Person'."\" data-uploaded_by=\"".$lab_row['uploader']."\"  data-record_type=\"lab_result\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                                                <td  '>".ucwords(str_replace("_"," ",$lab_row['result_type']))."</td>
                                                                <td>".$lab_row['date']."</td>
                                                            </tr>";

                                                    }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- table row end -->
                                <!-- lab -->
                    

                                        

      </div>
    </div>


                                        

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







