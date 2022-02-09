<?php

include_once '../dbconn.php';


    if(isset($_POST['type'])&&$_POST['type']=="lab_result"){
        
        /* Prepared statement, stage 1: prepare */
        $record_type="lab_result";
        $id = $_POST['id'];
        $result_type = $_POST['res_type'];


      

            $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");



            /* Prepared statement, stage 2: bind and execute */
            $get_hist_stmt->bind_param("ss", $id, $record_type); // "is" means that $id is bound as an integer and $label as a string
            $get_hist_stmt->execute();
            $hist_result = $get_hist_stmt->get_result();

            while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                if($result_type!="all"){
                    $get_lab_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and result_type = ? and lab_result_id = ? ORDER BY date DESC");
                    $get_lab_stmt->bind_param("sss", $id, $result_type, $row['record_id']);
                }else{
                    $get_lab_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and lab_result_id = ? ORDER BY date DESC");
                    $get_lab_stmt->bind_param("ss", $id, $row['record_id']);
                }
                 // "is" means that $id is bound as an integer and $label as a string
                $get_lab_stmt->execute();
                $lab_res_result = $get_lab_stmt->get_result();

                while ($lab_row = $lab_res_result->fetch_array(MYSQLI_ASSOC)) {
                
                 echo "<tr class='show_mods' data-date_uploaded=\"".$lab_row['date']."\" data-result_type=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-release_by=\"".'Dummy Person'."\" data-uploaded_by=\"".$lab_row['uploader']."\"  data-record_type=\"lab_result\" data-pat_id=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                         <td>".ucwords(str_replace("_"," ",$lab_row['result_type']))."</td>
                         <td>Dummy Release</td>
                         <td>".$lab_row['uploader']."</td>
                         <td>".$lab_row['date']."</td>
                     </tr>";

                }

            }
    }else{
     
    }



?>