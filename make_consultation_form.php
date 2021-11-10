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
$patient_age = $_POST['patient_age'];
$patient_sex = $_POST['patient_sex'];
$patient_address = $_POST['patient_address'];
$patient_birthday = $_POST['patient_birthday'];
$patient_contact_no = $_POST['patient_contact_no'];
$date_today = date("F j, Y, g:i a");

$patient_complaint = $_POST['patient_complaint'];
$patient_bp = $_POST['patient_bp'];
$patient_weight = $_POST['patient_weight'];
$patient_temp = $_POST['patient_temp'];
$patient_rr= $_POST['patient_rr'];
$patient_pr= $_POST['patient_pr'];

$ob_patient_lmp = $_POST['patient_lmp']; 
$ob_patient_aog= $_POST['patient_aog'];
$ob_patient_edc= $_POST['patient_edc'];


$mpdf->WriteHTML('
<div  style="position:relative;">
<table style="width:100%">
    <tr>
    <td><img src="images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
    <td style="text-align:Center; font-family:arial; ">OFELIA L. MENDOZA MATERNITY AND GENERAL HOSPITAL <br/>
                                        MOJON, CITY OF MALOLOS, BULACAN <br/>
                                            TEL NO. (044)794-7113
                                                <hr></td>
    </tr>
</table>
    
</div>


<div style="margin-top:3%; text-align:center; font-family: arial;">

    <h3><u>OUR PATIENT RECORD</u></h3>
    <div style="margin-top:5%;">
        <table style="width:100%; font-weight:bold; font-family: arial;">
            <tr>
            <td style="font-weight:bold;" colspan="3">Name: <span style="font-weight:normal;">'.$patient_name.'</span></td>
            <td style="font-weight:bold;">Age: <span style="font-weight:normal;">'.$patient_age.'</span></td>
            <td style="font-weight:bold;">Sex: <span style="font-weight:normal;">'.$patient_sex.'</span></td>
            </tr>
            <tr>
            <td style="font-weight:bold;" colspan="5">Address: <span style="font-weight:normal;">'.$patient_address.'</span></td>
            </tr>
            <tr>
                <td style="font-weight:bold;" colspan="2">Birthday: <span style="font-weight:normal;">'.$patient_birthday.'</span></td>
                <td style="font-weight:bold;" colspan="2">Contact No: <span style="font-weight:normal;">'.$patient_contact_no.'</span></td>
            </tr>
        </table>
    </div>

    <div style="text-align:left; margin-top: 5%; ">
        <h4>Date: <span style="font-weight:normal;">'.$date_today.'</span></h4>
    </div>
    <div style="width:100%;  margin-top: 5%; ">
        <table  style="width:100%; font-weight: bold; text-align:justify; font-family:arial;">
            <tr>
            <td style="text-align:left;"><u><strong>CHIEF COMPLAINT</strong></u></td>
            </tr>
            <tr>
            <td><span style="font-weight: normal; "><pre>'.$patient_complaint.'</pre></span></td>
            </tr>
        </table>
     </div>
    <div style="width:100%;  margin-top: 10%; ">
    <table style="width:100%; font-weight: bold; font-family: arial;">
        <tr>
            <td colspan="1" >Vital Signs;</span></td>  
        </tr>
        <tr>
            <td colspan="1" >Weight: <span style="font-weight:normal;">'.$patient_weight.'</span></td>  
        </tr>
        <tr>
            <td colspan="1" >BP: <span style="font-weight:normal;">'.$patient_bp.'</span></td>
        </tr>
        <tr>
            <td colspan="1" >Temp:  <span style="font-weight:normal;">'.$patient_temp.'</span></td>
        </tr>
        <tr>
            <td colspan="1" >RR: <span style="font-weight:normal;">'.$patient_rr.'</span></td>
        </tr>
        <tr>
            <td colspan="1" >PR: <span style="font-weight:normal;">'.$patient_pr.'</span></td>
        </tr>
        
      </table>
    </div>

    <div style="width:100%; margin-top:10%;">
    <table  style="width:100%; font-weight: bold; font-family: arial;">
        <tr>
          <td style="text-align:left;"><strong>FOR OB PATIENT</strong></td>
        </tr>
        <tr>
          <td>LMP: <span style="font-weight: normal;">'.$ob_patient_lmp.'</span> </td>
        </tr>
        <tr>
            <td>AOG: <span style="font-weight: normal;">'.$ob_patient_aog.'</span> </td>
        </tr>
        <tr>
          <td>EDC: <span style="font-weight: normal;">'.$ob_patient_edc.'</span> </td>
        </tr>
     </table>
     </div>
</div>



'
);

$path = "patient/".$patient_name;
if (!is_dir( $path ) ) {
    mkdir( $path );       
} 

$path_type = $path."/consultation";

if (!is_dir( $path_type ) ) {
    mkdir( $path_type );       
} 

$file = $path_type."/".$path_date."-".$patient_lname.".pdf";
$file_name = $path_date."-".$patient_lname.".pdf";

$mpdf->Output($file,"F");


$insertSql = "INSERT INTO tbl_consult(patient_id,pdf_path,date,file_name) VALUES ('".$patient_id."','".$file."','".$record_date."','".$file_name."');";
mysqli_query($conn,$insertSql);

header('Location: record_management.php');


?>