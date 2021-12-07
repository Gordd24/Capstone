<?php
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}
if(isset($_POST['consultation_submit'])){
   make_consultation();
}

if(isset($_POST['med_cert_submit'])){
  make_med_cert();
}

if(isset($_POST['admission_submit'])){
  make_admission();
}

if(isset($_POST['discharged_submit'])){
  discharge_patient();
}

if(isset($_POST['lab_res_upload']))
{
  make_lab_res();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Record Management</title>
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
  <script src="../../js/record_management.js"></script>
  <link rel="stylesheet" href="../../css/record_management.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body id='body-pd'>
  
    <?php //include_once '../navigation_header.php'; 
    include_once '../admin_nav.php'
    ?>
    <div class="height-100 bg-light">
    <!-- <div class="page_content_div"> -->
        <div class="option_modal_div" tabindex="0">
          <div class="option_modal_exit_div">
            <i class='bx bxs-x-circle'></i>
          </div>
          <div class="modal_options_div">
            <p class="option_buttons" id="consultation"><i class='bx bx-notepad' ></i> Consultation Record</p>
            <p class="option_buttons" id="admission"><i class='bx bx-user-plus' ></i> Admission Record</p>
            <p class="option_buttons" id="med_cert"><i class='bx bx-certification'></i> Medical Certificate</p>
            <p class="option_buttons" id="lab_res"><i class='bx bx-test-tube'></i> Lab Result</p>
          </div>
        </div>
        
        <div class="record_management_div">
          <div class="record_management_div_1">
            <div class="patient_search_div">
              <form action="index.php" method="post">
                <input id="patient_search" type="text" name="patient_search" placeholder="patient's name" required= ""><br>
              </form>     
            </div>
            <div class="add_patient_btn_div">
              <a href='add_patient.php'><button id="add_patient_btn">Add Patient</button></a>
                <a href='archives.php'><button id="archives_btn">Archives</button></a>
            </div>
            <div class="patient_table_div">
              <table id="table_patient">
                  <?php include_once 'fetch_Patients.php';?>   
              </table>
            </div>
          </div>
        <div class="record_management_div_4"> </div>

      </div>
    </div>
        
      

</body>
</html>


<?php

function make_med_cert(){

include_once '../dbconn.php';
require_once __DIR__ . '../../../vendor/autoload.php';

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
$patient_recommendation=$_POST['patient_recommendation'];
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
    <p><strong>Diagnosis:</strong><pre>'.$patient_diagnosis.'</pre></p>
</div>
<br>
<div style="text-align:left; width:70%; margin:auto;">
    <p><strong>Recommendation/Advise:</strong><pre>'.$patient_recommendation.'</pre></p>
</div>

<div style="text-align:justify; width:70%; margin:auto;">
    <p>This certification is issued upon the patient\'s request for whatever purpose it may serve him/her.</p>
</div>


<div style="text-align:center; width:35%; float:right;">
    <p>'.$patient_physician.'<br>Attending Physician<br>License Number: '.$patient_physician_license.'</p>
</div>
'
);

$path = "patient/".$patient_id;
if (!is_dir( "../../".$path ) ) {
    mkdir( "../../".$path );       
} 

$path_type = $path."/medical certificate";

if (!is_dir( "../../".$path_type ) ) {
    mkdir( "../../".$path_type );       
} 

$file = $path_type."/".$path_date."-".$patient_lname.".pdf";
$file_name = $path_date."-".$patient_lname.".pdf";

$mpdf->Output("../../".$file,"F");


$insertSql = "INSERT INTO tbl_med_cert(patient_id,pdf_path,date,file_name) VALUES ('".$patient_id."','".$file."','".$record_date."','".$file_name."');";
mysqli_query($conn,$insertSql);

header('Location: record_management.php');

}


