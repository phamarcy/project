<?php
// $file = $_GET['file'];


$filename = "MyPDF"; 
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=MyPDF.pdf");
readfile('MyPDF.pdf');
 ?>