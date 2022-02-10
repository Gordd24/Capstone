<?php

include_once '../dbconn.php';

    if(isset($_POST['type'])&&$_POST['type']=="med_cert"){
        $record_type="med_cert";
        $id = $_POST['id'];
        $search = '%'.$_POST['search'].'%';

            $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");



            /* Prepared statement, stage 2: bind and execute */
            $get_hist_stmt->bind_param("ss", $id, $record_type); // "is" means that $id is bound as an integer and $label as a string
            $get_hist_stmt->execute();
            $hist_result = $get_hist_stmt->get_result();

            while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? and record_med_cert_id = ? and physician LIKE ?;");

                /* Prepared statement, stage 2: bind and execute */
                $get_med_stmt->bind_param("sss", $id, $row['record_id'],$search); // "is" means that $id is bound as an integer and $label as a string
                $get_med_stmt->execute();
                $med_result = $get_med_stmt->get_result();
                
                while($med_row = $med_result->fetch_array(MYSQLI_ASSOC)){
                echo "<tr class='show_mods' data-diagnosis=\"".$med_row['diagnosis']."\" data-recommendation=\"".$med_row['recommendation']."\" data-physician=\"".$med_row['physician']."\" 
                data-date=\"".date("Y-m-d",strtotime($row['uploaded_date_time']))."\" data-time=\"".date("h:i A",strtotime($row['uploaded_date_time']))."\" data-record_type=\"med_cert\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                        <td>".$med_row['physician']."</td>
                        <td>".date("Y-m-d",strtotime($row['uploaded_date_time']))."</td>
                        <td>".date("h:i A",strtotime($row['uploaded_date_time']))."</td>
                    </tr>";
                }
              

            }

    }



?>