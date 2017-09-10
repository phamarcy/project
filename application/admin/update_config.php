<?php
require_once(__DIR__.'/../class/manage_deadline.php');
function Current_Semester($semester,$year)
{
  $system_config_path = "../config/system/";
  if(!is_dir($system_config_path))
  {
    mkdir($system_config_path);
  }
  $myfile = fopen("../config/system/current_semester.txt", "w") or die(json_encode($data['error'] = "Unable to open file!"));
  $txt = $semester."/".$year;
  fwrite($myfile, $txt);
  fclose($myfile);
  return true;
}

if(isset($_POST['DATA']))
{
  $deadline = new Deadline();
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
