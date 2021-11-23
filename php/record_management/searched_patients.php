<?php

include_once '../dbconn.php';
if (!isset($_SESSION)) {
    session_start();
  }

  if(isset($_POST['search']))
  {
    $searched = $_POST['search'];
    $sql = "SELECT * FROM tbl_patients where concat(first_name,' ',middle_name,' ',last_name,' ',first_name,' ',last_name) LIKE '%".$searched."%' AND record_status='Active';";
    $result = $conn -> query($sql);

        echo ' <tr>
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
                    <a href='archive_folder.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-archive-in' title='Archive Folder'></i></a>
                    </td>
                    </tr>";
                }
                else if($row['status']=="Not Admitted"){
                    echo "<td style='color:rgb(176, 12, 12); font-weight:bold;'>".$row['status']."</td>
                    <td>
                    <a href='view_patient.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-file-find'  title='View Patient'></i></a>
                    <i class='bx bxs-file-plus' id='".$row['patient_id']."'  title='Create New Record'></i>
                    <a href='archive_folder.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bxs-archive-in' title='Archive Folder'></i></a>
                    </td>
                    </tr>";
                }
                
                
            }
        }  
     }


  if(isset($_POST['restore']))
  {
    $searched = $_POST['restore'];
    $sql = "SELECT * FROM tbl_patients where concat(patient_id,' ',first_name,' ',middle_name,' ',last_name,' ',first_name,' ',last_name) LIKE '%".$searched."%' AND record_status='Archive';";
    $result = $conn -> query($sql);

        echo '<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
        </tr>';

        if($result->num_rows>0)
        {
                            while($row = $result -> fetch_assoc())
                            {
                                
                                        echo 
                                        "
                                        <tr>
                                        <td>".$row['patient_id']."</td>
                                        <td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>
                                        <td><a href='restore.php?id=".base64_encode(base64_encode($row['patient_id']))."'><i class='bx bx-refresh'></i></td>
                                        </tr>";


                                }
                                
                            }  
 
        }

   



?>



