<?php


$dir = "patient/Jasper Jake  Mendoza/admission/2021111082522-mendoza.pdf";


// on the server

  
// Header content type
header("Content-type: application/pdf");
  
header("Content-Length: " . filesize($dir));
  
// Send the file to the browser.
readfile($dir);

?>