<?php
require_once(__DIR__.'/../class/course.php');
if(isset($_POST['type']))
{
  $course = new Course();
  $type = $_POST['type'];
  if($type == 'add_teacher')
  {
    if(isset($_POST['course']) && isset($_POST['semester_id']) && isset($_POST['teacher']))
    {
      $course_id = $_POST['course'];
      $teacher_name = $_POST['teacher'];
      $semester_id = $_POST['semester_id'];
      $result = $course->Add_Responsible_Staff($course_id,$teacher_name,$semester_id);
    }
    else
    {
      $result['status'] = "error";
      $result['msg'] = "ข้อมูลผิดพลาด";
    }
    echo json_encode($result);
  }
  else if($type == 'remove_teacher')
  {
    if(isset($_POST['course']) && isset($_POST['semester_id']) && isset($_POST['teacher']))
    {
      $course_id = $_POST['course'];
      $teacher_name = $_POST['teacher'];
      $semester_id = $_POST['semester_id'];
      $result = $course->Remove_Responsible_Staff($teacher_name,$course_id,$semester_id);
    }
    else
    {
      $result['status'] = "error";
      $result['msg'] = "ข้อมูลผิดพลาด";
    }
    echo json_encode($result);

  }
  else if ($type == 'add_assessor')
  {
    if(isset($_POST['course']) && isset($_POST['semester_id']) && isset($_POST['group']) && isset($_POST['dep_id']))
    {
      $group_num = $_POST['group']
      $course_id = $_POST['course'];
      $department_id = $_POST['dep_id'];
      $semester_id = $_POST['semester_id'];
      $result = $course->Add_Responsible_Assessor($course_id,$group_num,$semester_id,$department_id)
    }
    else
    {
      $result['status'] = "error";
      $result['msg'] = "ข้อมูลผิดพลาด";
    }
    echo json_encode($return);
  }
  else if($type == 'remove_assessor')
  {
    if(isset($_POST['course']) && isset($_POST['semester_id']) && isset($_POST['dep_id']))
    {
      $course_id = $_POST['course'];
      $department_id = $_POST['dep_id'];
      $semester_id = $_POST['semester_id'];
      $result = $course->Remove_Responsible_Assessor($course_id,$semester_id,$department_id);

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
