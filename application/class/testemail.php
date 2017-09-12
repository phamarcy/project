<?php
require_once(__DIR__."/report.php");
$sender = new Report;

$data = [];
$data['COURSE_ID'] = '204111';
$data['TYPE'] = '1';
$data['NAME'] = 'ณรงค์รัชต์ หงส์อัศวิน';
$data['STATUS'] = '7';
$data['DATE_USER'] = date("d-m-Y");
$data['TIME_USER'] = date("h:i:sa");

$sender->Sendemail('619',$data);
 ?>
