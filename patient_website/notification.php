<?php
session_start();

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}

include_once 'dbconn.php';

if(isset($_POST['data'])){

    $get_response_stmt = $connection->prepare("SELECT count(patient_id) as cnt FROM tbl_responses WHERE patient_id = ? and view_status = 'sent';");

        $id = $_SESSION['PATIENT_ID'];
        /* Prepared statement, stage 2: bind and execute */
        $get_response_stmt->bind_param("s", $id);
        $get_response_stmt->execute();
        
        $response_result = $get_response_stmt->get_result();

        while ($response_row = $response_result->fetch_array(MYSQLI_ASSOC)) {
            if($response_row['cnt']>0){
                echo '<span id="response_notif" class="active_notif"><i class="bx bxs-message-error"></i> Responses <sup>'.$response_row['cnt'].'</sup></span>';
            }else{
              echo '<span id="response_notif"><i class="bx bxs-message-error"></i> Responses <sup></sup></span>';
            }
        }
        

}


?>

