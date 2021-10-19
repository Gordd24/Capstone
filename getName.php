<?php
$Username = $_SESSION['Username'];
$sql = "SELECT * FROM tbl_accounts where username = '$Username'";
$result = $conn -> query($sql);

 
if($result->num_rows>0)
{
   while($row = $result -> fetch_assoc())
   {
        echo $row['first_name']." ".$row['last_name']; 
   }
}    


?>
