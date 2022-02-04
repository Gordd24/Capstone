<?php 
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName ="olmmgh_db";

// $dbUsername = "id18055964_olmmgh_caps2";
// $dbPassword = "LsRqm4i>Hd3QLvSZ";
// $dbName ="id18055964_olmmgh_db2";

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