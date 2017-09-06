<?php
require_once(__DIR__.'/../class/course.php');
$course = new Course();
if(isset($_POST['DATA']))
{
  $data = $_POST['DATA'];
  $data = json_decode($data,true);
  $result = $course->Add_New_Course($data);
  echo json_encode($result);
}
 ?>
