<?php

include_once 'dbconn.php';
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

date_default_timezone_set('Asia/Manila');
$patient_id = $_POST['patient_id'];
$patient_lname = strtolower($_POST['patient_lname']);
$path_date = date("Ymdgis");
$record_date = date("Y-m-d");

$patient_room_no = $_POST['patient_room_no'];
$patient_contact_no = $_POST['patient_contact_no'];
$patient_case_no = $_POST['patient_case_no'];
$patient_name = $_POST['patient_fname']." ".$_POST['patient_mname']." ".$_POST['patient_lname'];
$patient_age = $_POST['patient_age'];
$patient_sex = $_POST['patient_sex'];
$patient_cs = $_POST['patient_cs'];
$patient_religion = $_POST['patient_religion'];
$patient_address = $_POST['patient_address'];
$patient_birthday = $_POST['patient_birthday'];
$patient_occupation = $_POST['patient_occupation'];
$patient_philhealth_no = $_POST['patient_philhealth_no'];
$patient_father_name = $_POST['patient_father_name'];
$patient_mother_name = $_POST['patient_mother_name'];
$patient_spouse_name = $_POST['patient_spouse_name'];
$patient_date_of_marriage = $_POST['patient_date_of_marriage'];
$patient_place_of_marriage = $_POST['patient_place_of_marriage'];
$patient_date_admitted = $_POST['patient_date_admitted'];
$patient_time_admitted = $_POST['patient_time_admitted'];
$patient_admitted_by = $_POST['patient_admitted_by'];
$patient_physician = $_POST['patient_physician'];
$patient_admitting_diagnosis = $_POST['patient_admitting_diagnosis'];
$patient_disposition = '<td colspan="2" style="border-top: none; border-right: none;">{ } Discharged</td>
    <td colspan="2" style="border-top: none; border-right: none;  border-left: none; text-align:center;">{ } Transferred</td>
    <td colspan="1" style="border-top: none; border-right: none;  border-left: none; text-align:center;">{ } HAMA</td>
    <td colspan="2" style="border-top: none; border-right: none;  border-left: none; text-align:center;">{ } Absconded</td>
    <td colspan="1" style="border-top: none; border-left: none; text-align:center;">{ } DIED</td>';


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
'.'
<div style="margin-top:3%; text-align:center; font-family: arial;">
    <h3><u>PATIENT'.'\'S CLINICAL CASE RECORD</u></h3>
</div>

<div style="margin-top:3%; text-align:center; font-family: arial;">
<table border="1" style="width:100%; font-weight: bold; border-collapse: collapse; font-family: arial;">
<tr>
  <td colspan="2" style="border-bottom:none;">Room:</td>
  <td colspan="4" style="border-bottom:none;">Contact No:</td>
  <td colspan="2" style="border-bottom:none;">Case No:</td>
</tr>
<tr>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;"><span style="font-weight: normal;">'.$patient_room_no.'</span></span></td>
  <td colspan="4" style="border-top:none;"><span style="font-weight: normal;">'.$patient_contact_no.'</span></td>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">'.$patient_case_no.'</span></td>
</tr>
<tr>
  <td colspan="4" style="border-bottom:none;">Name:</td>
  <td colspan="1" style="border-bottom:none;">Age:</td>
  <td colspan="1" style="border-bottom:none;">Sex</td>
  <td colspan="1" style="border-bottom:none;">CS:</td>
  <td colspan="1" style="border-bottom:none;">Religion:</td>
</tr>
<tr>
  <td colspan="4" style="border-top:none;"><span style="font-weight: normal;">'.$patient_name.'</span></td>
  <td colspan="1" style="border-top:none;"><span style="font-weight: normal;">'.$patient_age.'</span></td>
  <td colspan="1" style="border-top:none;"><span style="font-weight: normal;">'.$patient_sex.'</span></td>
  <td colspan="1" style="border-top:none;"><span style="font-weight: normal;">'.$patient_cs.'</span></td>
  <td colspan="1" style="border-top:none;"><span style="font-weight: normal;">'.$patient_religion.'</span></td>
</tr>
<tr>
  <td colspan="5" style="border-bottom:none;">Address: </td>
  <td colspan="3" style="border-bottom:none;">Birthdate: </td>
</tr>
<tr>
  <td colspan="5" style="border-top:none;"><span style="font-weight: normal;">'.$patient_address.'</span></td>
  <td colspan="3" style="border-top:none;"><span style="font-weight: normal;">'.$patient_birthday.'</span></td>
</tr>
<tr>
  <td colspan="5" style="border-bottom:none;">Occupation:</td>
  <td colspan="3" style="border-bottom:none;">PhilHealth No:</td>
</tr>
<tr>
  <td colspan="5" style="border-top:none;"><span style="font-weight: normal;">'.$patient_occupation.'</span></td>
  <td colspan="3" style="border-top:none;"><span style="font-weight: normal;">'.$patient_philhealth_no.'</span></td>
</tr>
<tr>
  <td colspan="4" style="border-bottom:none;">Mother'.'\'s Name:</td>
  <td colspan="4" style="border-bottom:none;">Father'.'\'s Name:</td>
