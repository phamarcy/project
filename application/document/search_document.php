<?php
session_start();
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/person.php');
$course = new Course();
$person = new Person();
if(isset($_POST['type']))
{
  if(isset($_POST['instructor_id']))
  {
    $instructor_id = $_POST['instructor_id'];
  }
  else
  {
    $instructor_id = null;
  }
  if(isset($_POST['course_id']) )
  {
    $course_id = $_POST['course_id'];
  }
  if($_POST['type'] == 1)
  {
    $type = 'evaluate'; //evaluate form
    $instructor_id = null;
  }
  else if($_POST['type'] == 2)
  {
    $type = 'special'; // special instructor form
  }
  else if($_POST['type'] == 3)
  {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $data = $person->Get_Special_Instructor_Data($firstname,$lastname);
    if(!$data)
    {
      $data['status'] = 'error';
      $data['msg'] = "ไม่พบข้อมูล";
    }
    echo json_encode($data);
    die;
  }
  else
  {
    die("Invalid type");
  }
  if(isset($_POST['semester']) && isset($_POST['year']))
  {
    $semester = $_POST['semester'];
    $year = $_POST['year'];
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
  else
  {
    $data = $course->Search_Document($type,$course_id,$_SESSION['id']);
    echo json_encode($data);
  }


}

 ?>
