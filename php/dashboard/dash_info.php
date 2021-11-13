<?php

if (!isset($_SESSION)) {
    session_start();
  }
    include_once '../dbconn.php';
    
    $sql1 = "SELECT * FROM tbl_patients";
    $total_patient = $conn -> query($sql1);
    $sql2 = "SELECT * FROM tbl_patients WHERE sex = 'Male'";
    $total_male_patient = $conn -> query($sql2);
    $sql3 = "SELECT * FROM tbl_patients WHERE sex = 'Female'";
    $total_female_patient = $conn -> query($sql3);
    $sql4 = "SELECT * FROM tbl_consult";
    $total_consult = $conn -> query($sql4);
    $sql5 = "SELECT * FROM tbl_admission";
    $total_admission = $conn -> query($sql5);
    $sql6 = "SELECT * FROM tbl_med_cert";
    $total_med_cert = $conn -> query($sql6);
    $sql7 = "SELECT * FROM tbl_lab_result";
    $total_lab_res = $conn -> query($sql7);
    $sql8 = "SELECT * FROM tbl_patients WHERE status = 'Admitted'";
    $total_admitted = $conn -> query($sql8);
    $total_records = $total_med_cert->num_rows+$total_lab_res->num_rows+$total_admission->num_rows+$total_consult->num_rows;

    echo " <div class='set'>
    <h1>Patients</h1>
    <div class='block_div'>
        <div class='block total'>
            <div class='icon_div'><i class='bx bxs-user'></i></div>
            <div class='label_div'>".$total_patient->num_rows." Total Patients</div>
        </div>
        <div class='block male'>
            <div class='icon_div'><i class='bx bxs-user'></i></div>
            <div class='label_div'>".$total_male_patient->num_rows." Male</div>
        </div>
        <div class='block female'>
            <div class='icon_div'><i class='bx bxs-user'></i></div>
            <div class='label_div'>".$total_female_patient->num_rows." Female</div>
        </div>
    </div>
    </div>
    <div class='set'>
    <h1>Records</h1>
        <div class='block_div'>
            <div class='block record'>
                <div class='icon_div'><i class='bx bxs-box'></i></div>
                <div class='label_div'>".$total_records." Total Records</div>
            </div>
        </div>
        <div class='block_div'>
            <div class='block consultation'>
                <div class='icon_div'><i class='bx bx-note'></i></div>
                <div class='label_div'>".$total_consult->num_rows." Consultation</div>
            </div>
            <div class='block admission'>
                <div class='icon_div'><i class='bx bxs-user-plus'></i></div>
                <div class='label_div'>".$total_admission->num_rows." Admission</div>
            </div>
            <div class='block med_cert'>
                <div class='icon_div'><i class='bx bxs-certification'></i></div>
                <div class='label_div'>".$total_med_cert->num_rows." Certificates</div>
            </div>
            <div class='block lab_res'>
                <div class='icon_div'><i class='bx bx-test-tube'></i></div>
                <div class='label_div'>".$total_lab_res->num_rows." Laboratory</div>
            </div>
        </div>
    </div>
    <div class='set'>
        <h1>Currently Admitted</h1>
        <div class='block_div'>
            <div class='block admitted'>
                <div class='icon_div'><i class='bx bxs-group'></i></div>
                <div class='label_div'>".$total_admitted->num_rows." Admitted</div>
            </div>
        </div>
    </div>";
        



?>