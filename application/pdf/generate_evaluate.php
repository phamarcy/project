<?php
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/curl.php');
require_once(__DIR__.'/../lib/thai_date.php');
require_once(__DIR__.'/../class/log.php');
$log = new Log();
$deadline = new Deadline();
$semester = $deadline->Get_Current_Semester();
$curl = new CURL();
$course = new Course();
$file_path = '';
if(isset($_POST['DATA']))
{
	$data = $_POST['DATA'];
	$DATA = json_decode($data,true);
	if(isset($_FILES['file']))
	{
  	$file = $_FILES['file'];
		Upload($file,$DATA['COURSE_ID']);
	}
	if($DATA['SUBMIT_TYPE'] == '0') //upload syllabus only
	{
		$return['status'] = "success";
		$return['msg'] = 'อัพโหลดไฟล์เรียบร้อยแล้ว';
		echo json_encode($return);
		Close_connection();
		die;
	}
	if($DATA['SUBMIT_TYPE'] != '0' && $DATA['SUBMIT_TYPE'] != '3')
	{
		Write_temp_data($data); //create txt file
	}

	if($DATA['SUBMIT_TYPE'] == '2') //create txt file only
	{
		$return['status'] = "success";
		$return['msg'] = "บันทึกสำเร็จ";
		echo json_encode($return);
		 Close_connection();
		die;
			// Write_temp_data($data);
	}
	else if($DATA['SUBMIT_TYPE'] == '1')
	{
		$file_path = $FILE_PATH."/draft/".$DATA['COURSE_ID'];
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}
		$file_path = $file_path."/evaluate";
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}
    $data = array();
    $DATA["SECTION"] = '1';
    $DATA["STUDENT"] = $DATA["STUDENT"][0];
    $DATA["FILE_PATH"] = $file_path;
    $DATA['SEMESTER'] = $semester;
    $data['DATA'] = json_encode($DATA);
    $gen_result =  Generate($data);
    $gen_result = json_decode($gen_result,true);

    if($gen_result['status'] == 'success')
    {
      $approve = new approval('1');
      $result = $approve->Update_Status_Evaluate($DATA['COURSE_ID'],'1','all','');
      if($result)
      {
        $return['status'] = "success";
        $return['msg'] = "บันทึกสำเร็จ";
      }
      else
      {
        $return['status'] = "error";
        $return['msg'] = 'ไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
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
	else if($DATA['SUBMIT_TYPE'] == '3')
	{
		$course_id = $DATA['COURSE_ID'];
		$DATA = $course->Get_Document('evaluate',$course_id,null,$semester['semester'],$semester['year']);
		$DATA = json_decode($DATA,true);
		$file_path = $FILE_PATH."/complete/".$DATA['COURSE_ID'];
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}
		$file_path = $file_path."/evaluate";
		if(!file_exists($file_path))
		{
			mkdir($file_path);
		}
    $num_section = $DATA["SECTION"];
    $num_student = $DATA["STUDENT"];
    $DATA['SEMESTER'] = $semester;
    $DATA['FILE_PATH'] = $file_path;
    $DATA['APPROVED'] = array();
    for($i=0;$i<$num_section;$i++)
    {
      $data = array();
      $DATA["SECTION"] = $i+1;
      $DATA["STUDENT"] = $num_student[$i];
      $data['DATA'] = json_encode($DATA);
			$return_pdf = Generate($data);
			$result_pdf = json_decode($return_pdf,true);
			if($result_pdf == null || $result_pdf['status'] != 'success')
			{
				$return['status'] = "error";
				$return['msg'] = "ไม่สามารถสร้าง pdf ได้";
				$LOG->Write("Generating pdf error : ".$return_pdf);
				echo  json_encode($return);
			}
    }
		$return['status'] = 'success';
		echo json_encode($return);
	}
	 Close_connection();
	return;
	//var_dump($DATA);
}
else
{
	$return['status'] = "error";
	$return['msg'] = 'ไม่มีข้อมูลนำเข้า';
	echo json_encode($return);
	Close_connection();
}
function Upload($file,$course_id)
{
	global $FILE_PATH,$semester,$log;
	$path = $FILE_PATH."/syllabus";
  if(!file_exists($path))
	{
		mkdir($path);
	}
	$filename = $file['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$uploadfile = $path."/".$course_id."_".$semester['semester']."_".$semester['year'].'.'.$ext;
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
              die();
	}
}
function Write_temp_data($temp_data)
{
	global $semester;
	$data = json_decode($temp_data,true);
	$path = Create_Folder($data['COURSE_ID'],'evaluate');
	$temp_file = fopen($path."/".$data['COURSE_ID']."_evaluate_".$semester['semester']."_".$semester['year'].".txt", "w");
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
function Generate($data)
{
  global $curl;
  $path = "application/pdf/course_evaluate.php";
  return $curl->Request($data,$path);
}
function Close_connection()
{
	global $deadline,$course;
	$deadline->Close_connection();
	$course->Close_connection();
}
 ?>
