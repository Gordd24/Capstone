<?php
include_once '../dbconn.php';
if (!isset($_SESSION)) {
    session_start();
  }

$searched = $_POST['search'];
$sql = "SELECT * FROM tbl_accounts where concat(first_name,' ',middle_name,' ',last_name,' ',username,' ',emp_id,' ',first_name,' ',last_name) LIKE '%".$searched."%' ORDER BY date_created,time_created DESC";
$result = $conn -> query($sql);

    echo "<tr>
            <th>Employee ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Action</th>
         </tr>";
 
if($result->num_rows>0)
{
   while($row = $result -> fetch_assoc())
   {
        if($row['acc_id'] != $_SESSION['ID'])
        {
            echo "<tr>
            <td>".$row["emp_id"]."</td>
            <td>".$row["username"]."</td>
            <td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>
            <td>
                <i class='bx bxs-user' id='".$row["emp_id"]."' title='View Account'></i>
                <i class='bx bxs-trash-alt' id='".$row["emp_id"]."' title='Delete'></i>
            </td>
            </tr>";

            
        }
   }
} 

?>