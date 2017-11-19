<?php
session_start();
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/manage_deadline.php');
$approval = new approval($_SESSION['level']);
$deadline = new Deadline();
if(isset($_POST['course_id']) && isset($_POST['semester']) && isset($_POST['year']) && isset($_POST['type']))
{
  $semester = $_POST['semester'];
  $year = $_POST['year'];
  $course_id = $_POST['course_id'];
  $type = $_POST['type'];
  $semester_id = $deadline->Search_Semester_id($semester,$year);
  if($type == 'evaluate')
  {
    $result = $approval->Reset_Data_Evaluate($course_id);
    echo json_encode($result);
  }
  else if($type == 'special')
  {
    $instructor_id = $_POST['instructor_id'];
    $result = $approval->Reset_Data_Special($course_id,$instructor_id);
    echo json_encode($result);
  }

  else
  {
    $result['status'] = 'error';
    $result['msg'] = "ไม่พบภาคการศึกษา";
    echo json_encode($result);
  }

}

 ?>
