<?php
require_once(__DIR__.'/../class/course.php');
$course = new Course();

if(isset($_POST['id']) && isset($_POST['type']))
{
  if(isset($_POST['instructor_id']))
  {
    $instructor_id = $_POST['instructor_id'];
  }
  else
  {
    $instructor_id = null;
  }

  $course_id = $_POST['id'];
  if($_POST['type'] == 1)
  {
    $type = 'evaluate';
    $instructor_id = null;
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

    $data = $course->Get_Document($type,$id,$instructor_id,$semester,$year);
    if($data == false)
    {
      echo "ไม่พบข้อมูล กรุณาติดต่อผู้ดูแลระบบ";
    }
    else
    {
      echo $data;
    }

  }
  else
  {
    $data = $course->Search_Document($type,$course_id);
    echo json_encode($data);
  }


}

 ?>
