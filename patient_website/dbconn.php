<?php 
$dbServerName = "localhost";
$dbUsername = "id18055964_olmmgh_user";
$dbPassword = "(=XSA\Zt3>Qs]Gvg";
$dbName ="id18055964_olmmgh";

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