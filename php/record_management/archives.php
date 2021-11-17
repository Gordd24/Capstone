<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
if(isset($_POST['consultation_submit'])){
   make_consultation();
}

if(isset($_POST['med_cert_submit'])){
  make_med_cert();
}

if(isset($_POST['admission_submit'])){
  make_admission();
}

if(isset($_POST['discharged_submit'])){
  discharge_patient();
}

if(isset($_POST['lab_res_upload']))
{
  make_lab_res();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Title of the document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/restore.js"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/archives.css">
</head>
<body>
  
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">
        
            <div class="archives_div">
              <form action="index.php" method="post">
                <input id="patient_search" type="text" name="patient_search" placeholder="patient's name" required= ""><br>
              </form>     
        

            <div class="archives_table_div">
              <table id="table_archives">
              <?php

                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    include_once '../dbconn.php';
                        $sql = "SELECT * FROM tbl_patients WHERE record_status='Archive' ";
                        $result = $conn -> query($sql);

                            echo '<tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                            </tr>';
                            
                            if($result->num_rows>0)
                            {
                            while($row = $result -> fetch_assoc())
                            {
                                
                                        echo 
                                        "
                                        <tr>
                                        <td>".$row['patient_id']."</td>
                                        <td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>
                                        <td><a href='restore.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bx-refresh'></i></td>
                                        </tr>";


                                }
                                
                            }  



                    ?>
              </table>
            </div>
            </div>

      </div>
      

</body>
</html>