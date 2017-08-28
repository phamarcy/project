<?php
require_once(__DIR__.'/../class/person.php');
$person = new Person();
var_dump($_POST);
if(isset($_POST['teacher']) && isset($_POST['group']) && isset($_POST['type']))
{
  $group_num = $_POST['group'];
  $teacher_name = $_POST['teacher'];
  if($type == 'add')
  {
      $result = $person->Add_Assessor($group_num,$teacher_name);
      if($result)
      {
        $return['status'] = 'success';
        $return['msg'] = 'เพิ่มข้อมูลสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      }
  }
  else if($type == 'remove')
  {
      $result = $person->Delete_Assessor($group_num,$teacher_name);
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
<!--["teacher"]=>
  string(40) "อนวัช วรรณภิละ"
  ["group"]=>
  string(1) "1"
  ["type"]=>
  string(3) "add"  -->
