<?php

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['PASS_STATUS']) && $_SESSION['PASS_STATUS'] === 'default'){
  header("Location: ../../patient_website/change_patient_pass.php");
}


$ID = $_SESSION['PATIENT_ID'];
$sql = "SELECT * FROM tbl_patients where patient_id = '$ID'";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
$name = $row['first_name'].' '.$row['last_name'];


echo '<nav class="navbar navbar-expand-lg navbar-light sticky-top">
<div class="container-fluid">
  <a class="navbar-brand" href="#"><img class="logo" src="../../images/ofelia_logo.png" alt="Logo"></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      
      <a class="nav-link p-2 mx-2" id="profile" href="../profile/patient_profile.php"><i class="bx bxs-user"></i> '.$name.'</a>
      <a class="nav-link p-2 mx-2" id="records" href="../records/patient_records.php"><i class="bx bxs-folder-open"></i> Records</a>
      <a class="nav-link p-2 mx-2" id="history" href="../history/patient_history.php"><i class="bx bx-history"></i> History</a>
      <a class="nav-link p-2 mx-2" id="follow" href="../follow/patient_follow.php"><i class="bx bxs-message" ></i> Follow Up Results</a>
      <a class="nav-link p-2 mx-2" id="response" href="../response/response.php"><span id="response_notif"><i class="bx bxs-message-error"></i> Responses <sup></sup></span></a>
      <a class="nav-link p-2 mx-2" id="about" href="../about/about.php"><i class="bx bx-info-circle"></i> About</a>
      <a onclick = "logout()" class="nav-link p-2 mx-2" id="sign_out"><i class="bx bx-power-off"></i> Sign Out</a>
      
      
    </div>
  </div>
</div>
</nav>';

?>