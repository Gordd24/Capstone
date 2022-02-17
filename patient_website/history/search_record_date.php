<?php

include_once '../dbconn.php';


    if(isset($_POST['type'])&&$_POST['type']=="lab_result"){
        
        /* Prepared statement, stage 1: prepare */
        $record_type="lab_result";
        $id = $_POST['id'];
        $date = $_POST['date'];

            $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? and date(uploaded_date_time) = ? ORDER BY uploaded_date_time DESC");

            /* Prepared statement, stage 2: bind and execute */
            $get_hist_stmt->bind_param("sss", $id, $record_type,$date); // "is" means that $id is bound as an integer and $label as a string
            $get_hist_stmt->execute();
            $hist_result = $get_hist_stmt->get_result();

            while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                $get_lab_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and lab_result_id = ?;");

                /* Prepared statement, stage 2: bind and execute */
                $get_lab_stmt->bind_param("ss", $id, $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                $get_lab_stmt->execute();
                $lab_result = $get_lab_stmt->get_result();
                $lab_row = $lab_result->fetch_array(MYSQLI_ASSOC);
                
                echo "<tr class='show_mods' data-date_uploaded=\"".$lab_row['date']."\" data-result_type=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-release_by=\"".$lab_row['release_by']."\" data-uploaded_by=\"".$lab_row['uploader']."\"  data-record_type=\"lab_result\" data-pat_id=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                        <td>".$lab_row['result_type']."</td>
                        <td>".$lab_row['date']."</td>
                    </tr>";

            }
    }else if(isset($_POST['type'])&&$_POST['type']=="med_cert"){

        $record_type="med_cert";
        $id = $_POST['id'];
        $date = $_POST['date'];

            $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? and date(uploaded_date_time) = ? ORDER BY uploaded_date_time DESC");



            /* Prepared statement, stage 2: bind and execute */
            $get_hist_stmt->bind_param("sss", $id, $record_type,$date); // "is" means that $id is bound as an integer and $label as a string
            $get_hist_stmt->execute();
            $hist_result = $get_hist_stmt->get_result();

            while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? and record_med_cert_id = ?;");

                /* Prepared statement, stage 2: bind and execute */
                $get_med_stmt->bind_param("ss", $id, $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                $get_med_stmt->execute();
                $med_result = $get_med_stmt->get_result();
                $med_row = $med_result->fetch_array(MYSQLI_ASSOC);
                
                echo "<tr class='show_mods' data-diagnosis=\"".$med_row['diagnosis']."\" data-recommendation=\"".$med_row['recommendation']."\" data-physician=\"".$med_row['physician']."\" 
                data-date=\"".date("Y-m-d",strtotime($row['uploaded_date_time']))."\" data-time=\"".date("h:i A",strtotime($row['uploaded_date_time']))."\" data-record_type=\"med_cert\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                        <td>".$med_row['physician']."</td>
                        <td>".date("Y-m-d",strtotime($row['uploaded_date_time']))."</td>
                        <td>".date("h:i A",strtotime($row['uploaded_date_time']))."</td>
                    </tr>";

            }

    }



?>