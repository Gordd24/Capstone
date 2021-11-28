<?php

if (!isset($_SESSION)) {
    session_start();
  }
  include_once '../dbconn.php';
    $sql = "SELECT * FROM tbl_patients WHERE record_status='Active'";
    $result = $conn -> query($sql);

    echo'<head>
    <title>Record Management</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/record_management.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>';

        echo '<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
        </tr>';
         
        if($result->num_rows>0)
        {
           while($row = $result -> fetch_assoc())
           {
             
                echo "<tr>
                <td>".$row["patient_id"]."</td>
                <td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>";
                if($row['status']=="Admitted")
                {
                    echo "<td style='color:rgb(210, 190, 37); font-weight:bold;'>".$row['status']."</td>
                    <td>
                    <a href='view_patient.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-file-find'  title='View Patient'></i></a>
                    <i class='bx bxs-file-plus' id='".$row['patient_id']."' title='Create New Record'></i>
                    <i class='bx bxs-user-minus' id='".$row['patient_id']."' title='Discharge Patient'></i>
                    <a id='archive_btn' href='archive_folder.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-archive-in' title='Archive Folder'></i></a>
                    </td>
                    </tr>";
                }
                else if($row['status']=="Not Admitted"){
                    echo "<td style='color:rgb(176, 12, 12); font-weight:bold;'>".$row['status']."</td>
                    <td>
                    <a href='view_patient.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-file-find'  title='View Patient'></i></a>
                    <i class='bx bxs-file-plus' id='".$row['patient_id']."'  title='Create New Record'></i>
                    <a id='archive_btn' href='archive_folder.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i  class='bx bxs-archive-in' title='Archive Folder'></i></a>
                    </td>
                    </tr>";
                }

               

            }
            
           

              
               
           
        }  



?>