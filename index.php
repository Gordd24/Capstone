<?php
session_start();
$conn = mysqli_connect('localhost','root', '','olmmgh_db') or die ('Unable to Connect');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <div>
        <form action="index.php" method="post">
            <input class="fields" type="text" name="Username" placeholder="Username" required= ""><br>
            <input class="fields" type="password" name = "Password" placeholder="Password" required= ""><br>
            <input class="fields" type="submit" name="login" value="Login">
        </form>
    </div>

<?php
    if(isset($_POST['login'])){
        $Username =$_POST['Username'];
        $Password =$_POST['Password'];

        $select = mysqli_query($conn,"SELECT * FROM tb_login WHERE Username = '$Username' AND Password = '$Password'");

        $row = mysqli_fetch_array($select);
        

        if(is_array($row)){
            $_SESSION["Username"] = $row['Username'];
            $_SESSION["Password"] = $row['Password'];
            
        }else{
            echo '<script type = "text/javascript">';
            echo 'alert("Invalid Username or Password!");';
            echo 'window.location.href = "index.php" ';
            echo '</script>';
        }
    }
    if(isset($_SESSION["Username"])){
        header("Location:login.php");
    }
    ?>
</body>
</html>