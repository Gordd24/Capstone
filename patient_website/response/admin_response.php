<?php

session_start();

if(!(isset($_SESSION['PATIENT_ID']))||empty($_SESSION['PATIENT_ID'])){
  header("Location: ../../index.php");
}
if(isset($_SESSION['ID'])){
  header("Location: ../../index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact</title>
 <!-- bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="admin_response.css">
  <link rel="stylesheet" href="../nav/patient_header.css">
   <!-- boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <?php include_once '../nav/patient_header.php' ?>

    <div class="row">
      <div class="col">

                                        <!-- table row  -->
                                        <div class="row justify-content-center my-3 mx-2">
                                            <div class="col-12 col-sm-7 ">

                                                <table class="table">
                                                    <thead class="text-white bg-primary">
                                                        <tr>
                                                            <th scope="col">Responses</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- table row end -->
                                        

      </div>
    </div>


                                        

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







