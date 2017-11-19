<?php
session_start();
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/manage_deadline.php');
$approval = new approval($_SESSION['level']);
$deadline = new Deadline();
if(isset($_POST['course_id']) && isset($_POST['semester']) && isset($_POST['year']))
{
  $semester = $_POST['semester'];
  $year = $_POST['year'];
  $course_id = $_POST['course_id'];
  $semester_id = $deadline->Search_Semester_id($semester,$year);
  if($semester_id)
  {
    $result = $approval->Reset_Data($course_id,$semester_id);
    echo json_encode($result);
  }
  else
  {
    $data['status'] = 'error';
    $data['msg'] = "ไม่พบภาคการศึกษา";
  }

}

 ?>
