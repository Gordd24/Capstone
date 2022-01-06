<?php
session_start();

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  echo "error";
  header("Location: ../../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Follow Up</title>
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="patient_follow.css">
  <link rel="stylesheet" href="../nav/patient_header.css">
   <!-- boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

  <div class="row justify-content-center my-3">
    <div class="col-12 col-sm-8 p-2">

        
        <div class="row">
          <div class="col text-center">
            <h3>Select Results</h3>
          </div>
        </div>

        <form>
            <!-- div for check results -->
            <div class="row border rounded m-2">
              <div class="col-12">

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="cbc" value="cbc">
                      <label class="form-check-label" for="cbc">
                        Complete Blood Count (CBC)
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="platelet" value="platelet">
                      <label class="form-check-label" for="platelet">
                        Platelet Count
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="blood_typing" value="blood_typing">
                      <label class="form-check-label" for="blood_typing">
                        Blood Typing
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="cross_matching" value="cross_matching">
                      <label class="form-check-label" for="cross_matching">
                        Cross Matching
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="hepatitis_b" value="hepatitis_b">
                      <label class="form-check-label" for="hepatitis_b">
                        Hepatitis B
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="bun" value="bun">
                      <label class="form-check-label" for="bun">
                        Blood Urea Nitrogen (BUN)
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="creatinine" value="creatinine">
                      <label class="form-check-label" for="creatinine">
                        Creatinine
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="fbs" value="fbs">
                      <label class="form-check-label" for="fbs">
                        Fasting Blood Sugar (FBS)
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="fecalysis" value="fecalysis">
                      <label class="form-check-label" for="fecalysis">
                        Fecalysis
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                <!-- check row  -->
                <div class="row">

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="cholesterol" value="cholesterol">
                      <label class="form-check-label" for="cholesterol">
                        Cholesterol
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="uric_acid" value="uric_acid">
                      <label class="form-check-label" for="uric_acid">
                        Uric Acid
                      </label>
                    </div>
                  
                  </div>

                  <div class="col-12 col-sm-4 p-2">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="urinalysis" value="urinalysis">
                      <label class="form-check-label" for="urinalysis">
                        Urinalysis
                      </label>
                    </div>
                  
                  </div>

                </div>
                <!-- check row end-->

                 <!-- follow submit  -->
                 <div class="row justify-content-center">
                    <div class="col-12 col-sm-4 p-2">
                        <input class="form-control" type="submit" name="follow" value="Follow Up">
                    </div>
                </div>
                <!-- follow submit end-->

              </div>
            </div>
            
            <!-- div for check results end -->
        </form>
        


    </div>
  </div>


                                        




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







