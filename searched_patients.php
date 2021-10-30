<?php

include_once 'dbconn.php';
if (!isset($_SESSION)) {
    session_start();
  }

$searched = $_POST['search'];
$sql = "SELECT * FROM tbl_patients where concat(first_name,' ',middle_name,' ',last_name,' ',first_name,' ',last_name) LIKE '%".$searched."%'";
$result = $conn -> query($sql);

    echo ' <tr>
    <th>Name</th>
    <th>Status</th>
    <th>Action</th>
    </tr>';

    if($result->num_rows>0)
    {
    while($row = $result -> fetch_assoc())
    {
        
            echo "<tr>
            <td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>
            <td>status</td>
            <td>
                <i class='bx bxs-file-find' id='".$row['patient_id']."'></i>
                <i class='bx bxs-file-plus'></i>
                <i class='bx bxs-archive-in'></i>
            </td>
            </tr>";
        
        
    }
    }  



?>



