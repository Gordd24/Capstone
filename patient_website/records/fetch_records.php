<?php
include_once '../dbconn.php';
if(isset($_POST['patient'])){
    if(isset($_POST['record'])){
        $id = $_POST['patient'];
        if($_POST['record']=="consultation"){
            $get_record_stmt = $connection->prepare("SELECT * FROM tbl_consult  WHERE patient_id = ? ORDER BY date ASC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_record_stmt->bind_param("s", $id); 
            $get_record_stmt->execute();
            $result = $get_record_stmt->get_result();

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                                       
               echo "<tr>
                   <td>".$row['file_name']."</td>
                   <td>".$row['date']."</td>
                   <td class='text-center'>
                       <i class='bx bxs-book-open mx-1 btn border' title='Open File'></i>
                   </td>
               </tr>";

               }
        }else if($_POST['record']=="admission"){
            $get_record_stmt = $connection->prepare("SELECT * FROM tbl_admission  WHERE patient_id = ? ORDER BY date ASC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_record_stmt->bind_param("s", $id); 
            $get_record_stmt->execute();
            $result = $get_record_stmt->get_result();

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                                       
               echo "<tr>
                   <td>".$row['file_name']."</td>
                   <td>".$row['date']."</td>
                   <td class='text-center'>
                       <i class='bx bxs-book-open mx-1 btn border' title='Open File'></i>
                   </td>
               </tr>";

               }
        }else if($_POST['record']=="medical"){
            $get_record_stmt = $connection->prepare("SELECT * FROM tbl_med_cert  WHERE patient_id = ? ORDER BY date ASC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_record_stmt->bind_param("s", $id); 
            $get_record_stmt->execute();
            $result = $get_record_stmt->get_result();

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                                       
               echo "<tr>
                   <td>".$row['file_name']."</td>
                   <td>".$row['date']."</td>
                   <td class='text-center'>
                       <i class='bx bxs-book-open mx-1 btn border' title='Open File'></i>
                   </td>
               </tr>";

               }
        }else if($_POST['record']=="laboratory"){
            $get_record_stmt = $connection->prepare("SELECT * FROM tbl_lab_result  WHERE patient_id = ? ORDER BY date ASC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_record_stmt->bind_param("s", $id); 
            $get_record_stmt->execute();
            $result = $get_record_stmt->get_result();

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                                       
               echo "<tr>
                   <td>".$row['file_name']."</td>
                   <td>".$row['date']."</td>
                   <td class='text-center'>
                       <i class='bx bxs-book-open mx-1 btn border' title='Open File'></i>
                   </td>
               </tr>";

               }
        }
                                             
            
    }
}


?>