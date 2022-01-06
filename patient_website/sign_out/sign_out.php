<?php

session_start();


if(isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}else if(session_destroy()){
    session_unset();
    header("location: ../../index.php");
}

?>







