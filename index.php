<?php

session_start();
include_once 'php/dbconn.php';

if(isset($_SESSION["ID"])){
    header("Location:php/dashboard/dashboard.php");
}


if(isset($_POST["signinSubmit"]))
{
   if(isset($_POST['account'])&&$_POST["account"]=="Patient")
   {
        
        $username =$_POST['username'];
        $password =$_POST['password'];
        $patient_id = '';

        $get_patient_account = $connection->prepare("SELECT patient_id,username,password FROM tbl_patients WHERE username = ?");
    
            /* Prepared statement, stage 2: bind and execute */
            $get_patient_account->bind_param("s", $username); // "is" means that $id is bound as an integer and $label as a string
            $get_patient_account->execute();
            $patient_account = $get_patient_account->get_result();

            if($patient_account->num_rows>0)
            {
                while ($row = $patient_account->fetch_array(MYSQLI_ASSOC)) {
                    
                    $test_pass = $row['password'];
                    $patient_id = $row['patient_id'];
        
                }

                if(password_verify($password, $test_pass)){
                    $_SESSION["ID"] = $patient_id;
                    header("Location:patient_website/profile/patient_profile.php");
                }
                else{
                    echo '<script type = "text/javascript">';
                    echo 'alert("Invalid Username or Password!");';
                    echo '</script>';
                }
            }else{
                echo '<script type = "text/javascript">';
                echo 'alert("Account Does Not Exist");';
                echo '</script>';
            }
   }
   if(isset($_POST['account'])&&$_POST["account"]=="Personnel")
   {
        $Username =$_POST['username'];
        $Password =$_POST['password'];

        $select = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$Username' AND password = '$Password'");
        $selectUname = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$Username'");
        //$selectPos = mysqli_query($conn,"SELECT position FROM tbl_accounts WHERE username = '$Username'");

        $row = mysqli_fetch_array($selectUname);
        
        if(password_verify($Password, $row['password'])){
            $_SESSION["ID"] = $row['acc_id'];
            $_SESSION["position"] = $row['position'];
        }
        else{
            echo '<script type = "text/javascript">';
            echo 'alert("Invalid Username or Password!");';
            echo 'window.location.href = "index.php" ';
            echo '</script>';
        }

        if(isset($_SESSION["ID"])){
            header("Location:php/dashboard/dashboard.php");
        }
   }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">

    <title>Sign In</title>

</head>

<body>
    <form class="asm-form active" method="post" id="frmSignIn">
        <div class="asm-form__header">
            <h2>Sign In</h2>
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
            <div class="asm-form__leverbox">
                <button type="button" class="asm-form__link" data-action="show-form" data-target="#frmForget">Forgot
                    password</button>
            </div>
        </div>

        <div class="asm-form__footer">
            <button class="asm-form__btn" name="signinSubmit" id="signinSubmit">Sign In</button>
        </div>
    </form>

    <form action="#" class="asm-form" id="frmForget">
        <div class="asm-form__header">
            <h2>Forget Password</h2>
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
                <input class="asm-form__input validate" type="email" name="email" id="forgetEmail" required
                    placeholder="email">
                <label class="asm-form__inputlabel" for="forgetEmail">email</label>
            </div>
        </div>

        <div class="asm-form__footer">
            <button class="asm-form__btn" id="forgetSubmit">Send</button>
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

    </script>

</body>

</html>