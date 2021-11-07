<?php

include_once 'dbconn.php';
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();


date_default_timezone_set('Asia/Manila');
$patient_id = $_POST['patient_id'];
$patient_lname = strtolower($_POST['patient_lname']);
$path_date = date("Ymdgis");
$record_date = date("Y-m-d");

$patient_name = $_POST['patient_fname']." ".$_POST['patient_mname']." ".$_POST['patient_lname'];
$patient_name_age=$_POST['patient_fname']." ".$_POST['patient_mname']." ".$_POST['patient_lname']." ".$_POST['patient_age'];
$patient_sex = $_POST['patient_sex'];
$patient_address = $_POST['patient_address'];
$date_today = date("F j, Y");
$patient_diagnosis=$_POST['patient_diagnosis'];
$patient_physician= $_POST['patient_physician'];
$patient_physician_license=$_POST['patient_physician_license'];



$mpdf->WriteHTML(
    
'<div  style="position:relative; text-align:center;">
    <h3>OFELIA L. MENDOZA MATERNITY & GENERAL HOSPITAL</h3>
            MOJON, CITY OF MALOLOS, BULACAN <br/>
                TEL NO. (044) 662-5060
                        <hr>  
</div>
<div style="text-align:center;">
    <h4>MEDICAL CERTIFICATE</h4>
</div>

<div style="text-align:right;">
    <p>'.$date_today.'</p>
</div>

<div style="text-align:left;">
    <p>To whom it may concern:</p>
</div>

<div style="text-align:justify;">
    <p>This is to certify that '.$patient_name_age.' years old, '.$patient_sex.' a resident of '.$patient_address.' was seen/examined/treated/evaluated by the undersigned on '.$date_today.' with the following.</p>
</div>

<div style="text-align:left; width:70%; margin:auto;">
    <p><strong>Diagnosis:</strong> '.$patient_diagnosis.'</p>
</div>
<br>
<div style="text-align:left; width:70%; margin:auto;">
    <p><strong>Recommendation/Advise:</strong> '.$patient_diagnosis.'</p>
</div>

<div style="text-align:justify; width:70%; margin:auto;">
    <p>This certification is issued upon the patient\'s request for whatever purpose it may serve him/her.</p>
</div>


<div style="text-align:center; width:35%; float:right;">
    <p>'.$patient_physician.'<br>Attending Physician<br>License Number: '.$patient_physician_license.'</p>
</div>


'
);






$path = "patient/".$patient_name;
if (!is_dir( $path ) ) {
    mkdir( $path );       
} 

$path_type = $path."/medical certificate";

if (!is_dir( $path_type ) ) {
    mkdir( $path_type );       
} 

$file = $path_type."/".$path_date."-".$patient_lname.".pdf";

$mpdf->Output($file,"F");


$insertSql = "INSERT INTO tbl_med_cert(patient_id,pdf_path,date) VALUES ('".$patient_id."','".$file."','".$record_date."');";
mysqli_query($conn,$insertSql);

header('Location: record_management.php');




?>