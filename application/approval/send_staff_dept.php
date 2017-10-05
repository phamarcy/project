<?php
session_start();
// var_dump($_POST);exit();
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
  if($_SESSION['level'] != 2)
  {
    $return['status'] = 'error';
    $return['msg'] = "สิทธิ์ไม่ถูกต้อง";
    echo json_encode($return);
    return ;
  }
  else
  {
    if(isset($_POST['course_id']))
    {
      $course_id = $_POST['course_id'];
      $approve = new approval($_SESSION['level']);
      if(isset($_POST['teachersp']))
      {
        $instructor_id = $_POST['teachersp'];
        $result = $approve->Update_Status_Special($instructor_id,'all',$course_id,'4',null);
      }
      else
      {
        $result = $approve->Update_Status_Evaluate($course_id,'4','all',null);
      }
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
      echo json_encode($return);
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = "ข้อมูลไม่ถูกต้อง";
      echo json_encode($return);
      return ;
    }

  }

}

 ?>
