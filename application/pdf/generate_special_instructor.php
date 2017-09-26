<?php
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/database.php');
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/curl.php');
require_once(__DIR__.'/../class/log.php');
$log = new Log();
$curl = new CURL();
$db = new Database();
$deadline = new Deadline();
$course = new Course();
$semester = $deadline->Get_Current_Semester();
$instructor_id = '';
if(isset($_POST['DATA']))
{
	$data = $_POST['DATA'];
	$DATA = json_decode($data,true);
	if($DATA['SUBMIT_TYPE'] == '4')
	{
		$instructor_id = $DATA['TEACHERDATA']['ID'];
	}
	else if($DATA['SUBMIT_TYPE'] != '4')
	{
		$fname = $DATA['TEACHERDATA']['FNAME'];
		$lname = $DATA['TEACHERDATA']['LNAME'];
		$course_id  = $DATA['COURSEDATA']['COURSE_ID'];
		$sql = "SELECT `instructor_id` FROM `special_instructor` WHERE `firstname` = '".$fname."' AND `lastname` = '".$lname."'";
		$result = $db->Query($sql);
		if($result == null)
		{
			$sql="INSERT INTO `special_instructor`(`firstname`, `lastname`) VALUES ('".$fname."','".$lname."')";
			$result = $db->Insert_Update_Delete($sql);
			if($result)
			{
				$sql = "SELECT LPAD( LAST_INSERT_ID(),11,'0') as id";
				$temp_id = $db->Query($sql);
				if($temp_id)
				{
					$instructor_id = $temp_id[0]['id'];
				}
				else
				{
					die("error");
				}
			}
			else
			{
				die("error");
			}
		}
		else
		{
			$instructor_id = $result[0]['instructor_id'];
		}
	}
	if(isset($_FILES['file']))
	{
  	$file = $_FILES['file'];
		Upload($file,$course_id,$instructor_id);
	}
	if($DATA['SUBMIT_TYPE'] != '0' && $DATA['SUBMIT_TYPE'] != '3')
	{
		Write_temp_data($data,$instructor_id,$course_id); //create txt file
	}
	if($DATA['SUBMIT_TYPE'] == '2')
	{
		$return['status'] = "success";
		$return['msg'] = "บันทึกสำเร็จ";
		echo json_encode($return);
		Close_connection();
		die;
	}
	else if($DATA['SUBMIT_TYPE'] == '1')
	{
		$file_path = $FILE_PATH."/draft/".$course_id;
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}
		$file_path = $file_path."/special_instructor";
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}
    $data = array();
    $DATA['ID'] = $instructor_id;
    $DATA["FILE_PATH"] = $file_path;
    $DATA['SEMESTER'] = $semester;
    $data['DATA'] = json_encode($DATA);
    $gen_result = Generate($data);
    $gen_result = json_decode($gen_result,true);
    if($gen_result['status'] == 'success')
    {
      $approve = new approval('1');
      $result = $approve->Append_Special_Instructor($DATA['COURSEDATA']['COURSE_ID'],$instructor_id);
      if($result)
      {
        $return['status'] = "success";
        $return['msg'] = "บันทึกสำเร็จ";
      }
      else
      {
        $return['status'] = "error";
        $return['msg'] = 'ไม่สามารถบัทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      }
    }
    else
    {
      $return['status'] = "error";
      $return['msg'] = 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    echo json_encode($return);
		Close_connection();
    die;
	}
	else if($DATA['SUBMIT_TYPE'] == '4')
	{
		$course_id = $DATA['COURSEDATA']['COURSE_ID'];
		$instructor_id = $DATA['TEACHERDATA']['ID'];
		$temp_data = $course->Get_Document('special',$course_id,$instructor_id,null,$semester['semester'],$semester['year']);
		$DATA = json_decode($temp_data,true);
		switch (json_last_error()) {
		        case JSON_ERROR_DEPTH:
		            $log->Write('Json decode error - Maximum stack depth exceeded');
		        break;
		        case JSON_ERROR_STATE_MISMATCH:
		            $log->Write('Json decode error - Underflow or the modes mismatch');
		        break;
		        case JSON_ERROR_CTRL_CHAR:
		            $log->Write('Json decode error - Unexpected control character found');
		        break;
		        case JSON_ERROR_SYNTAX:
		            $log->Write('Json decode error - Syntax error, malformed JSON');
		        break;
		        case JSON_ERROR_UTF8:
		            $log->Write('Json decode error - Malformed UTF-8 characters, possibly incorrectly encoded');
		        break;
		        default:
		            $log->Write('Json decode error - Unknown error');
		        break;
		    }
		$file_path = $FILE_PATH."/complete/".$course_id;
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}
		$file_path = $file_path."/special_instructor";
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}

		$DATA['ID'] = $instructor_id;
    $DATA['SEMESTER'] = $semester;
    $DATA['FILE_PATH'] = $file_path;
    $DATA['APPROVED'] = array();
		$DATA['APPROVED']['ID'] = $_POST['APPROVER_ID'];
    $data = array();
    $data['DATA'] = json_encode($DATA);
    echo Generate($data);
		Close_connection();
	}
}
else
{
	$return['status'] = "error";
	$return['msg'] = 'ไม่มีข้อมูลนำเข้า';
	echo json_encode($return);
}
function Generate($data)
{
  global $curl;
  $path = "application/pdf/special_instructor.php";
	Close_connection();
  return $curl->Request($data,$path);
}
function Upload($file,$course_id,$instructor_id)
{
	global $FILE_PATH,$semester,$log;
	$path = $FILE_PATH."/cv";
  if(!file_exists($path))
	{
		mkdir($path);
	}
	$filename = $file['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$uploadfile = $path."/".$instructor_id.'.'.$ext;
	if (!move_uploaded_file($file['tmp_name'], $uploadfile))
	{
    $err_status = $file['error'];
    switch ($err_status) {
           case UPLOAD_ERR_INI_SIZE:
               $message = "ไม่สามารถอัพโหลดไฟล์ได้ ไฟล์มีขนาดใหญ่เกินไป";
               $log->Write("The uploaded file exceeds the upload_max_filesize directive in php.ini");
               break;
           case UPLOAD_ERR_FORM_SIZE:
               $message = "ไม่สามารถอัพโหลดไฟล์ได้ ไฟล์มีขนาดใหญ่เกินไป";
               $log->Write("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form");
               break;
           case UPLOAD_ERR_PARTIAL:
               $message = "ไม่สามารถอัพโหลดไฟล์ได้ กรุณาติดต่อผู้ดูแลระบบ";
               $log->Write("The uploaded file was only partially uploaded");
               break;
           case UPLOAD_ERR_NO_FILE:
               $message = "ไม่พบไฟล์";
               $log->Write("No file was uploaded");
               break;
           case UPLOAD_ERR_NO_TMP_DIR:
               $message = "ไม่สามารถอัพโหลดไฟล์ได้ กรุณาติดต่อผู้ดูแลระบบ";
               $log->Write("Missing a temporary folder");
               break;
           case UPLOAD_ERR_CANT_WRITE:
               $message = "ไม่สามารถอัพโหลดไฟล์ได้ กรุณาติดต่อผู้ดูแลระบบ";
               $log->Write("Failed to write file to disk");
               break;
           case UPLOAD_ERR_EXTENSION:
               $message = "ไม่สามารถอัพโหลดไฟล์ได้ กรุณาติดต่อผู้ดูแลระบบ";
               $log->Write("File upload stopped by extension");
               break;

           default:
               $message = "ไม่สามารถอัพโหลดไฟล์ได้ กรุณาติดต่อผู้ดูแลระบบ";
               $log->Write("Unknown upload error");
               break;
       }
		$return['status'] = "error";
		$return['msg'] = $message;
		echo json_encode($return);
		Close_connection();
    die();
	}
}
function Write_temp_data($temp_data,$instructor_id,$course_id)
{
	global $semester;
	$data = json_decode($temp_data,true);
	$path = Create_Folder($data['COURSEDATA']['COURSE_ID'],'special_instructor');
	$temp_file = fopen($path."/".$course_id."_".$instructor_id."_".$semester['semester']."_".$semester['year'].".txt", "w");
	fwrite($temp_file, $temp_data);
	fclose($temp_file);

}
function Create_Folder($course_id,$type)
{
	$temp_path = __DIR__.'/../../files/temp';
	if(!file_exists($temp_path))
	{
		mkdir($temp_path);
	}
	$course_path = $temp_path."/".$course_id;
	if(!file_exists($course_path))
	{
		mkdir($course_path);
	}
	$type_path = $course_path."/".$type;
	if(!file_exists($type_path))
	{
		mkdir($type_path);
	}
	return $type_path;
}
function Close_connection()
{
	global $deadline,$course;
	$deadline->Close_connection();
	$course->Close_connection();
}

 ?>
