<?php
require_once(__DIR__.'/../class/manage_deadline.php');

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
  global $semester;
	global $FILE_PATH;
	$path = $FILE_PATH."/grade";
	$filename = $file['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$uploadfile = $path."/".$course_id."_grade_".$semester['semester']."_".$semester['year'].".".$ext;
	if (!move_uploaded_file($file['tmp_name'], $uploadfile))
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
