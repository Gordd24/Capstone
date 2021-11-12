<?php

$file = "../../".$_GET['path'];
$file_name = $_GET['file_name'];

if (file_exists($file)) {
    
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
else{
    echo "Error!";
}


?>