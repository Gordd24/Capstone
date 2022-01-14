<?php

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}

echo '<nav class="navbar navbar-expand-lg navbar-light sticky-top">
<div class="container-fluid">
  <a class="navbar-brand" href="#"><img class="logo" src="../../images/ofelia_logo.png" alt="Logo"></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      
      <a class="nav-link text-white p-2 mx-2" id="profile" href="../profile/patient_profile.php"><i class="bx bxs-user"></i> Profile</a>
      <a class="nav-link text-white p-2 mx-2" id="records" href="../records/patient_records.php"><i class="bx bxs-folder-open"></i> Records</a>
      <a class="nav-link text-white p-2 mx-2" id="follow" href="../follow/patient_follow.php"><i class="bx bxs-message" ></i> Follow Up Results</a>
      <a class="nav-link text-white p-2 mx-2" id="response" href="../response/response.php"><i class="bx bxs-message-error"></i> Responses</a>
      <a class="nav-link text-white p-2 mx-2" id="contact" href="../about/about.php"><i class="bx bx-info-circle"></i> About</a>
      <a onclick = "logout()" class="nav-link p-2 mx-2 text-white" id="sign_out"><i class="bx bx-power-off"></i> Sign Out</a>
      
    </div>
  </div>
</div>
</nav>';

?>