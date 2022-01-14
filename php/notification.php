<?php
session_start();

include_once 'dbconn.php';

if(isset($_POST['data'])){

    $get_response_stmt = $connection->prepare("SELECT count(request_id) as cnt FROM tbl_requests WHERE view_status = 'sent';");

        /* Prepared statement, stage 2: bind and execute */
        $get_response_stmt->execute();
        $response_result = $get_response_stmt->get_result();

        while ($response_row = $response_result->fetch_array(MYSQLI_ASSOC)) {
            if($response_row['cnt']>0){
                echo '<i class="bx bxs-message-dots active_notif"></i> <span class="nav_name active_notif">Patients Follow Ups <sup>'.$response_row['cnt'].'</sup></span>';
            }else{
              echo '<i class="bx bxs-message-dots"></i> <span class="nav_name">Patients Follow Ups <sup></sup></span>';
            }
        }
        

}


?>

