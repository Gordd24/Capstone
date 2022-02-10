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


$limit = 20;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;



$get_count_stmt = $connection->prepare("SELECT count(request_id) as id  FROM tbl_requests  WHERE patient_id = ?;");
/* Prepared statement, stage 2: bind and execute */ 
$get_count_stmt->bind_param("s", $_SESSION['PATIENT_ID']); 
$get_count_stmt->execute();

$count_result = $get_count_stmt->get_result();
$count_row = $count_result->fetch_array(MYSQLI_ASSOC);
$total = $count_row['id']; 
$pages =  ceil($total/$limit);   
$Previous = $page - 1;
$Next = $page + 1; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Follow Up</title>
  <link rel="shortcut icon" href="../../images/favicon.ico" />
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="patient_follow.css">
  <link rel="stylesheet" href="../nav/patient_header.css">
   <!-- boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

  <!-- javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/notification.js"></script>
  <script src="patient_follow.js"></script>
  <script src="../nav/patient_header.js"></script>
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

  <div class="row justify-content-center m-4">
    <div class="col-12 col-sm-8 p-2">

        
        <div class="row">
          <div class="col text-center">
            <h3>Select Results</h3>
          </div>
        </div>

        <form method="POST" id = "form_follow">
            <!-- div for check results -->
            <div class="row border rounded m-2">
              <div class="col-12">

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input type="hidden" name="patient_id" value="<?php echo $_SESSION['PATIENT_ID'] ?>"> 
                      <input class="form-check-input" type="checkbox" name="results" id="complete_blood_count" value="complete_blood_count">
                      <label class="form-check-label" for="complete_blood_count">
                        Complete Blood Count (CBC)
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="platelet_count" value="platelet_count">
                      <label class="form-check-label" for="platelet_count">
                        Platelet Count
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="blood_typing" value="blood_typing">
                      <label class="form-check-label" for="blood_typing">
                        Blood Typing
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="cross_matching" value="cross_matching">
                      <label class="form-check-label" for="cross_matching">
                        Cross Matching
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="hepatitis_b" value="hepatitis_b">
                      <label class="form-check-label" for="hepatitis_b">
                        Hepatitis B
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="blood_urea_nitrogen" value="blood_urea_nitrogen">
                      <label class="form-check-label" for="blood_urea_nitrogen">
                        Blood Urea Nitrogen (BUN)
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="creatinine" value="creatinine">
                      <label class="form-check-label" for="creatinine">
                        Creatinine
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="fasting_blood_sugar" value="fasting_blood_sugar">
                      <label class="form-check-label" for="fasting_blood_sugar">
                        Fasting Blood Sugar (FBS)
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="fecalysis" value="fecalysis">
                      <label class="form-check-label" for="fecalysis">
                        Fecalysis
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="cholesterol" value="cholesterol">
                      <label class="form-check-label" for="cholesterol">
                        Cholesterol
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="uric_acid" value="uric_acid">
                      <label class="form-check-label" for="uric_acid">
                        Uric Acid
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="results" id="urinalysis" value="urinalysis">
                      <input type="hidden" name="hidden_field_follow" id="hidden_field_follow" value="form_check">
                      <label class="form-check-label" for="urinalysis">
                        Urinalysis
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                 <!-- follow submit  -->
                 <div class="row justify-content-center">
                    <div class="col-12 col-sm-4 my-2 p-2">
                        <input class="form-control next" type="submit" name="follow" value="Follow Up">
                    </div>
                </div>
                <!-- follow submit end-->

              </div>
            </div>
            
            
            <!-- div for check results end -->
        </form>

        <div class="row justify-content-center mt-5">
            <div class="col-11">

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        
                        <?php

                            if($Previous>0)
                            {
                                echo' <li class="page-item">
                                    <a class="page-link" href="patient_follow.php?page='.$Previous.'">Previous</a>
                                </li>';
                            }else{
                                echo' <li class="page-item disabled">
                                    <a class="page-link" href="#">Previous</a>
                                </li>';
                            }


                            for($i=1; $i<=$pages; $i++)
                            {
                                echo '<li class="page-item"><a class="page-link" href="patient_follow.php?page='.$i.'">'.$i.'</a></li>';
                            }

                            
                            if($Next<=$pages)
                            {
                                echo' <li class="page-item">
                                    <a class="page-link" href="patient_follow.php?page='.$Next.'">Next</a>
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

         <!-- table row  -->
         <div class="row justify-content-center mx-2">
              <div class="col-12 col-sm-12 col-md-12">
                  <ul class="list-group">
                    <li class="list-group-item head_list" aria-current="true">Previous Follow Ups</li>
                      <?php 
                      
                          
                        $get_request_stmt = $connection->prepare("SELECT * FROM tbl_requests  WHERE patient_id = ? ORDER BY request_date DESC,request_time DESC LIMIT ?,?;");

                                $id = $_SESSION['PATIENT_ID'];
                                /* Prepared statement, stage 2: bind and execute */
                                $get_request_stmt->bind_param("sss", $id,$start,$limit); 
                                $get_request_stmt->execute();
                                $request_result = $get_request_stmt->get_result();

                                while ($request_row = $request_result->fetch_array(MYSQLI_ASSOC)) {
                                
                                    echo '
                                    <li class="list-group-item" aria-current="true">
                                      <div class="row">
                                        <div class="col">
                                          <strong>'.ucwords(str_replace("_"," ",$request_row['result_type'])).'</strong>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col">
                                            Followed up on '.date('m-d-Y',strtotime($request_row['request_date'])).' at '.date('h:i A',strtotime($request_row['request_time'])).'
                                        </div>
                                      </div>
                                    </li>';
                                }
                                    
                                    
                            
                        ?>
                      
                  </ul>
              </div>
          </div>
          <!-- table row end -->
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







