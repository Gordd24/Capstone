
<?php

if(isset( $_GET['path']))
{
    $dir = "../../".$_GET['path'];

    // Header content type
    header("Content-type: application/pdf");
    
    header("Content-Length: " . filesize($dir));
    
    // Send the file to the browser.
    readfile($dir);
}
else{
    header("Location: record_management.php");
}

?>