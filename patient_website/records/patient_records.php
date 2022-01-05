<?php 
session_start();

$id = $_SESSION['ID'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="patient_records.css">
  <link rel="stylesheet" href="../nav/patient_header.css">

  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="patient_records.js"></script>

  <!-- boxicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

  <!-- main row -->
  <div class="row">
    <div class="col">

         <!-- dropdown -->
        <div class="row justify-content-center my-3">
          <div class="col-12 col-sm-5 text-center">

          <select class="form-select record_select" id="<?php echo$id ?>" aria-label=".form-select-sm example">
            <option value="medical" selected>Medical Certificate</option>
            <option value="laboratory">Laboratory Results</option>
          </select>

          </div>
        </div>
         <!-- dropdown end -->
         <div class="row">
           <div class="col">
                                        <!-- table row  -->
                                        <div class="row justify-content-center my-3">
                                            <div class="col-md-10">

                                                <table class="table">
                                                    <thead class="text-white">
                                                        <tr>
                                                            <th scope="col">File Name</th>
                                                            <th scope="col">Date</th>   
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <?php
                                                            include_once '../dbconn.php';
                                                        
                                                            $get_record_stmt = $connection->prepare("SELECT * FROM tbl_med_cert  WHERE patient_id = ? ORDER BY date ASC;");

                                                                    /* Prepared statement, stage 2: bind and execute */
                                                                    $get_record_stmt->bind_param("s", $id); 
                                                                    $get_record_stmt->execute();
                                                                    $result = $get_record_stmt->get_result();

                                                                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                                        
                                                                        echo "<tr>
                                                                        <td>".$row['file_name']."</td>
                                                                        <td>".$row['date']."</td>
                                                                        <td class='text-center'>
                                                                            <i class='bx bxs-book-open mx-1 btn border' title='Open File'></i>
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
  </div>
  <!-- main row end -->
  


                                        





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







