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
  <title>Home</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/navigation.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/NavigationScript.js" type="text/javascript"></script>
</head>
<body>

<?php include_once 'navigation_header.php'; ?>

</body>
</html>