<?php
session_start();
require_once(__DIR__.'/../class/approval.php');
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    $return['status'] = 'error';
    $return['msg'] = "กรุณา Login ใหม่";
    echo json_encode($return);
    return ;
}
else
{
  if($_SESSION['level'] != 4 && $_SESSION['level'] != 5)
  {
    $return['status'] = 'error';
    $return['msg'] = "สิทธิ์ไม่ถูกต้อง";
    echo json_encode($return);
    return ;
  }
  else
  {
    $course_id = $_POST['course_id'];
    $approve = new approval($_SESSION['level']);
    $result = $approve->Update_Status_Evaluate($course_id,'5','all',null);
    if($result)
    {
      $return['status'] = "success";
      $return['msg'] = "บันทึกสำเร็จ";
    }
    else
    {
      $return['status'] = "error";
      $return['msg'] = "ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ";
    }
  }

}

 ?>
