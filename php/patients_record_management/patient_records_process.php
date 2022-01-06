<?php
session_start();

if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}

if (isset($_POST['hidden_field_admission']) && $_POST['hidden_field_admission'] === 'form_check'){
  // if (isset($_POST['admission'])){
      make_admission();
}

if (isset($_POST['hidden_field_consultation']) && $_POST['hidden_field_consultation'] === 'form_check'){
  // if (isset($_POST['consultation'])){
      make_consultation();
}

if (isset($_POST['hidden_field_medcert']) && $_POST['hidden_field_medcert'] === 'form_check'){
  // if (isset($_POST['consultation'])){
      make_medcert();
}

if (isset($_POST['hidden_field_labres']) && $_POST['hidden_field_labres'] === 'form_check'){
  // if (isset($_POST['labres'])){
      make_lab_res();
}
// if (isset($_POST['hidden_field_discharge']) && $_POST['hidden_field_discharge'] === 'form_check'){
  if (isset($_POST['discharge'])){
      discharge_patient();
}

function make_consultation() {
  include_once '../dbconn.php';
  require_once __DIR__ . '../../../vendor/autoload.php';
  $mpdf = new \Mpdf\Mpdf();
  date_default_timezone_set('Asia/Manila');
  $patient_id = $_POST['patient_id'];
  $patient_lname = strtolower($_POST['last_name']);
  $path_date = date("Ymdgis");
  $record_date = date("Y-m-d");
  $patient_name = $_POST['first_name']." ".$_POST['middle_name']." ".$_POST['last_name'];
  $patient_age = $_POST['age'];
  $patient_sex = $_POST['sex'];
  $patient_address = $_POST['address'];
  $patient_birthday = $_POST['birthday'];
  $patient_contact_no = $_POST['contact_no'];
  $date_today = date("F j, Y, g:i a");
  
  $patient_complaint = $_POST['complaint'];
  $patient_bp = $_POST['bp'];
  $patient_weight = $_POST['weight'];
  $patient_temp = $_POST['temp'];
  $patient_rr= $_POST['rr'];
  $patient_pr= $_POST['pr'];
  
  $ob_patient_lmp = $_POST['lmp']; 
  $ob_patient_aog= $_POST['aog'];
  $ob_patient_edc= $_POST['edc'];
  
  
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
  
  // header('Location: record_management.php');
  }

