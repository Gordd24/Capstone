<?php
session_start();
include_once 'php/dbconn.php';

if(isset($_SESSION["ID"])){
    header("Location:php/dashboard/dashboard.php");
}

if(isset($_SESSION["PATIENT_ID"])){
    header("Location:patient_website/profile/patient_profile.php");
}

if(isset($_SESSION["PATIENT_ID"]) && isset($_SESSION["PASS_STATUS"]) && $_SESSION["PASS_STATUS"]==='default'){
    header("Location:patient_website/change_patient_pass.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" />
     <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/pass_reset.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sign In</title>
</head>

<nav class="nav index_header p-2 text-white align-items-center">
    <img class="logo d-none d-md-block" id="logo" src="../../images/ofelia_logo.png" alt="Logo">
    <div class="fs-5 mx-3"> Ofelia L. Mendoza Maternity and General Hospital </div>
</nav>

<body>
    <form class="asm-form active" method="post" id="frmSignIn">
        <div class="asm-form__header fs-5">
            Sign In
        </div>

        <div class="asm-form__body">
            <!-- this is for toggle account type -->
            <div class="button-box">
                <div id="btn"></div>
                <div class="toggle-btn-div">
                    <input type="radio" name="account" id="patient" value="Patient" class="toggle-btn"
                        onclick="Patient()" checked><label for="patient" class="account-label"
                        id="patient-label">Patient</label>
                </div>

                <div class="toggle-btn-div">
                    <input type="radio" name="account" id="personnel" value="Personnel" class="toggle-btn"
                        onclick="Personnel()"><label for="personnel" class="account-label"
                        id="personnel-label">Personnel</label>
                </div>
            </div>


            <div class="asm-form__inputbox">
                <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" />
                </svg>
                <input class="asm-form__input" type="text" name="username" id="signinUsername" required
                    placeholder="username" autocomplete="off">
                <label class="asm-form__inputlabel" for="signinUsername">username</label>
            </div>
            <div class="asm-form__inputbox">
                <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M320 48c79.529 0 144 64.471 144 144s-64.471 144-144 144c-18.968 0-37.076-3.675-53.66-10.339L224 368h-32v48h-48v48H48v-96l134.177-134.177A143.96 143.96 0 0 1 176 192c0-79.529 64.471-144 144-144m0-48C213.965 0 128 85.954 128 192c0 8.832.602 17.623 1.799 26.318L7.029 341.088A24.005 24.005 0 0 0 0 358.059V488c0 13.255 10.745 24 24 24h144c13.255 0 24-10.745 24-24v-24h24c13.255 0 24-10.745 24-24v-20l40.049-40.167C293.106 382.604 306.461 384 320 384c106.035 0 192-85.954 192-192C512 85.965 426.046 0 320 0zm0 144c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z" />
                </svg>
                <input class="asm-form__input" type="password" name="password" id="signinPassword" required
                    placeholder="password">
                <label class="asm-form__inputlabel" for="signinPassword">password</label>
            </div>
            <input type="hidden" name="hidden_field_signin" id="hidden_field_signin" value="form_check">
            <div class="asm-form__leverbox">
                <button type="button" class="asm-form__link" data-action="show-form" data-target="#frmForget">Forgot
                    password</button>
            </div>
        </div>

        <div class="asm-form__footer">
            <button class="asm-form__btn" name="signinSubmit" id="signinSubmit">Sign In</button>
        </div>
    </form>

    <form method="POST" class="asm-form" id="frmForget">
        <div class="asm-form__header fs-5">
            Forget Password
        </div>
        <!-- this is for toggle account type -->
        <div class="button-box">
                <div id="forgot_btn"></div>
                <div class="toggle-btn-div">
                    <input type="radio" name="forgot_account" id="forgot_patient" value="patient" class="toggle-btn"
                    onclick="Forgot_Patient()" checked><label for="forgot_patient" class="account-label"
                    id="forgot_patient-label">Patient</label>
                </div>

                <div class="toggle-btn-div">
                    <input type="radio" name="forgot_account" id="forgot_personnel" value="personnel" class="toggle-btn"
                    onclick="Forgot_Personnel()"><label for="forgot_personnel" class="account-label"
                    id="forgot_personnel-label">Personnel</label>
                </div>
        </div>



        <div class="asm-form__body">
            <div class="asm-form__linkbox">
                <button type="button" class="asm-form__link" data-action="show-form" data-target="#frmSignIn">Sign
                    in</button>
            </div>
            <div class="asm-form__inputbox">
                <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z" />
                </svg>
                <input class="asm-form__input validate" type="email" name="email" id="forgetEmail"  placeholder="email">
                <label class="asm-form__inputlabel" for="forgetEmail">email</label>
            </div>
            <div class="error" id="email_error"></div>
            <input type="hidden" name="hidden_field_forget" id="hidden_field_forget" value="form_check">
        </div>
        
        
        
        <div class="asm-form__footer">
            <button class="asm-form__btn" name='forgetSubmit' id="forgetSubmit">Send</button>
        </div>
    </form>

    <script src="js/index.js" type="text/javascript"></script>
    <script>
        var z = document.getElementById("btn");
        var personnel = document.getElementById("personnel-label");
        var patient = document.getElementById("patient-label");
        function Personnel() {

            z.style.left = "50%";
            patient.style.color = "black";
            personnel.style.color = "white";


        }
        function Patient() {
            z.style.left = "0";
            personnel.style.color = "black";
            patient.style.color = "white";
        }


        var forgot_z = document.getElementById("forgot_btn");
        var forgot_personnel = document.getElementById("forgot_personnel-label");
        var forgot_patient = document.getElementById("forgot_patient-label");
        function Forgot_Personnel() {

            forgot_z.style.left = "50%";
            forgot_patient.style.color = "black";
            forgot_personnel.style.color = "white";


        }
        function Forgot_Patient() {
            forgot_z.style.left = "0";
            forgot_personnel.style.color = "black";
            forgot_patient.style.color = "white";
        }

    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>