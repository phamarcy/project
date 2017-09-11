<?php
require_once(__DIR__."/report.php");
$sender = new Report;

$data = [];
$data['COURSE_ID'] = '204111';
$data['TYPE'] = 'SPECIAL';
$data['NAME'] = 'ณรงค์รัชต์ หงส์อัศวิน';
$data['STATUS'] = '7';

$sender->Sendemail($data,"b.narongrat.hongatsawin@gmail.com");
 ?>
