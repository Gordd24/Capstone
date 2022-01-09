<?php
use PHPMailer\PHPMailer\PHPMailer;
include_once 'php/dbconn.php';

if(isset($_POST['email_check'])){
    $email = $_POST['email'];

    //check if user exists
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

        $output.= '<p>Please click the link to reset password</p>';
        $output.='<p><a href="http://localhost/capstoneprojek2/reset_password.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">http://localhost/capstoneprojek2/reset_password.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
        $body = $output;
        $subject = "Password Recovery";
        $email_to = $email;

        //autoload the php mailer

        require("vendor/autoload.php");
        
        $mail = new PHPMailer();
        $mail->CharSet =  "utf-8";
        $mail ->isSMTP();
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

?>