function make_admission(){
    include_once '../dbconn.php';
    require_once __DIR__ . '../../../vendor/autoload.php';
    
      $mpdf = new \Mpdf\Mpdf();
         //UNCOMMENT WHEN ISASAMA NA
        date_default_timezone_set('Asia/Manila');
    
        $patient_id = $_POST['patient_id'];
        $patient_lname = strtolower($_POST['last_name']);
        $path_date = date("Ymdgis");
        $record_date = date("Y-m-d");
        $patient_room_no = $_POST['room_no'];
        $patient_contact_no = $_POST['contact_no'];
        $patient_case_no = $_POST['case_no'];
        $patient_name = $_POST['first_name']." ".$_POST['middle_name']." ".$_POST['last_name'];
        $patient_age = $_POST['age'];
        $patient_sex = $_POST['sex'];
        $patient_cs = $_POST['cs'];
        $patient_religion = $_POST['religion'];
        $patient_address = $_POST['address'];
        $patient_birthday = $_POST['birthday'];
        $patient_occupation = $_POST['occupation'];
        $patient_philhealth_no = $_POST['philhealth_no'];
        $patient_father_name = $_POST['father'];
        $patient_mother_name = $_POST['mother'];
        $patient_spouse_name = $_POST['spouse'];
        $patient_date_of_marriage = $_POST['date_of_marriage'];
        $patient_place_of_marriage = $_POST['place_of_marriage'];
        $patient_date_admitted = $_POST['date_admitted'];
        $patient_time_admitted = $_POST['time_admitted'];
        $patient_admitted_by = $_POST['admitted_by'];
        $patient_physician = $_POST['physician'];
        $patient_admitting_diagnosis = $_POST['diagnosis'];
        $patient_disposition = '<td colspan="2" style="border-top: none; border-right: none;">{ } Discharged</td>
            <td colspan="2" style="border-top: none; border-right: none;  border-left: none; text-align:center;">{ } Transferred</td>
            <td colspan="1" style="border-top: none; border-right: none;  border-left: none; text-align:center;">{ } HAMA</td>
            <td colspan="2" style="border-top: none; border-right: none;  border-left: none; text-align:center;">{ } Absconded</td>
            <td colspan="1" style="border-top: none; border-left: none; text-align:center;">{ } DIED</td>';
            $mpdf->WriteHTML('
            <div  style="position:relative;">
            <table style="width:100%">
                <tr>
                <td><img src="..\..\..\images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
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
              //uncomment
              if (!is_dir( "../../".$path ) ) {
                  mkdir( "../../".$path );       
              } 
          
          
              $path_type = $path."/admission";
          
              //uncomment
              if (!is_dir( "../../".$path_type ) ) {
                  mkdir( "../../".$path_type );       
              }  
          
    
          
              $file = $path_type."/".$path_date."-".$patient_lname.".pdf";
              $file_name = $path_date."-".$patient_lname.".pdf";
          
              //uncomment
              $mpdf->Output("../../".$file,"F");
          
              /* Prepared statement, stage 1: prepare */
              $stmt = $connection->prepare("INSERT INTO tbl_admission(patient_id,pdf_path,date,file_name) VALUES (?,?,?,?);");
          
              /* Prepared statement, stage 2: bind and execute */
              $stmt->bind_param("ssss", $patient_id,$file,$record_date,$file_name ); // "is" means that $id is bound as an integer and $label as a string
          
              $stmt->execute();
          
              /* Prepared statement, stage 1: prepare */
              $stmt = $connection->prepare("UPDATE tbl_patients SET status = 'Admitted' WHERE patient_id = ?;");
          
              /* Prepared statement, stage 2: bind and execute */
              $stmt->bind_param("s", $patient_id); // "is" means that $id is bound as an integer and $label as a string
          
              $stmt->execute();
          
              // header('Location: record_management.php');
}
function make_medcert(){
  include_once '../dbconn.php';
    require_once __DIR__ . '../../../vendor/autoload.php';
    
      $mpdf = new \Mpdf\Mpdf();

      //POST INPUTS
    date_default_timezone_set('Asia/Manila');
    $patient_id = $_POST['patient_id'];
    $patient_lname = strtolower($_POST['last_name']);
    $path_date = date("Ymdgis");
    $record_date = date("Y-m-d");
    
    $patient_name = $_POST['first_name']." ".$_POST['middle_name']." ".$_POST['last_name'];
    $patient_name_age=$_POST['first_name']." ".$_POST['middle_name']." ".$_POST['last_name']." ".$_POST['age'];
    $patient_sex = $_POST['sex'];
    $patient_address = $_POST['address'];
    $date_today = date("F j, Y");
    $patient_diagnosis=$_POST['diagnosis'];
    $patient_recommendation=$_POST['recommendation'];
    $patient_physician= $_POST['physician'];
    $patient_physician_license=$_POST['license'];

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
      //uncomment once isasama na sa system
      if (!is_dir( "../../".$path ) ) {
          mkdir( "../../".$path );       
      } 
  
     
  
      $path_type = $path."/medical certificate";
      //uncomment once isasama na sa system
      if (!is_dir( "../../".$path_type ) ) {
          mkdir( "../../".$path_type );       
      } 
  
      $file = $path_type."/".$path_date."-".$patient_lname.".pdf";
      $file_name = $path_date."-".$patient_lname.".pdf";
      
      //uncomment once isasama na sa system
      $mpdf->Output("../../".$file,"F");

      /* Prepared statement, stage 1: prepare */
      $stmt = $connection->prepare("INSERT INTO tbl_med_cert(patient_id,pdf_path,date,file_name) VALUES (?,?,?,?);");
  
      /* Prepared statement, stage 2: bind and execute */
      $stmt->bind_param("ssss", $patient_id,$file,$record_date,$file_name ); // "is" means that $id is bound as an integer and $label as a string
    
      $stmt->execute();
        
      // header('Location: record_management.php');
  
}

function make_lab_res() {
  include_once '../dbconn.php';

  date_default_timezone_set('Asia/Manila');
  $patient_id = $_POST['patient_id'];
  $patient_lname = strtolower($_POST['last_name']);
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
                  // header('Location: record_management.php');
              }else{
                  echo mysqli_error($conn);
              }
          } 
          else {
              echo "Failed to upload file.";
              echo mysqli_error($conn);
          }
}

