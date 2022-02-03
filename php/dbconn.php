<?php 
$dbServerName = "localhost";
$dbUsername = "id18055964_olmmgh_user";
$dbPassword = "(=XSA\Zt3>Qs]Gvg";
$dbName ="id18055964_olmmgh";

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