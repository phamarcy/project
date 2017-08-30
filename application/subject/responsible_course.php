<?php
var_dump($_POST);
die;
require_once(__DIR__.'/../class/course.php');
if(isset($_POST['type']))
{
  $course = new Course();
  $type = $_POST['type'];
  if($type == 'add')
  {
    if(isset($_POST['course']) && isset($_POST['dep_id']) && isset($_POST['semester_id']) )
    {
      $course_id = $_POST['course'];
      $department_id = $_POST['dep_id'];
      $semester_id = $_POST['semester_id'];
      $result = $course->Add_Dept_Course($course_id,$department_id,$semester_id);
    }
    else
    {
      $result['status'] = "error";
      $result['msg'] = "ข้อมูลผิดพลาด";
    }
    echo json_encode($result);
  }
}
?>
