<?php

if (!isset($_SESSION)) {
    session_start();
  }
  include_once '../dbconn.php';
    $sql = "SELECT * FROM tbl_patients WHERE record_status='Active' ";
    $result = $conn -> query($sql);

        echo '<tr>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
        </tr>';
         
        if($result->num_rows>0)
        {
           while($row = $result -> fetch_assoc())
           {
             
                echo "<tr>
                <td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>";
                if($row['status']=="Admitted")
                {
                    echo "<td style='color:rgb(210, 190, 37); font-weight:bold;'>".$row['status']."</td>
                    <td>
                    <a href='view_patient.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-file-find'></i></a>
                    <i class='bx bxs-file-plus' id='".$row['patient_id']."'></i>
                    <i class='bx bxs-user-minus' id='".$row['patient_id']."'></i>
                    <a href='archive_folder.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-archive-in'></i></a>
                    </td>
                    </tr>";
                }
                else if($row['status']=="Not Admitted"){
                    echo "<td style='color:rgb(176, 12, 12); font-weight:bold;'>".$row['status']."</td>
                    <td>
                    <a href='view_patient.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-file-find'></i></a>
                    <i class='bx bxs-file-plus' id='".$row['patient_id']."'></i>
                    <a href='archive_folder.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-archive-in'></i></a>
                    </td>
                    </tr>";
                }

            }
            
           

              
               
           
        }  



?>