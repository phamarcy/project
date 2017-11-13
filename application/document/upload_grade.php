<?php
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/database.php');
$db = new Database();
$deadline = new Deadline();
$semester = $deadline->Get_Current_Semester();
if(isset($_FILES['file']))
{

  $file = $_FILES['file'];
  if(isset($_POST['course_id']))
  {
    $course_id = $_POST['course_id'];
    Upload($file,$course_id);
  }
}

function Upload($file,$course_id)
{
  global $semester,$db,$FILE_PATH;
	$path = $FILE_PATH."/grade";
  if(!file_exists($path))
  {
    mkdir($path);
  }
	$filename = $file['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
  if(file_exists($path."/".$course_id."_grade_".$semester['semester']."_".$semester['year'].".xls"))
  {
    unlink($path."/".$course_id."_grade_".$semester['semester']."_".$semester['year'].".xls");
  }
  else if(file_exists($path."/".$course_id."_grade_".$semester['semester']."_".$semester['year'].".xlsx"))
  {
    unlink($path."/".$course_id."_grade_".$semester['semester']."_".$semester['year'].".xlsx");
  }
  $filename = $course_id."_grade_".$semester['semester']."_".$semester['year'].".".$ext;
	$uploadfile = $path."/".$filename;
  $sql = "INSERT INTO `couse_grade`(`course_id`, `semester_id`, `file_name`) VALUES ('".$course_id."',".$semester['id'].",'".$filename."') ";
  $sql .= "ON DUPLICATE KEY UPDATE `file_name` = '".$filename."'";
  $result = $db->Insert_Update_Delete($sql);
	if (!move_uploaded_file($file['tmp_name'], $uploadfile) || !$result)
	{
		$return['status'] = "error";
		$return['msg'] = 'ไม่สามารถบันทึกไฟล์เกรดได้';
		echo json_encode($return);
    die();
	}
  else
  {
    $return['status'] = "success";
		$return['msg'] = 'อัพโหลดสำเร็จ';
    echo json_encode($return);
  }
}



 ?>
