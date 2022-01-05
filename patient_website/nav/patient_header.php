<?php

echo '<nav class="navbar navbar-expand-lg navbar-light">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Ofelia</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link p-2 mx-2 text-white" id="sign_out" href="../sign_out/sign_out.php">Sign Out <i class="bx bx-power-off"></i></a>
      <a class="nav-link text-white p-2 mx-2" id="profile" href="../profile/patient_profile.php">Profile <i class="bx bxs-user"></i></a>
      <a class="nav-link text-white p-2 mx-2" id="records" href="../records/patient_records.php">Records <i class="bx bxs-folder-open"></i></a>
      <a class="nav-link text-white p-2 mx-2" id="follow" href="../follow/patient_follow.php">Follow Up Results <i class="bx bxs-message" ></i></i></a>
      <a class="nav-link text-white p-2 mx-2" id="contact" href="../contact/patient_contact.php">Contact <i class="bx bxs-phone"></i></a>
      
    </div>
  </div>
</div>
</nav>';

?>