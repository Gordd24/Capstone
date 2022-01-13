<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

$searched = '%'.$_POST['search'].'%';

include_once '../dbconn.php';


        /* Prepared statement, stage 1: prepare */
        $get_request_stmt = $connection->prepare("SELECT * FROM tbl_requests where concat(request_id,' ',patient_id,' ',request_date) LIKE ? and request_status = 'sent' ORDER BY request_date,request_time DESC");

        /* Prepared statement, stage 2: bind and execute */
        $get_request_stmt->bind_param("s", $searched); // "is" means that $id is bound as an integer and $label as a string
        $get_request_stmt->execute();
        $request_result = $get_request_stmt->get_result();

        if($request_result->num_rows>0)
        {
            while($row_request = $request_result -> fetch_assoc())
            {       
                echo "<tr>
                    <td>".$row_request['request_id']."</td>
                     <td>".$row_request['patient_id']."</td>
                     <td>".ucwords(str_replace("_"," ",$row_request['result_type']))."</td>
                     <td>".$row_request['request_date']."</td>
                     <td class='text-center'>
                        <i class='bx bxs-envelope mx-1 btn border respond' id=".$row_request['patient_id'].'_'.$row_request['request_id']." title='Respond'></i>
                        <i class='bx bxs-x-square mx-1 btn border not_avail' id=".$row_request['patient_id'].'_'.$row_request['request_id']." title='Not Available'></i>
                        <i class='bx bxs-check-square mx-1 btn border avail' id=".$row_request['patient_id'].'_'.$row_request['request_id']." title='Already Available'></i>
                     </td>
                    </tr>";                        
            }
        
        }



?>