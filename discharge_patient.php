<?php
include_once 'dbconn.php';
require_once __DIR__ . '/vendor/autoload.php';




if(isset($_POST['submit_discharged']))
{

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
		$patient_disposition_value = '{/} Transferred';
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


	$mpdf->OverWrite($pdf_path, $search, $replacement, 'F', $pdf_path );
	

	header('Location: record_management.php');
}
else{
	

	header('Location: record_management.php');
}




