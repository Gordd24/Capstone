<?php 

include_once '../dbconn.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patient</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="../../js/NavigationScript.js" type="text/javascript"></script>
    <script src="../../js/view_profile.js" type="text/javascript"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/navigation.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="../../css/nav.css">
    <script src="../../js/nav.js"></script>
  <script src="../../js/view_patient.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/view_patient.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body id='body-pd'>
  
<?php //include_once '../navigation_header.php'; 
      include_once '../admin_nav.php'
      ?>
      <div class="height-100 bg-light">
      <!-- <div class="page_content_div"> -->
        <div class="view_patient_div">
                <div class='patient_info'>
                    <?php
                        $viewed = base64_decode(base64_decode($_GET['id']));
                        $sql = "SELECT * FROM tbl_patients where patient_id = '".$viewed."';";
                        $result = $conn -> query($sql);

                        if($result->num_rows>0)
                        {
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<span><strong>Patient: </strong>".$row['patient_id']." - ".$row['first_name']." ".$row['middle_name']." ".$row['last_name']." <a href='edit_patient.php?id=".$row['patient_id']."'><i class='bx bxs-edit'></i></a> </span>";
                            }
                        }
                    ?>
                       
                </div>
                <div class='tab'>
                    <button class='tablinks' id='admition_btn'><i class='bx bxs-user-check'></i> Admission</button>
                    <button class='tablinks' id='consultation_btn'><i class='bx bx-notepad' ></i> Consultation</button>
                    <button class='tablinks' id='med_cert_btn'><i class='bx bxs-certification' ></i> Medical Certificate</button>
                    <button class='tablinks' id='lab_res_btn'><i class='bx bx-test-tube' ></i> Laboratory Results</button>
                </div> 
                <div class="patient_records_div">
                            <?php
                            include_once '../dbconn.php';
                            $viewed = base64_decode(base64_decode($_GET['id']));
                            $sql = "SELECT * FROM tbl_patients where patient_id = '".$viewed."';";
                            $result = $conn -> query($sql);

                            if($result->num_rows>0)
                            {
                            while($row = $result -> fetch_assoc())
                            {
                                
                                    echo "
                                    <div class='record_table_div admition_div'> 
                                        <table id='records_table'>";
                                        
                                        $sql2 = "SELECT * FROM tbl_admission WHERE patient_id = '".$viewed."' ORDER BY record_admission_id DESC;";
                                        $result2 = $conn -> query($sql2);
                                    
                                            echo '<tr>
                                            <th>File Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                            </tr>';
                                            
                                            if($result2->num_rows>0)
                                            {
                                            while($row2 = $result2 -> fetch_assoc())
                                            {
                                                
                                                echo"<tr>
                                                <td>".$row2['file_name']."</td>
                                                <td>".$row2['date']."</td>
                                                <td>
                                                    <a href='open_directory.php?path=".urlencode($row2['pdf_path'])."'><i class='bx bxs-file-pdf' id='".$row2['patient_id']."'></i></a>
                                                    <i class='bx bxs-file-export' id='".$row2['patient_id']."'></i>
                                                    <a href='download_directory.php?path=".urlencode($row2['pdf_path'])."&file_name=".urlencode($row2['file_name'])."'><i class='bx bxs-download' id='".$row2['patient_id']."'></i></a>
                                                </td>
                                                    </tr>";
                                                
                                                
                                            }
                                            }  
                                    

                                    echo"  </table>
                                    </div>";

                                    echo "
                                    <div class='record_table_div consultation_div'>
                                        <table id='records_table'>";
                                            
                                        $sql3 = "SELECT * FROM tbl_consult WHERE patient_id = '".$viewed."' ORDER BY record_cons_id DESC;";
                                        $result3 = $conn -> query($sql3);
                                    
                                            echo '<tr>
                                            <th>File Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                            </tr>';
                                            
                                            if($result3->num_rows>0)
                                            {
                                                while($row3 = $result3 -> fetch_assoc())
                                                {
                                                    
                                                    echo"<tr>
                                                    <td>".$row3['file_name']."</td>
                                                    <td>".$row3['date']."</td>
                                                    <td>
                                                        <a href='open_directory.php?path=".urlencode($row3['pdf_path'])."'><i class='bx bxs-file-pdf' id='".$row3['patient_id']."'></i></a>
                                                        <i class='bx bxs-file-export' id='".$row3['patient_id']."'></i>
                                                        <a href='download_directory.php?path=".urlencode($row3['pdf_path'])."&file_name=".urlencode($row3['file_name'])."'><i class='bx bxs-download' id='".$row3['patient_id']."'></i></a>
                                                    </td>
                                                        </tr>";    
                                                    
                                                } 
                                            }  
                                        echo"  </table>
                                    </div>";

                                    echo"
                                    <div class='record_table_div med_cert_div'>
                                    <table id='records_table'>";
                                            
                                    $sql5 = "SELECT * FROM tbl_med_cert WHERE patient_id = '".$viewed."' ORDER BY record_med_cert_id DESC;";
                                    $result5 = $conn -> query($sql5);
                                
                                        echo '<tr>
                                        <th>File Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>';
                                        
                                        if($result5->num_rows>0)
                                        {
                                            while($row5 = $result5 -> fetch_assoc())
                                            {
                                                
                                                echo"<tr>
                                                <td>".$row5['file_name']."</td>
                                                <td>".$row5['date']."</td>
                                                <td>
                                                    <a href='open_directory.php?path=".urlencode($row5['pdf_path'])."'><i class='bx bxs-file-pdf' id='".$row5['patient_id']."'></i></a>
                                                    <i class='bx bxs-file-export' id='".$row5['patient_id']."'></i>
                                                    <a href='download_directory.php?path=".urlencode($row5['pdf_path'])."&file_name=".urlencode($row5['file_name'])."'><i class='bx bxs-download' id='".$row5['patient_id']."'></i></a>
                                                </td>
                                                    </tr>";    
                                                
                                            } 
                                        }  
                                    echo"  </table>
                                    </div>";
                                    
                                    echo"
                                    <div class='record_table_div lab_res_div'>
                                    <table id='records_table'>";
                                            
                                    $sql4 = "SELECT * FROM tbl_lab_result WHERE patient_id = '".$viewed."' ORDER BY lab_result_id DESC;";
                                    $result4 = $conn -> query($sql4);
                                
                                        echo '<tr>
                                        <th>File Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>';
                                        
                                        if($result4->num_rows>0)
                                        {
                                            while($row4 = $result4 -> fetch_assoc())
                                            {
                                                
                                                echo"<tr>
                                                <td>".$row4['file_name']."</td>
                                                <td>".$row4['date']."</td>
                                                <td>
                                                    <a href='open_directory.php?path=".urlencode($row4['pdf_path'])."'><i class='bx bxs-file-pdf' id='".$row4['patient_id']."'></i></a>
                                                    <i class='bx bxs-file-export' id='".$row4['patient_id']."'></i>
                                                    <a href='download_directory.php?path=".urlencode($row4['pdf_path'])."&file_name=".urlencode($row4['file_name'])."'><i class='bx bxs-download' id='".$row4['patient_id']."'></i></a>
                                                </td>
                                                    </tr>";    
                                                
                                            } 
                                        }  

                                    echo"  </table>
                                    </div>";
                            }
                            } 

                            ?>
                        </div>
                    </div>
            </div>

        </div>
        
        

   

    </div>
        
      

</body>
</html>