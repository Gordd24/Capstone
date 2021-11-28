<?php
session_start();


if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}


if(isset($_POST['report_btn']))
{
    $patient_list = isset($_POST['patient_list']) && $_POST['patient_list']  ? "1" : "0";

    $account_created = isset($_POST['account_created']) && $_POST['account_created']  ? "1" : "0";

    $patient_added = isset($_POST['patient_added']) && $_POST['patient_added']  ? "1" : "0";

    if($patient_list=="1"||$patient_added=="1"||$account_created=="1")
    {
        generate_report($patient_list,$account_created,$patient_added);
    }
    

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Generation</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../../css/navigation.css">
  <link rel="stylesheet" href="../../css/report_generation.css">
  <!-- Jquery + bootstrap js + sweetalert -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/NavigationScript.js" type="text/javascript"></script>

</head>
<body>  
    
    <?php include_once '../navigation_header.php'; ?>

    <div class="page_content_div">
        <div class="report_generation_div">
            <h2>Report Generation</h1>
            <div class="report_generation_info">

                <form method='post'>
                    <div class="report_checkboxes">
                        <div class="checkbox">
                            <input type="checkbox" id="patient_list" name="patient_list" value="patient_list">
                            <label for="patient_list">Patient List</label>
                        </div>    
                        <div class="checkbox">
                            <input type="checkbox" id="account_created" name="account_created" value="account_created">
                            <label for="account_created">Account Created</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="patient_added" name="patient_added" value="account_created">
                            <label for="patient_added">Patient Added</label>
                        </div>
                    
                    </div>
                   
                    
                    <input type="submit" name="report_btn" value="Generate">
                </form>


            </div>


        </div>
    </div>
</body>
</html>

<?php


function generate_report($patient_list,$account_created,$patient_added){

include_once '../dbconn.php';
require_once __DIR__ . '../../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
if($patient_list=="1")
{

    $patient_td = '';
    $admission_count = '';
    $consultation_count = '';
    $med_cert_count = '';
    $lab_res_count = '';

    $sql = "SELECT * FROM tbl_patients";
    $result = $conn -> query($sql);



    if($result->num_rows>0)
    {
        while($row = $result -> fetch_assoc())
        {
            $sql2 = "SELECT patient_id,first_name,middle_name,last_name FROM tbl_admission WHERE patient_id = '".$row['patient_id']."';";
            $result2 = $conn -> query($sql2);
            if($result2->num_rows>0)
            {
                $admission_count = $result2->num_rows;
            }
            else{
                $admission_count = 0;
            }

            $sql3 = "SELECT * FROM tbl_consult WHERE patient_id = '".$row['patient_id']."';";
            $result3 = $conn -> query($sql3);
            if($result3->num_rows>0)
            {
                $consultation_count = $result3->num_rows;
            }
            else{
                $consultation_count = 0;
            }
            
            
            $sql4 = "SELECT * FROM tbl_med_cert WHERE patient_id = '".$row['patient_id']."';";
            $result4 = $conn -> query($sql4);
            if($result4->num_rows>0)
            {
                $med_cert_count = $result4->num_rows;
            }
            else{
                $med_cert_count = 0;
            }

            
            $sql5 = "SELECT * FROM tbl_lab_result WHERE patient_id = '".$row['patient_id']."';";
            $result5 = $conn -> query($sql5);
            if($result5->num_rows>0)
            {
                $lab_res_count = $result5->num_rows;
            }
            else{
                $lab_res_count = 0;
            }

            $patient_td .='

            <tr>
                <td>'.$row['patient_id'].'</td>
                <td style="padding: 10px; white-space: nowrap; text-align:left;">'.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</td>
                <td style="padding: 10px; background-color: rgb(250, 237, 203)">'.$admission_count.'</td>
                <td style="padding: 10px; background-color:rgb(201, 228, 222)">'.$consultation_count.'</td>
                <td style="padding: 10px; background-color:rgb(198, 222, 241)">'.$med_cert_count.'</td>
                <td style="padding: 10px; background-color:rgb(219, 205, 240)">'.$lab_res_count.'</td>
        
            </tr>';
            
            
        }
    }
    else{
        $patient_td .= '
        <tr>
        <td></td>

        </tr>
    ';
    }




    $mpdf->WriteHTML('
    <div  style="position:relative;">
    <table style="width:100%">
        <tr>
        <td><img src="..\..\images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
        <td style="text-align:Center; font-family:arial; ">OFELIA L. MENDOZA MATERNITY AND GENERAL HOSPITAL <br/>
                                            MOJON, CITY OF MALOLOS, BULACAN <br/>
                                                TEL NO. (044)794-7113
                                                    <hr></td>
        </tr>
    </table>
    </div>
    <table border=1 style="width:100%; white-space: nowrap; border-collapse: collapse; text-align:center; font-family:sans-serif;">
    <caption style="font-family:sans-serif; font-size:20px; font-weight:bold; padding:30px;">Patient List</caption>
            <tr>
                <th style="padding: 10px;">Patient ID</th>
                <th style="padding: 10px;">Name</th>
                <th style="padding: 10px; background-color:rgb(250, 237, 165);">Admission Record</th>
                <th style="padding: 10px; background-color:rgb(175, 228, 222);">Consultation Record</th>
                <th style="padding: 10px; background-color:rgb(175, 222, 241);">Medical Certificate</th>
                <th style="padding: 10px; background-color:rgb(219, 187, 240);">Lab Result</th>
            </tr>

            
            '.$patient_td.'

            
        </table>
    '
    );

}


if($account_created=="1")
{
    if($patient_list=="1")
    {
        $mpdf->AddPage();
    }

    $accounts_td = '';


    $account_sql = "SELECT * FROM tbl_accounts ORDER BY date_created,time_created DESC";
    $accounts = $conn -> query($account_sql);


    if($accounts->num_rows>0)
    {
        while($row_account = $accounts -> fetch_assoc())
        {
           

            $accounts_td .='

            <tr>
                <td>'.$row_account['acc_id'].'</td>
                <td style="padding: 10px; white-space: nowrap; text-align:left;">'.$row_account['username'].'</td>
                <td style="padding: 10px; background-color: rgb(250, 237, 203)">'.$row_account['position'].'</td>
                <td style="padding: 10px; background-color:rgb(201, 228, 222)">'.$row_account['date_created'].'</td>
                <td style="padding: 10px; background-color:rgb(198, 222, 241)">'.$row_account['time_created'].'</td>
        
            </tr>';
            
            
        }
    }


    $mpdf->WriteHTML('
    <div  style="position:relative;">
    <table style="width:100%">
        <tr>
        <td><img src="..\..\images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
        <td style="text-align:Center; font-family:arial; ">OFELIA L. MENDOZA MATERNITY AND GENERAL HOSPITAL <br/>
                                            MOJON, CITY OF MALOLOS, BULACAN <br/>
                                                TEL NO. (044)794-7113
                                                    <hr></td>
        </tr>
    </table>
    </div>
    <table border=1 style="width:100%; white-space: nowrap; border-collapse: collapse; text-align:center; font-family:sans-serif;">
    <caption style="font-family:sans-serif; font-size:20px; font-weight:bold; padding:30px;">Account Created</caption>
            <tr>
                <th style="padding: 10px;">Account ID</th>
                <th style="padding: 10px;">Username</th>
                <th style="padding: 10px; background-color:rgb(250, 237, 165);">Position</th>
                <th style="padding: 10px; background-color:rgb(175, 228, 222);">Date Created</th>
                <th style="padding: 10px; background-color:rgb(175, 222, 241);">Time Created</th>
            </tr>

            
            '.$accounts_td.'

            
    </table>
    
    ');
    
}



if($patient_added=="1")
{
    if($account_created=="1"||$patient_list=="1")
    {
        $mpdf->AddPage();
    }

    $patient_added_td = '';


    $patient_added_sql = "SELECT * FROM tbl_patients ORDER BY date_added,time_added DESC";
    $patient_added = $conn -> query($patient_added_sql);


    if($patient_added->num_rows>0)
    {
        while($row_patient_added = $patient_added -> fetch_assoc())
        {
           

            $patient_added_td .='

            <tr>
                <td>'.$row_patient_added['patient_id'].'</td>
                <td style="padding: 10px; white-space: nowrap; text-align:left;">'.$row_patient_added['first_name'].' '.$row_patient_added['middle_name'].' '.$row_patient_added['last_name'].'</td>
                <td style="padding: 10px; background-color: rgb(250, 237, 203);">'.$row_patient_added['date_added'].'</td>
                <td style="padding: 10px; background-color:rgb(201, 228, 222);">'.$row_patient_added['time_added'].'</td>
        
            </tr>';
            
            
        }
    }


    $mpdf->WriteHTML('
    <div  style="position:relative;">
    <table style="width:100%">
        <tr>
        <td><img src="..\..\images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
        <td style="text-align:Center; font-family:arial; ">OFELIA L. MENDOZA MATERNITY AND GENERAL HOSPITAL <br/>
                                            MOJON, CITY OF MALOLOS, BULACAN <br/>
                                                TEL NO. (044)794-7113
                                                    <hr></td>
        </tr>
    </table>
    </div>
    <table border=1 style="width:100%; white-space: nowrap; border-collapse: collapse; text-align:center; font-family:sans-serif;">
    <caption style="font-family:sans-serif; font-size:20px; font-weight:bold; padding:30px;">Added Patients</caption>
            <tr>
                <th style="padding: 10px;">Patient ID</th>
                <th style="padding: 10px;">Patient Name</th>
                <th style="padding: 10px; background-color:rgb(250, 237, 165);">Date Added</th>
                <th style="padding: 10px; background-color:rgb(175, 228, 222);">Time Added</th>
            </tr>

            
            '.$patient_added_td.'

            
    </table>
    
    ');
    
}






// Output a PDF file directly to the browser
$mpdf->Output();

}


?>1