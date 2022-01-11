<?php

session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

include_once '../dbconn.php';
/* Prepared statement, stage 1: prepare */


if(isset($_POST['type'])){

    if($_POST['type']=="medical"){

        if(isset($_POST['patient'])&&isset($_POST['year']))
        {
            $id = $_POST['patient'];
            $year = $_POST['year'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? and YEAR(date)=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$year); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file medical' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
        }else if(isset($_POST['patient'])&&isset($_POST['month']))
        {
    
            $id = $_POST['patient'];
            $month = $_POST['month'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? and MONTH(date)=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$month); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file medical' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient'])&&isset($_POST['date']))
        {
    
            $id = $_POST['patient'];
            $date = $_POST['date'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? and date=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$date); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file medical' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient']))
        {
    
            $id = $_POST['patient'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? ORDER BY date DESC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();

            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file medical' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";

            }                                                         
    
        }
    
    }
    if($_POST['type']=="consultation"){

        if(isset($_POST['patient'])&&isset($_POST['year']))
        {
    
            $id = $_POST['patient'];
            $year = $_POST['year'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE patient_id = ? and YEAR(date)=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$year); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file consultation' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
        }else if(isset($_POST['patient'])&&isset($_POST['month']))
        {
    
            $id = $_POST['patient'];
            $month = $_POST['month'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE patient_id = ? and MONTH(date)=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$month); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file consultation' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient'])&&isset($_POST['date']))
        {
    
            $id = $_POST['patient'];
            $date = $_POST['date'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE patient_id = ? and date=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$date); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file consultation' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient']))
        {
    
            $id = $_POST['patient'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE patient_id = ? ORDER BY date DESC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();

            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file consultation' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";

            }                                                         
    
        }
    
    }
    
    if($_POST['type']=="admission"){

        if(isset($_POST['patient'])&&isset($_POST['year']))
        {
    
            $id = $_POST['patient'];
            $year = $_POST['year'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE patient_id = ? and YEAR(date)=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$year); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file admission' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
        }else if(isset($_POST['patient'])&&isset($_POST['month']))
        {
    
            $id = $_POST['patient'];
            $month = $_POST['month'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE patient_id = ? and MONTH(date)=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$month); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file admission' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient'])&&isset($_POST['date']))
        {
    
            $id = $_POST['patient'];
            $date = $_POST['date'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE patient_id = ? and date=? ORDER BY date DESC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$date); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file admission' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient']))
        {
    
            $id = $_POST['patient'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE patient_id = ? ORDER BY date DESC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();

            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file admission' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";

            }                                                         
    
        }
    
    }

    if($_POST['type']=="laboratory"){

        if(isset($_POST['patient'])&&isset($_POST['year']))
        {
    
            $id = $_POST['patient'];
            $year = $_POST['year'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and YEAR(date)=? ORDER BY date ASC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$year); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file laboratory' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
        }else if(isset($_POST['patient'])&&isset($_POST['month']))
        {
    
            $id = $_POST['patient'];
            $month = $_POST['month'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and MONTH(date)=? ORDER BY date ASC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$month); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file laboratory' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient'])&&isset($_POST['date']))
        {
    
            $id = $_POST['patient'];
            $date = $_POST['date'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and date=? ORDER BY date ASC;");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("ss", $id,$date); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();
    
            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file laboratory' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";
    
            }
    
        }else if(isset($_POST['patient']))
        {
    
            $id = $_POST['patient'];
    
            $get_med_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? ORDER BY date ASC;");

            /* Prepared statement, stage 2: bind and execute */
            $get_med_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
            $get_med_stmt->execute();
            $med_result = $get_med_stmt->get_result();

            while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
                
                echo "<tr>
                <td>".$row['file_name']."</td>
                <td>".$row['date']."</td>
                <td class='text-center'>
                    <i class='bx bxs-book-open mx-1 btn border open_file laboratory' id=".$row['file_name']." title='Open File'></i>
                </td>
                    </tr>";

            }                                                         
    
        }
    
    }


}







?>