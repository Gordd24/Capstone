<?php
session_start();
include_once 'dbconn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
        <div class="title_logo">
            <div class="title_logo_cont">
                <img class="logo" src="images/ofelia_logo.png" alt="Logo">
                <h1 class="hosp_name">OFELIA L. MENDOZA<br/> MATERNITY AND <br/> GENERAL HOSPITAL</h1>
            </div>
        </div>

        <div class="input">
            <div class="input_box">
                <form action="index.php" method="post">
                    <input class="fields" id="username" type="text" name="Username" placeholder="Username" required= ""><br>
                    <input class="fields" id="password" type="password" name = "Password" placeholder="Password" required= ""><br>
                    <input class="button" type="submit" name="login" value="Log In">
                </form>
            </div>
        </div>


<?php
    if(isset($_POST['login'])){
        $Username =$_POST['Username'];
        $Password =$_POST['Password'];

        $select = mysqli_query($conn,"SELECT * FROM tbl_accounts WHERE username = '$Username' AND password = '$Password'");

        $row = mysqli_fetch_array($select);
        

        if(is_array($row)){
            $_SESSION["Username"] = $row['username'];
            $_SESSION["Password"] = $row['password'];
            
        }else{
            echo '<script type = "text/javascript">';
            echo 'alert("Invalid Username or Password!");';
            echo 'window.location.href = "index.php" ';
            echo '</script>';
        }
    }
    if(isset($_SESSION["Username"])){
        header("Location:home.php");
    }
    ?>
</body>
</html>