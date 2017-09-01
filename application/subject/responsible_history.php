<?php
/*var_dump($_POST);die;*/
require_once(__DIR__.'/../class/course.php');
if(isset($_POST['semester_id']) && isset($_POST['department_id']))
{
  $semester_id = $_POST['semester_id'];
  $department_id = $_POST['department_id'];
  $course = new Course();
  $result = $course->Get_Dept_Course($department_id,$semester_id);
  echo json_encode($result);
}
else
{
  $result['status'] = "error";
  $result['msg'] = "ข้อมูลผิดพลาด";
  echo json_encode($result);
}
 ?>
