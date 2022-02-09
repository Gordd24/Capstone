<?php

include_once '../dbconn.php';


    if(isset($_POST['type'])&&$_POST['type']=="admission"){
        /* Prepared statement, stage 1: prepare */
        $record_type="admission";
        $id = $_POST['id'];
        $search = '%'.$_POST['search'].'%';

            $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");


            /* Prepared statement, stage 2: bind and execute */
            $get_hist_stmt->bind_param("ss", $id, $record_type); // "is" means that $id is bound as an integer and $label as a string
            $get_hist_stmt->execute();
            $hist_result = $get_hist_stmt->get_result();

            while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                  
                $get_discharge_stmt = $connection->prepare("SELECT * FROM tbl_discharge WHERE patient_id = ? and discharge_id = ?;");

                /* Prepared statement, stage 2: bind and execute */
                $get_discharge_stmt->bind_param("ss",$id, $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                $get_discharge_stmt->execute();
                $discharge_result = $get_discharge_stmt->get_result();
                $discharge_row = $discharge_result->fetch_array(MYSQLI_ASSOC);

                $record_admission_id = $discharge_row['record_admission_id'];

                $get_admission_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE patient_id = ? and record_admission_id = ?  and physician LIKE ?;");

                /* Prepared statement, stage 2: bind and execute */
                $get_admission_stmt->bind_param("sss", $id, $record_admission_id,$search); // "is" means that $id is bound as an integer and $label as a string
                $get_admission_stmt->execute();
                $admission_result = $get_admission_stmt->get_result();
               
                
                while($admission_row = $admission_result->fetch_array(MYSQLI_ASSOC)){
                echo "<tr class='show_mods' data-date_admitted=\"".$admission_row['date_admitted']."\" data-time_admitted=\"".date("h:i A",strtotime($admission_row['time_admitted']))."\" 
                        data-attending_physician=\"".$admission_row['physician']."\" data-record_type=\"admission\" data-diagnosis=\"".$admission_row['diagnosis']."\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\"
                        data-disposition=\"".$discharge_row['disposition']."\" data-date_discharged=\"".date("Y-m-d",strtotime($row['uploaded_date_time']))."\"  data-time_discharged=\"".date("h:i A",strtotime($row['uploaded_date_time']))."\"
                        data-final_diagnosis=\"".$discharge_row['final_diagnosis']."\">
                        <td>".$admission_row['physician']."</td>
                        <td>".date("Y-m-d",strtotime($row['uploaded_date_time']))."</td>
                        <td>".date("h:i A",strtotime($row['uploaded_date_time']))."</td>
                    </tr>";
                }

            }
       
    }else if(isset($_POST['type'])&&$_POST['type']=="med_cert"){
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

    }else if(isset($_POST['type'])&&$_POST['type']=="consultation"){

        /* Prepared statement, stage 1: prepare */
        $record_type="consultation";
        $id = $_POST['id'];
        $search = '%'.$_POST['search'].'%';

            $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");



            /* Prepared statement, stage 2: bind and execute */
            $get_hist_stmt->bind_param("ss", $id, $record_type); // "is" means that $id is bound as an integer and $label as a string
            $get_hist_stmt->execute();
            $hist_result = $get_hist_stmt->get_result();

            while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                $get_cons_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE patient_id = ? and record_cons_id = ?;");

                /* Prepared statement, stage 2: bind and execute */
                $get_cons_stmt->bind_param("ss", $id, $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                $get_cons_stmt->execute();
                $cons_result = $get_cons_stmt->get_result();
                $cons_row = $cons_result->fetch_array(MYSQLI_ASSOC);
                
                echo "<tr class='show_mods' data-date_uploaded=\"".$cons_row['date']."\" data-physician=\"".$cons_row['personnel']."\" data-record_type=\"consultation\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                        <td>".$cons_row['personnel']."</td>
                        <td>".date("Y-m-d",strtotime($row['uploaded_date_time']))."</td>
                        <td>".date("h:i A",strtotime($row['uploaded_date_time']))."</td>
                    </tr>";

            }

    }



?>