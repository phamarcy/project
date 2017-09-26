<?php
require_once(__DIR__.'/../class/course.php');
$course = new Course();
if(isset($_POST['DATA']) && isset($_POST['TYPE']))
{

  $type = $_POST['TYPE'];
  if($type == 'add' || $type == 'edit')
  {
    $data = $_POST['DATA'];
    $data = json_decode($data,true);
    $result = $course->Add_Course($data);
  }
  else if($type == 'delete')
  {
    $result = $course->Remove_Course($course_id);
  }
  else
  {
    $result['status'] = 'error';
    $result['msg'] = 'ข้อมูลผิดพลาด กรุณาติดต่อผู้ดูแลระบบ';
  }
}
else
{
  $result['status'] = 'error';
  $result['msg'] = 'ข้อมูลผิดพลาด กรุณาติดต่อผู้ดูแลระบบ';
}
echo json_encode($result);
 ?>
