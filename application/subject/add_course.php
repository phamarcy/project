<?php
require_once(__DIR__.'/../class/course.php');
var_dump($_POST);
$course = new Course();
if(isset($_POST['data']))
{
  // $data = $_POST['data'];
  // $data = json_decode($data,true);
  // $result = $course->Add_New_Course($data);
}
 ?>
