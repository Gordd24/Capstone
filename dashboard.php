<?php
session_start();


if(!isset($_SESSION['ID'])){
    header("Location: index.php");
}
include_once 'dbconn.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <!-- Jquery + bootstrap js + sweetalert -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/NavigationScript.js" type="text/javascript"></script>
</head>
<body>  
    
    <?php include_once 'navigation_header.php'; ?>

    <div class="page_content_div">
        <div class="dashboard_div">
            <h2>Dashboard</h1>
            <div class="dash_info">

               <?php include_once 'dash_info.php'; ?>

            </div>
            

            

            


        </div>
    </div>
</body>
</html>

