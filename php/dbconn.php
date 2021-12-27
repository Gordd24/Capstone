<?php 
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName ="olmmgh_db";

$conn = mysqli_connect($dbServerName,$dbUsername, $dbPassword, $dbName);

$connection = new mysqli($dbServerName,$dbUsername, $dbPassword, $dbName);





// /* check connection */
// if (mysqli_connect_errno()) {
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit();
// }
// else{
//     printf("Success");
// }
?>