<?php
session_start();


if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Generation</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/report_generation.css">
  <!-- Jquery + bootstrap js + sweetalert -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>

</head>
<body>  
    
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">
        <div class="report_generation_div">
            <h2>Report Generation</h1>
            <div class="report_generation_info">

                <form method='GET' action='display_report.php'>
                    <div class="report_checkboxes">
                        <div class="checkbox">
                            <input type="checkbox" id="patient_list" name="patient_list" value="patient_list">
                            <label for="patient_list">Patient List</label>
                        </div>    
                        <div class="checkbox">
                            <input type="checkbox" id="account_created" name="account_created" value="account_created">
                            <label for="account_created">Account Created</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="patient_added" name="patient_added" value="patient_added">
                            <label for="patient_added">Patient Added</label>
                        </div>
                    
                    </div>
                   
                    
                    <input type="submit" name="report_btn" value="Generate">
                </form>


            </div>


        </div>
    </div>
</body>
</html>

