<?php

echo '<nav class="navbar navbar-expand-lg navbar-light">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Ofelia</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link text-white p-2" id="profile" href="../profile/patient_profile.php">Profile</a>
      <a class="nav-link text-white p-2" id="records" href="../records/patient_records.php">Records</a>
      <a class="nav-link text-white p-2" id="follow" href="../follow/patient_follow.php">Follow Up Results</a>
      <a class="nav-link text-white p-2" id="contact" href="../contact/patient_contact.php">Contact</a>
      <a class="nav-link text-danger p-2" id="sign_out" href="../sign_out/sign_out.php">Sign Out</a>
    </div>
  </div>
</div>
</nav>';

?>