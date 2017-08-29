<?php
require_once(__DIR__.'/../class/person.php');
$person = new Person();
//var_dump($_POST);exit();


if(isset($_POST['teacher']) && isset($_POST['group']) && isset($_POST['type']))
{
  $group_num = $_POST['group'];
  $teacher_name = $_POST['teacher'];
  $type = $_POST['type'];
  $dept_id = $_POST['department'];
  if($type == 'add')
  {
      $return = $person->Add_Assessor($group_num,$teacher_name,$dept_id);
  }
  else if($type == 'remove')
  {
      $result = $person->Delete_Assessor($group_num,$teacher_name,$dept_id);
      if($result)
      {
        $return['status'] = 'success';
        $return['msg'] = 'ลบข้อมูลสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      }
  }
  else
  {
    $return['status'] = 'error';
    $return['msg'] = 'ข้อมูลผิดพลาด';
  }
  echo json_encode($return);
}
 ?>
