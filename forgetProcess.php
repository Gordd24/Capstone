<?php
session_start();
if(isset($_SESSION["ID"])){
    header("Location:php/dashboard/dashboard.php");
}

if(isset($_SESSION["PATIENT_ID"])){
    header("Location:patient_website/profile/patient_profile.php");
}
use PHPMailer\PHPMailer\PHPMailer;
include_once 'php/dbconn.php';


//for patient
if(isset($_POST['email_check'])){
    
        $email = $_POST['email'];

        //check if user exists
        $selectEmail;
        
        $selectEmail = $connection->prepare("SELECT email FROM tbl_patients WHERE email = ?");
        
        $selectEmail->bind_param('s',$email);
        $selectEmail->execute();
        $selectEmail->store_result();

        if($selectEmail->num_rows>0){
            //user exist
            echo "0";
        }
        else{
            //user does not exist
            echo "1";
        }
        $selectEmail->close();
}



if (isset($_POST['hidden_field_forget']) && $_POST['hidden_field_forget'] === 'form_check'){
    // if(isset($_POST['forgetSubmit'])){
        if(isset($_POST['forgot_account'])&&$_POST['forgot_account']=='patient'){
            
            echo 'patient';
                $categ = $_POST['account'];
                $email = $_POST['email'];
                $stmt = $connection->prepare('SELECT email from tbl_patients WHERE email=?');
                $stmt->bind_param('s',$email);
                $stmt->execute();
                $stmt->store_result();
    
                if($stmt->num_rows>0){
                    
                    $output = '';
                    $stmt->close();
                    $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                    $expDate = date("Y-m-d H:i:s", $expFormat);
                    $key = md5(time());
                    $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                    $key = $key . $addKey;
    
                    $insert = 'INSERT INTO tbl_password_reset(email, email_key, exp_date) VALUES (?,?,?)';
                    $pass_reset = $connection->prepare($insert);
                    $pass_reset->bind_param('sss',$email, $key, $expDate);
                    $pass_reset->execute();
                    
                    $output.= '<p>Hi Patient</p>';
                    $output.= '<p>Please click the link to reset password</p>';
                    $output.='<p><a href="https://olmmghcapstoneproject.000webhostapp.com/reset_password.php?key=' . $key . '&email=' . $email . '&categ='. $categ . '&action=reset" target="_blank">https://olmmghcapstoneproject.000webhostapp.com/reset_password.php?key=' . $key . '&email=' . $email . '&categ='. $categ . '&action=reset</a></p>';
    
                    $body = $output;
                    $subject = "Password Recovery";
                    $email_to = $email;
                    echo 'pasok3';
                    //autoload the php mailer
    
                    
                    require_once 'vendor/autoload.php';
                    
                    $mail = new PHPMailer();
                    $mail->CharSet =  "utf-8";
                    if($mail ->isSMTP())
                    $mail->SMTPDebug = 2;
                    $mail->SMTPAuth = true;
                    $mail->Username = "capstoneolmmgh@gmail.com";
                    // GMAIL password
                    $mail->Password = "capstoneolmmgh123";
                    $mail->SMTPSecure = "ssl";  
                    $mail->Host = "smtp.gmail.com";
                    // set the SMTP port for the GMAIL server
                    $mail->Port = "465";
                    $mail->From='capstoneolmmgh@gmail.com';
                    $mail->FromName='Caps_Stone';
                    $mail->AddAddress($email_to);
                    $mail->Subject  =  $subject;
                    $mail->Body= $body;
                    $mail->IsHTML(true);
                    
                        if($mail->Send())
                        {
                        echo "Check Your Email and Click on the link sent to your email";
                        }
                        else
                        {
                        echo "Mail Error - >".$mail->ErrorInfo;
                        }
                }else{
                    echo'wala';
                    $stmt->close();
            }
        }
        if(isset($_POST['account'])&&$_POST['account']=='personnel'){
            echo 'personnel';
                $categ = $_POST['account'];
                $email = $_POST['email'];
                $stmt = $connection->prepare('SELECT email from tbl_accounts WHERE email=?');
                $stmt->bind_param('s',$email);
                $stmt->execute();
                $stmt->store_result();
    
                if($stmt->num_rows>0){
                    $output = '';
                    $stmt->close();
                    $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                    $expDate = date("Y-m-d H:i:s", $expFormat);
                    $key = md5(time());
                    $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                    $key = $key . $addKey;
    
                    $insert = 'INSERT INTO tbl_password_reset(email, email_key, exp_date) VALUES (?,?,?)';
                    $pass_reset = $connection->prepare($insert);
                    $pass_reset->bind_param('sss',$email, $key, $expDate);
                    $pass_reset->execute();
    
                    $output.= '<p>Hi Personnel</p>';
                    $output.= '<p>Please click the link to reset password</p>';
                    $output.='<p><a href="https://olmmghcapstoneproject.000webhostapp.com/reset_password.php?key=' . $key . '&email=' . $email . '&categ='. $categ . '&action=reset" target="_blank">https://olmmghcapstoneproject.000webhostapp.com/reset_password.php?key=' . $key . '&email=' . $email . '&categ='. $categ . '&action=reset</a></p>';
    
                    $body = $output;
                    $subject = "Password Recovery";
                    $email_to = $email;
    
                    //autoload the php mailer
    
                    require_once 'vendor/autoload.php';
                    
                    $mail = new PHPMailer();
                    $mail->CharSet =  "utf-8";
                    if($mail ->isSMTP())
                    $mail->SMTPDebug = 2;
                    $mail->SMTPAuth = true;
                    $mail->Username = "capstoneolmmgh@gmail.com";
                    // GMAIL password
                    $mail->Password = "capstoneolmmgh123";
                    $mail->SMTPSecure = "ssl";  
                    $mail->Host = "smtp.gmail.com";
                    // set the SMTP port for the GMAIL server
                    $mail->Port = "465";
                    $mail->From='capstoneolmmgh@gmail.com';
                    $mail->FromName='Caps_Stone';
                    $mail->AddAddress($email_to);
                    $mail->Subject  =  $subject;
                    $mail->Body= $body;
                    $mail->IsHTML(true);
                    
                        if($mail->Send())
                        {
                        echo "Check Your Email and Click on the link sent to your email";
                        }
                        else
                        {
                        echo "Mail Error - >".$mail->ErrorInfo;
                        }
                }else{
                    echo'wala';
                    $selectUser->close();
            }
        }
    
    }

?>