function make_consultation() {
  include_once '../dbconn.php';
  require_once __DIR__ . '../../../vendor/autoload.php';
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
      <td><img src="..\..\images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
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
  
  $path = "patient/".$patient_id;
  if (!is_dir( "../../".$path ) ) {
      mkdir( "../../".$path );       
  } 
  
  $path_type = $path."/consultation";
  
  if (!is_dir( "../../".$path_type ) ) {
      mkdir( "../../".$path_type );       
  } 
  
  $file = $path_type."/".$path_date."-".$patient_lname.".pdf";
  $file_name = $path_date."-".$patient_lname.".pdf";
  
  $mpdf->Output("../../".$file,"F");
  
  
  $insertSql = "INSERT INTO tbl_consult(patient_id,pdf_path,date,file_name) VALUES ('".$patient_id."','".$file."','".$record_date."','".$file_name."');";
  mysqli_query($conn,$insertSql);
  
  header('Location: record_management.php');
  }


  function make_admission()
  {
    
    include_once '../dbconn.php';
    require_once __DIR__ . '../../../vendor/autoload.php';

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
        <td><img src="..\..\images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
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


      $path = "patient/".$patient_id;
      if (!is_dir( "../../".$path ) ) {
          mkdir( "../../".$path );       
      } 

      $path_type = $path."/admission";

      if (!is_dir( "../../".$path_type ) ) {
          mkdir( "../../".$path_type );       
      }  

      $file = $path_type."/".$path_date."-".$patient_lname.".pdf";
      $file_name = $path_date."-".$patient_lname.".pdf";

      $mpdf->Output("../../".$file,"F");

      $insertSql = "INSERT INTO tbl_admission(patient_id,pdf_path,date,file_name) VALUES ('".$patient_id."','".$file."','".$record_date."','".$file_name."');";
      mysqli_query($conn,$insertSql);

      $updateStat = "UPDATE tbl_patients SET status = 'Admitted' WHERE patient_id = '".$patient_id."';";
      mysqli_query($conn,$updateStat);


      header('Location: record_management.php');
}

  function discharge_patient()
  {
    include_once '../dbconn.php';
    require_once __DIR__ . '../../../vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->percentSubset = 0;

        $patient_id = $_POST['patient_id'];


        $patient_date_discharged = $_POST['patient_date_discharged'];
        $patient_time_discharged = $_POST['patient_time_discharged'];
        $patient_discharged_by = $_POST['patient_discharged_by'];
        $patient_transfered_to_room = $_POST['patient_transferred_to_room'];
        $patient_transfered_to_room_date = $_POST['patient_transferred_to_room_date'];
        $patient_transfered_to_room_time = $_POST['patient_transferred_to_room_time'];

        $patient_final_diagnosis = $_POST['patient_final_diagnosis'];
        $patient_ICD_10_code = $_POST['patient_ICD_10_code'];
        $patient_rvs_code = $_POST['patient_rvs_code'];
        $patient_operations = $_POST['patient_operations'];


        $patient_disposition = "";
        $patient_disposition_value = "";


        if(isset($_POST['patient_disposition']))
        {
          if($_POST['patient_disposition']=="DISCHARGED")
          {
          $patient_disposition = '{ } Discharged';
          $patient_disposition_value = '{/} Discharged';
          }
          else if($_POST['patient_disposition']=='TRANSFERRED')
          {
          $patient_disposition = '{ } Transferred';
          $patient_disposition_value = '{/} Transferred';
          }
          else if($_POST['patient_disposition']=='HAMA')
          {
          $patient_disposition = '{ } HAMA';
          $patient_disposition_value = '{/} HAMA';
          }
          else if($_POST['patient_disposition']=='ABSCONDED')
          {
          $patient_disposition = '{ } Absconded';
          $patient_disposition_value = '{/} Absconded';
          }
          else if($_POST['patient_disposition']=='DIED')
          {
          $patient_disposition = '{ } DIED';
          $patient_disposition_value = '{/} DIED';
          }
        }
        $search = array(
          'DATEDISCHARGED','TIMEDISCHARGED','DISCHARGEDBY','TRANSFERREDTOROOM','TRANSDATE','TRANSTIME','FINALDIAGNOSIS','ICD10CODE','RVSCODE','OPERATIONS',$patient_disposition

        );

        $replacement = array(
          $patient_date_discharged,$patient_time_discharged,$patient_discharged_by,$patient_transfered_to_room,$patient_transfered_to_room_date,$patient_transfered_to_room_time,$patient_final_diagnosis,$patient_ICD_10_code,
          $patient_rvs_code,$patient_operations,$patient_disposition_value
        );


        $overwriteSql = "SELECT pdf_path FROM tbl_admission WHERE patient_id = '".$patient_id."' ORDER BY record_admission_id DESC;"; 
        $result = $conn -> query($overwriteSql);
        $pdf_path='';

          if($result->num_rows>0)
          {
            while($row = $result -> fetch_assoc())
            {
                $pdf_path=$row['pdf_path'];
                break;
            }
          } 
        $updateStat = "UPDATE tbl_patients SET status = 'Not Admitted' WHERE patient_id = '".$patient_id."';";
        mysqli_query($conn,$updateStat);
        $mpdf->OverWrite("../../".$pdf_path, $search, $replacement, 'F', "../../".$pdf_path );
        header('Location: record_management.php');

  }
  


  function make_lab_res(){
    include_once '../dbconn.php';

    date_default_timezone_set('Asia/Manila');
    $patient_id = $_POST['patient_id'];
    $patient_lname = strtolower($_POST['patient_lname']);
    $path_date = date("Ymdgis");
    $record_date = date("Y-m-d");

    // $patient_name = $_POST['patient_fname']." ".$_POST['patient_mname']." ".$_POST['patient_lname'];

        $pdfName =$_FILES['patient_lab_res']['name'];
        //$destination = 'patient/' . $pdfName;

        $path = "patient/".$patient_id;
        if (!is_dir( "../../".$path ) ) {
            mkdir( "../../".$path );       
        } 
        $path_type = $path."/laboratory_result";
        
        if (!is_dir( "../../".$path_type ) ) {
            mkdir( "../../".$path_type );       
        } 

        //destination
        $file = $path_type."/".$pdfName;

        //$extension = pathinfo($pdfName, PATHINFO_EXTENSION);//check if the extension is correct
        $tmp_file = $_FILES['patient_lab_res']['tmp_name'];
        //$size = $_FILES['patient_lab_res']['size'];//for size limit
      
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($tmp_file, "../../".$file)) {
                $insertSql = "INSERT INTO tbl_lab_result(patient_id,pdf_path,date,file_name) VALUES ('$patient_id','$file','$record_date','$pdfName');";
                if (mysqli_query($conn, $insertSql)) {
                    echo "File uploaded successfully";
                    header('Location: record_management.php');
                }else{
                    echo mysqli_error($conn);
                }
            } 
            else {
                echo "Failed to upload file.";
                echo mysqli_error($conn);
            }
  }



?>