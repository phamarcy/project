<?php
session_start();
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/curl.php');

if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    $return['status'] = 'error';
    $return['msg'] = "กรุณา Login ใหม่";
    echo json_encode($return);
    return ;
}
else
{
  if(isset($_POST['course_id']) && isset($_POST['status']) && isset($_POST['teacher']) && isset($_POST['comment']))
  {
    $approve = new approval($_SESSION['level']);
    $course_id = $_POST['course_id'];
    $status = $_POST['status'];
    if($status == 'edit' || $status == 'edit_sp')
    {
      if($_SESSION['level'] < 6)
        $status = '3';
      else
        $status = '6';
    }
    else if($status == 'approve' || $status == 'approve_sp')
    {
      if($_SESSION['level'] < 6)
        $status = '4';
      else
        $status = '7';
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = "ข้อมูผิดพลาด กรุณาติดต่อผู้ดูแลระบบ";
    }
    $teacher_id = $_POST['teacher'];
    $comment = $_POST['comment'];
    if(isset($_POST['teachersp']))
    {
      $instructor_id = $_POST['teachersp'];
      $result = $approve->Update_Status_Special($instructor_id,$teacher_id,$course_id,$status,$comment);
    }
    else
    {
      $result = $approve->Update_Status_Evaluate($course_id,$status,$teacher_id,$comment);
    }
    if($result)
    {
      $return['status'] = 'success';
      $return['msg'] = "บันทึกสำเร็จ";
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = "ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ";
    }
    echo json_encode($return);
    return ;
  }
}



 ?>
