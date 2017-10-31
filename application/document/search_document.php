<?php
session_start();
require_once(__DIR__.'/../class/course.php');
$course = new Course();
if(isset($_POST['course_id']) && isset($_POST['type']))
{
  if(isset($_POST['instructor_id']))
  {
    $instructor_id = $_POST['instructor_id'];
  }
  else
  {
    $instructor_id = null;
  }

  $course_id = $_POST['course_id'];
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
  else if(isset($_POST['semester']) && isset($_POST['year']))
  {
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    if($type == 'evaluate')
    {
      $data = $course->Get_Document($type,$course_id,$instructor_id,$_SESSION['id'],$semester,$year);
      if($data == false)
      {
        $data['status'] = 'error';
        $data['msg'] = "ไม่พบข้อมูล กรุณาติดต่อผู้ดูแลระบบ";
        echo json_encode($data);
        die;
      }
      else
      {
        echo json_encode($data);
      }
    }
    else if ($type == 'special')
    {
      
    }


  }
  else
  {
    $data = $course->Search_Document($type,$course_id,$_SESSION['id']);
    echo json_encode($data);
  }


}

 ?>
