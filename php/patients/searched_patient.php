<?php
if (!isset($_SESSION)) {
    session_start();
  }

$searched = '%'.$_POST['search'].'%';

include_once '../dbconn.php';


        /* Prepared statement, stage 1: prepare */
        $get_patients_stmt = $connection->prepare("SELECT * FROM tbl_patients where concat(patient_id,' ',first_name,' ',middle_name,' ',last_name,' ',first_name,' ',last_name) LIKE ? ORDER BY date_added,time_added DESC");

        /* Prepared statement, stage 2: bind and execute */
        $get_patients_stmt->bind_param("s", $searched); // "is" means that $id is bound as an integer and $label as a string
        $get_patients_stmt->execute();
        $patients_result = $get_patients_stmt->get_result();
        


        if($patients_result->num_rows>0)
        {
            while($row_patient = $patients_result -> fetch_assoc())
            {                  

                    echo "
                        <tr>
                            <th scope='row'>".$row_patient["patient_id"]."</th>
                            <td>".$row_patient["first_name"]." ".$row_patient["middle_name"]." ".$row_patient["last_name"]."</td>
                            <td>".$row_patient["email"]."</td>
                            <td>".$row_patient["status"]."</td>
                            <td class='text-center'>
                            <i class='bx bxs-user mx-1 btn border view_patient' id='".$row_patient["patient_id"]."' title='View Patient'></i>";

                        if($row_patient["status"]=="Admitted"){
                            echo "<i class='bx bxs-user-minus mx-1 btn border discharge_patient' id='".$row_patient["patient_id"]."' title='Discharge Patient'></i>";
                        }
                            
                        echo"
                            </td>
                        </tr>";                    
            }
        
        }



?>