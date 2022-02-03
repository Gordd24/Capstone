<?php 
$dbServerName = "localhost";
$dbUsername = "id18055964_olmmgh_caps2";
$dbPassword = "jq*5rjTJmBi#QrFV";
$dbName ="id18055964_olmmgh_db2	";

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