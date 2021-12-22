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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="../../js/NavigationScript.js" type="text/javascript"></script>
    <script src="../../js/view_profile.js" type="text/javascript"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/navigation.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="../../css/nav.css">
    <script src="../../js/nav.js"></script>
  <script src="../../js/restore.js"></script>
  <link rel="stylesheet" href="../../css/archives.css">
</head>
<body id='body-pd'>
  
<?php //include_once '../navigation_header.php'; 
    include_once '../admin_nav.php'
    ?>
    <div class="height-100 bg-light">
        
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