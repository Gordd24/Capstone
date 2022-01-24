<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

$searched = '%'.$_POST['search'].'%';

include_once '../dbconn.php';


        /* Prepared statement, stage 1: prepare */
        $get_patients_stmt = $connection->prepare("SELECT * FROM tbl_patients where concat(patient_id,' ',first_name,' ',middle_name,' ',last_name,' ',first_name,' ',last_name) LIKE ? and record_status = 'Active' ORDER BY date_added DESC,time_added DESC");

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
                        <td class='text-center'> ";
                            if($row_patient['status']=="Admitted")    
                            {
                                echo "<i class='bx bxs-file-plus mx-1 btn border create_record discharge' id='".$row_patient['patient_id']."' title='Create Record'></i>";
                            }else{
                                echo "<i class='bx bxs-file-plus mx-1 btn border create_record' id='".$row_patient['patient_id']."' title='Create Record'></i>";
                            }                 
                    

                            echo"
                            <i class='bx bxs-folder-open mx-1 btn border view_records' id='".$row_patient['patient_id']."' title='View Records'></i>
                            <i class='bx bxs-archive mx-1 btn border archive' id='".$row_patient['patient_id']."' title='Archive'></i>
                        </td>
                    </tr>";                    
            }
        
        }



?>