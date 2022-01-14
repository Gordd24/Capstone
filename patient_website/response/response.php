<?php

session_start();

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Responses</title>
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="response.css">
  <link rel="stylesheet" href="../nav/patient_header.css">
   <!-- boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../nav/patient_header.js"></script>
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

    <div class="row">
      <div class="col">

                                        <!-- table row  -->
                                        <div class="row justify-content-center my-3 mx-2">
                                            <div class="col-12 col-sm-7 col-md-7">

                                                



                                                <ul class="list-group">
                                                  <li class="list-group-item head_list" aria-current="true">Responses</li>
                                                    <?php 
                                                      include_once '../dbconn.php';
                                                        
                                                      $get_response_stmt = $connection->prepare("SELECT * FROM tbl_responses  WHERE patient_id = ? ORDER BY response_date DESC,response_time DESC;");

                                                              $id = $_SESSION['PATIENT_ID'];
                                                              /* Prepared statement, stage 2: bind and execute */
                                                              $get_response_stmt->bind_param("s", $id); 
                                                              $get_response_stmt->execute();
                                                              $response_result = $get_response_stmt->get_result();

                                                              while ($response_row = $response_result->fetch_array(MYSQLI_ASSOC)) {
                                                                
                                                                $request_id = $response_row['request_id'];

                                                                $get_request_stmt = $connection->prepare("SELECT * FROM tbl_requests  WHERE request_id = ?");

                                                                /* Prepared statement, stage 2: bind and execute */
                                                                $get_request_stmt->bind_param("s", $request_id); 
                                                                $get_request_stmt->execute();
                                                                $request_result = $get_request_stmt->get_result();

                                                                while ($request_row = $request_result->fetch_array(MYSQLI_ASSOC)) {

                                                                  if($response_row['response_status']=="not available"){
                                                                  echo '
                                                                  <li class="list-group-item" aria-current="true">
                                                                    <div class="row">
                                                                      <div class="col">
                                                                        <h5 class="not_avail">'.ucwords(str_replace("_"," ",$request_row['result_type'])).'<i class="bx bx-question-mark" ></i></h5>
                                                                      </div>
                                                                    </div>
                                                                    <div class="row">
                                                                      <div class="col">
                                                                        Sent on '.$request_row['request_date'].' '.$request_row['request_time'].'
                                                                      </div>
                                                                    </div>
                                                                    <div class="row">
                                                                      <div class="col">
                                                                        Responded on '.$response_row['response_date'].' '.$response_row['response_time'].'
                                                                      </div>
                                                                    </div>
                                                                    <div class="row m-3">
                                                                      <div class="col px-5">
                                                                        <strong>The result you followed up on '.$request_row['request_date'].' '.$request_row['request_time'].' is not available.</strong>
                                                                      </div>
                                                                    </div>
                                                                  
                                                                  </li>';
                                                                  }else if ($response_row['response_status']=="already available")
                                                                  {
                                                                    echo '
                                                                    <li class="list-group-item" aria-current="true">
                                                                      <div class="row">
                                                                        <div class="col">
                                                                          <h5 class="alr_avail">'.ucwords(str_replace("_"," ",$request_row['result_type'])).'<i class="bx bx-check-double" ></i></h5>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col">
                                                                          Sent on '.$request_row['request_date'].' '.$request_row['request_time'].'
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col">
                                                                          Responded on '.$response_row['response_date'].' '.$response_row['response_time'].'
                                                                        </div>
                                                                      </div>
                                                                      <div class="row m-3">
                                                                        <div class="col px-5">
                                                                          <strong>The result you followed up on '.$request_row['request_date'].' '.$request_row['request_time'].' is already available, kindly check your records section.</strong>
                                                                        </div>
                                                                      </div>
                                                                    
                                                                    </li>';
                                                                  }else if ($response_row['response_status']=="available")
                                                                  {
                                                                    echo '
                                                                    <li class="list-group-item" aria-current="true">
                                                                      <div class="row">
                                                                        <div class="col">
                                                                          <h5 class="avail">'.ucwords(str_replace("_"," ",$request_row['result_type'])).'<i class="bx bx-check"></i></h5>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col">
                                                                          Created on '.$response_row['response_date'].' '.$response_row['response_time'].'
                                                                        </div>
                                                                      </div>
                                                                      <div class="row m-3">
                                                                        <div class="col px-5">
                                                                          <strong>The result for your '.ucwords(str_replace("_"," ",$request_row['result_type'])).' test is now available on your records section.</strong>
                                                                        </div>
                                                                      </div>
                                                                    
                                                                    </li>';
                                                                  }



                                                                }

                                                                

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







