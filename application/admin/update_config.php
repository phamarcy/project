<?php
require_once(__DIR__.'/../class/manage_deadline.php');
$deadline = new Deadline();
function Current_Semester($semester,$year)
{
  global $deadline;
  $result = $deadline->Add_Current_Semester($semester,$year);
  return $result;
}

if(isset($_POST['DATA']))
{
  $data = $_POST['DATA'];
  if($data['config_type'] == 'manage_semester')
  {
    $result = $deadline->Add_Semester($data['semester'],$data['year']);
    if($result)
    {
      $result = Current_Semester($data['semester'],$data['year']);
      if($result)
      {
        $return['success'] = "อัพเดทภาคการศึกษาปัจจุบันเรียบร้อยแล้ว";
      }
      else
      {
          $return['error'] = "ไม่สามารถอัพเดทข้อมูลได้";
      }
    }
    else
    {
        $return['error'] = "ไม่สามารถอัพเดทข้อมูลได้";
    }

    echo json_encode($return);
  }
}
 ?>
