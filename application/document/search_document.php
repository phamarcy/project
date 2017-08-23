<?php
require_once(__DIR__.'/../class/course.php');
$course = new Course();

if(isset($_POST['id']) && isset($_POST['type']))
{

  $id = $_POST['id'];
  if($_POST['type'] == 1)
  {
    $type = 'evaluate';
  }
  else if($_POST['type'] == 2)
  {
    $type = 'special';
  }
  else
  {
    die("Invalid type");
  }
  if(isset($_POST['semester']) && isset($_POST['year']))
  {
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $data = $course->Get_Document($type,$id,$semester,$year);
    echo $data;
  }
  else
  {
    $data = $course->Search_Document($type,$id);
    echo json_encode($data);
  }


}

 ?>