function discharge_patient() {
    include_once '../dbconn.php';
    require_once __DIR__ . '../../../vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();

        $mpdf->percentSubset = 0;

        // COMMENTED, POST INPUTS
        $patient_id = $_POST['patient_id'];


        $patient_date_discharged = $_POST['date_discharged'];
        $patient_time_discharged = $_POST['time_discharged'];
        $patient_discharged_by = $_POST['discharged_by'];
        $patient_transfered_to_room = $_POST['transfer_room'];
        $patient_transfered_to_room_date = $_POST['transfer_date'];
        $patient_transfered_to_room_time = $_POST['transfer_time'];

        $patient_final_diagnosis = $_POST['diagnosis'];
        $patient_ICD_10_code = $_POST['icd'];
        $patient_rvs_code = $_POST['rvs'];
        $patient_operations = $_POST['operation'];


        $patient_disposition = "";
        $patient_disposition_value = "";

        
        if(isset($_POST['disposition']))
        {
          if($_POST['disposition']=="discharge")
          {
          $patient_disposition = '{ } Discharged';
          $patient_disposition_value = '{/} Discharged';
          }
          else if($_POST['disposition']=='transferred')
          {
          $patient_disposition = '{ } Transferred';
          $patient_disposition_value = '{/} Transferred';
          }
          else if($_POST['disposition']=='hama')
          {
          $patient_disposition = '{ } HAMA';
          $patient_disposition_value = '{/} HAMA';
          }
          else if($_POST['disposition']=='absconded')
          {
          $patient_disposition = '{ } Absconded';
          $patient_disposition_value = '{/} Absconded';
          }
          else if($_POST['disposition']=='died')
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
  
    $pdf_path='';
    $get_med_stmt = $connection->prepare("SELECT pdf_path FROM tbl_admission WHERE patient_id = ? ORDER BY record_admission_id DESC;");

    /* Prepared statement, stage 2: bind and execute */
    $get_med_stmt->bind_param("s", $patient_id); // "is" means that $id is bound as an integer and $label as a string
    $get_med_stmt->execute();
    $med_result = $get_med_stmt->get_result();

    while ($row = $med_result->fetch_array(MYSQLI_ASSOC)) {
      echo 'pumasok sa loop';
      $pdf_path=$row['pdf_path'];
      echo 'pdf_path sa loop : ' . $pdf_path;
      break;
    }
    
    echo 'pdf_path: ' . $pdf_path;

  /* Prepared statement, stage 1: prepare */
  $stmt = $connection->prepare("UPDATE tbl_patients SET status = 'Not Admitted' WHERE patient_id = ?;");

  /* Prepared statement, stage 2: bind and execute */
  $stmt->bind_param("s", $patient_id); // "is" means that $id is bound as an integer and $label as a string

  $stmt->execute();


  $mpdf->OverWrite("../../".$pdf_path, $search, $replacement, 'F', "../../".$pdf_path );
  // header('Location: record_management.php'); 
}
?>