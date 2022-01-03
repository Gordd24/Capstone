<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../nav/patient_nav.css">
  <link rel="stylesheet" href="patient_profile.css">


  <!-- javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="patient_profile.js"></script>


 
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>
  <?php
    include_once '../dbconn.php';
    if(isset($_SESSION['ID'])){
        $id = $_SESSION['ID'];
      
        /* Prepared statement, stage 1: prepare */
        $stmt = $connection->prepare("SELECT * FROM tbl_patients where patient_id = ?");

        /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("i", $id); // "is" means that $id is bound as an integer and $label as a string
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $sex_field = '';

        if($row['sex']=='Male')
        {
            $sex_field .= '<div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input edit_info edit_sex" type="radio" name="sex" disabled required id="male" value="Male" checked>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input edit_info edit_sex" type="radio" name="sex" disabled required id="female" value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>';
        }else if($row['sex']=='Female')
        {
            $sex_field .= '<div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input edit_info edit_sex" type="radio" name="sex" disabled required id="male" value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input edit_info edit_sex" type="radio" name="sex" disabled required id="female" value="Female" checked>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>';
        }

    }
    ?>

  <main class="container justify-content-center">
    <div class="row">
      <div class="col">

        <!-- name row -->
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 border rouded my-5 p-2" id="edit_name_div">
                <form method="POST" action="update_patient.php?id=<?php echo $id; ?>">
                <h3>Your Name</h3>
                    <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" value="" id="edit_name">
                        <label class="form-check-label" for="edit_name">
                            Update Name
                        </label>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control edit_name" id="first_name" name="first_name"  value="<?php echo $row['first_name']; ?>" required readonly autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3  justify-content-center">
                        <div class="col">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control edit_name" id="middle_name" name="middle_name"  value="<?php echo $row['middle_name']; ?>" readonly autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3  justify-content-center">
                        <div class="col">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control edit_name" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>"  required readonly autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3  justify-content-center d-none" id="up_name_btn">
                        <div class="col">
                            <input type="submit" id="update_name_submit" class="form-control btn apply_btn text-white" name="edit_name" value="Apply Changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>    
        <!-- name row end -->

        <!-- other -->
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 border rouded my-5 p-2" id="edit_info_div">
                <form method="POST" action="update_patient.php?id=<?php echo $id; ?>">
                <h3>Other Information</h3>
                    <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" value="" id="edit_info">
                    <label class="form-check-label" for="edit_info">
                        Update Information
                    </label>
                    </div>

                    <div class="row mb-3 justify-content-center align-items-center">
                        <div class="col-8">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control edit_info" id="birthday" name="birthday" value="<?php echo $row['birthdate']; ?>" required readonly>
                        </div>
                        <!-- radio button -->
                        <div class="col-4">

                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Sex</label>
                                </div>
                            </div>

                            <?php echo $sex_field; ?>

                        </div>
                        <!-- radio button end-->

                        
                    </div>

                    <div class="row mb-3  justify-content-center">
                        <div class="col">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control edit_info" id="address" name="address" value="<?php echo $row['address']; ?>"  required readonly autocomplete="off">
                        </div>
                    </div>

                    

                    <div class="row mb-3  justify-content-center d-none" id="up_info_btn">
                        <div class="col">
                            <input type="submit" id="update_info_submit" class="form-control btn apply_btn text-white" name="edit_info" value="Apply Changes">
                        </div>
                    </div>

                </form>
            </div>
        </div>    
        <!-- other end -->

        <!-- optional -->
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 border rouded my-5 p-2" id="edit_optional_div">
                <form method="POST" action="update_patient.php?id=<?php echo $id; ?>">
                <h3>Other Information (Optional)</h3>
                    <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" value="" id="edit_optional">
                    <label class="form-check-label" for="edit_optional">
                        Update Information
                    </label>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="text" class="form-control edit_optional" id="contact_no" name="contact_no"  value="<?php echo $row['contact_no']; ?>" readonly autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col">
                            <label for="religion" class="form-label">Religion</label>
                            <input type="text" class="form-control edit_optional" id="religion" name="religion"  value="<?php echo $row['religion']; ?>" readonly autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control edit_optional" id="occupation" name="occupation"  value="<?php echo $row['occupation']; ?>" readonly autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3  justify-content-center d-none" id="up_optional_btn">
                        <div class="col">
                            <input type="submit" id="update_optional_submit" class="form-control btn apply_btn text-white" name="edit_optional" value="Apply Changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>    
        <!-- optional end -->

        <!-- email row  -->
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 border rouded my-5 p-2" id="edit_email_div">
                <form method="POST" action="update_patient.php?id=<?php echo $id; ?>">
                <h3>Email</h3>
                    <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" value="" id="edit_email">
                        <label class="form-check-label" for="edit_email">
                            Update Email
                        </label>
                    </div>
                    <div class="row mb-3  justify-content-center">
                        <div class="col">
                            <input type="text" class="form-control edit_email" id="email" name="email" value="<?php echo $row['email']; ?>" required readonly autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3  justify-content-center d-none" id="up_email_btn">
                        <div class="col">
                            <input type="submit" id="update_email_submit"  class="form-control btn apply_btn text-white" name="edit_email"  value="Apply Changes">
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- email row end -->


       
      </div> <!-- END - .small-12 -->
    </div> <!-- END - .row -->
  </main> <!-- END - main -->



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/js/foundation.min.js"></script>
  <script src="patient_home.js"></script>
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







