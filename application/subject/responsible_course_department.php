<?php
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/manage_deadline.php');
$deadline = new Deadline();
$semester = $deadline->Get_Current_Semester();
$course = new Course();
if(isset($_POST['type']))
{
  $type = $_POST['type'];
  if($type == 'add')
  {
    if(isset($_POST['course']) && isset($_POST['dep_id']) && isset($_POST['semester_id']) )
    {
      $course_id = $_POST['course'];
      $department_id = $_POST['dep_id'];
      $semester_id = $_POST['semester_id'];
      $result = $course->Add_Dept_Course($course_id,$department_id,$semester_id);
    }
    else
    {
      $result['status'] = "error";
      $result['msg'] = "ข้อมูลผิดพลาด";
    }
    echo json_encode($result);
  }
  else if ($type == 'remove')
  {
    if(isset($_POST['course']) && isset($_POST['dep_id']) && isset($_POST['semester_id']) )
    {
      $course_id = $_POST['course'];
      $department_id = $_POST['dep_id'];
      $semester_id = $_POST['semester_id'];
      $result = $course->Remove_Dept_Course($course_id,$department_id,$semester_id);
    }
    else
    {
      $result['status'] = "error";
      $result['msg'] = "ข้อมูลผิดพลาด";
    }
    echo json_encode($result);
  }
  else if($type == 'add_oldcourse')
  {
    $data = $_POST['course'];
    $department_id = $_POST['dep'];
    $data = json_decode($data,true);
    for($i=0;$i<count($data);$i++)
    {
      $course_id = $data[$i]['id'];
      $teacher_name = $data[$i]['teacher'];
      $assessor_group = $data[$i]['assessor'];
      $result = $course->Add_Dept_Course($course_id,$department_id,$semester['id']);
      if($result['status'] == 'error')
      {
        break;
      }
      else
      {
        if($teacher_name != '')
        {
          $result = $course->Add_Responsible_Staff($course_id,$teacher_name,$semester['id']);
          if($result['status'] == 'error')
          {
            break;
          }
        }
        if($assessor_group != '')
        {
          $result = $course->Add_Responsible_Assessor($course_id,$assessor_group,$semester['id'],$department_id);
          if($result['status'] == 'error')
          {
            break;
          }
        }

      }
      $result['status'] = 'success';
      $result['msg'] = 'เพิ่มข้อมูลสำเร็จ';
    }
    echo json_encode($result);
  }
}
?>
