<?php

include_once 'dbconn.php';
$viewed = $_POST['view'];
$sql = "SELECT * FROM tbl_patients where patient_id = '".$viewed."';";
$result = $conn -> query($sql);

if($result->num_rows>0)
{
   while($row = $result -> fetch_assoc())
   {
        echo"
        <div class='cancel_view_patient_btn_div'>
            <i class='bx bxs-x-circle'></i>
        </div>
        <div class='patient_info'>
            <span>Patient ID: ".$row['patient_id']."</span><br>
            <span>Patient Name: ".$row['first_name']." ".$row['middle_name']." ".$row['last_name']."</span>
            <i class='bx bxs-edit'></i>
        </div>

        <div class='tab'>
        <button class='tablinks' id='admition_btn'><i class='bx bxs-user-check'></i> Admition</button>
        <button class='tablinks' id='consultation_btn'><i class='bx bx-notepad' ></i> Consultation</button>
        <button class='tablinks' id='med_cert_btn'><i class='bx bxs-certification' ></i> Medical Certificate</button>
        <button class='tablinks' id='lab_res_btn'><i class='bx bx-test-tube' ></i> Laboratory Results</button>
        </div> 
        
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
                        <a href='open_directory.php?path=".urlencode($row2['pdf_path'])."'><i class='bx bxs-file-find' id='".$row2['patient_id']."'></i></a>
                        <i class='bx bxs-file-export' id='".$row2['patient_id']."'></i>
                        <i class='bx bxs-file-pdf' id='".$row2['patient_id']."'></i>
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
                            <i class='bx bxs-file-find' id='".$row3['patient_id']."'></i>
                            <i class='bx bxs-file-export' id='".$row3['patient_id']."'></i>
                            <i class='bx bxs-file-pdf' id='".$row3['patient_id']."'></i>
                        </td>
                            </tr>";    
                        
                    } 
                }  
            echo"  </table>
        </div>";

        echo"
        <div class='record_table_div med_cert_div'>
        <table id='records_table'>";
                
        $sql4 = "SELECT * FROM tbl_med_cert WHERE patient_id = '".$viewed."' ORDER BY record_med_cert_id DESC;";
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
                        <i class='bx bxs-file-find' id='".$row4['patient_id']."'></i>
                        <i class='bx bxs-file-export' id='".$row4['patient_id']."'></i>
                        <i class='bx bxs-file-pdf' id='".$row4['patient_id']."'></i>
                    </td>
                        </tr>";    
                    
                } 
            }  
        echo"  </table>
        </div>";
        
        echo"
        <div class='lab_res_div'>Laboratory Results ".$row['patient_id']."</div>";

   }
} 


           


?>