</tr>
<tr>
  <td colspan="4" style="border-top:none;"><span style="font-weight: normal;">'.$patient_mother_name.'</span></td>
  <td colspan="4" style="border-top:none;"><span style="font-weight: normal;">'.$patient_father_name.'</span></td>
</tr>
<tr>
  <td colspan="3" style="border-bottom:none;">Spouse'.'\'s Name:</td>
  <td colspan="2" style="border-bottom:none;">Date of Marriage:</td>
  <td colspan="3" style="border-bottom:none;">Place of Marriage:</td>
</tr>
<tr>
  <td colspan="3" style="border-top:none;"><span style="font-weight: normal;">'.$patient_spouse_name.'</span></td>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">'.$patient_date_of_marriage.'</span></td>
  <td colspan="3" style="border-top:none;"><span style="font-weight: normal;">'.$patient_place_of_marriage.'</span></td>
</tr>
<tr>
  <td colspan="2" style="border-bottom:none;">Date Admitted:</td>
  <td colspan="2" style="border-bottom:none;">Time Admitted:</td>
  <td colspan="4" style="border-bottom:none;">Admitted By:</td>
</tr>
<tr>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">'.$patient_date_admitted.'</span></td>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">'.$patient_time_admitted.'</span></td>
  <td colspan="4" style="border-top:none;"><span style="font-weight: normal;">'.$patient_admitted_by.'</span></td>
</tr>
<tr>
  <td colspan="2" style="border-bottom:none;">Date Discharged:</td>
  <td colspan="2" style="border-bottom:none;">Time Discharged:</td>
  <td colspan="4" style="border-bottom:none;">Discharged By:</td>
</tr>
<tr>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">DATEDISCHARGED</span></td>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">TIMEDISCHARGED</span></td>
  <td colspan="4" style="border-top:none;"><span style="font-weight: normal;">DISCHARGEDBY</span></td>
</tr>
<tr>
  <td colspan="2" style="border-bottom:none;">Transferred To Room:</td>
  <td colspan="2" style="border-bottom:none;">Date:</td>
  <td colspan="4" style="border-bottom:none;">Time:</td>
</tr>
<tr>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">TRANSFERREDTOROOM</span></td>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">TRANSDATE</span></td>
  <td colspan="4" style="border-top:none;"><span style="font-weight: normal;">TRANSTIME</span></td>
</tr>
<tr>
  <td colspan="8" style="border-bottom:none;">Attending Physician: (FULL NAME)</td>
</tr>
<tr>
  <td colspan="8" style="border-top:none;"><span style="font-weight: normal;">'.$patient_physician.'</span></td>
</tr>
<tr>
  <td colspan="8" style="border-bottom:none;">Admitting Diagnosis:</td>
</tr>
<tr>
  <td colspan="8" style="border-top:none; border-bottom: none;"><span style="font-weight: normal;"><pre>'.$patient_admitting_diagnosis.'</pre></span></td>
</tr>
<tr>
  <td colspan="6" style="border-bottom:none;">Final Diagnosis:</td>
  <td colspan="2" style="border-bottom:none;">ICD 10 CODE:</td>
</tr>
<tr>
  <td colspan="6" style="border-top:none; border-bottom: none;"><span style="font-weight: normal;"><pre>FINALDIAGNOSIS</pre></span></td>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">ICD10CODE</span></td>
</tr>
<tr>
  <td colspan="6" style="border-top:none; border-bottom: none;"></td>
  <td colspan="2" style="border-top:none; border-bottom: none;">RVS CODE:</td>
</tr>
<tr>
  <td colspan="6" style="border-top:none;"></td>
  <td colspan="2" style="border-top:none;"><span style="font-weight: normal;">RVSCODE</span></td>
</tr>
<tr>
  <td colspan="8" style="border-bottom:none;">OPERATION(s):</td>
</tr>
<tr>
  <td colspan="8" style="border-top:none;"><span style="font-weight: normal;">OPERATIONS</span></td>
</tr>
<tr>
  <td colspan="8" style="border-bottom:none;">DISPOSITION:</td>
</tr>
<tr>
  '.$patient_disposition.'
</tr>
</table>

</div>'

);


$path = "patient/".$patient_name;
if (!is_dir( $path ) ) {
    mkdir( $path );       
} 

$path_type = $path."/admission";

if (!is_dir( $path_type ) ) {
    mkdir( $path_type );       
} 

$file = $path_type."/".$path_date."-".$patient_lname.".pdf";
$file_name = $path_date."-".$patient_lname.".pdf";

$mpdf->Output($file,"F");

$insertSql = "INSERT INTO tbl_admission(patient_id,pdf_path,date,file_name) VALUES ('".$patient_id."','".$file."','".$record_date."','".$file_name."');";
mysqli_query($conn,$insertSql);

$updateStat = "UPDATE tbl_patients SET status = 'Admitted' WHERE patient_id = '".$patient_id."';";
mysqli_query($conn,$updateStat);


header('Location: record_management.php');



?>