<?php
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/curl.php');
require_once(__DIR__.'/../lib/thai_date.php');
$deadline = new Deadline();
$semester = $deadline->Get_Current_Semester();
$curl = new CURL();
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
      $result = $approve->Update_Status_Evaluate($DATA['COURSE_ID'],'2','all','');
      if($result)
      {
        $return['status'] = "success";
        $return['msg'] = "บันทึกสำเร็จ";
      }
      else
      {
        $return['status'] = "error";
        $return['msg'] = 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      }
    }
    else
    {
      $return['status'] = "error";
      $return['msg'] = 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    echo json_encode($return);
    die;
	}
	else if($DATA['SUBMIT_TYPE'] == '3')
	{
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
      echo Generate($data);
    }
	}
	//var_dump($DATA);
}
else
{
	$return['status'] = "error";
	$return['msg'] = 'ไม่มีข้อมูลนำเข้า';
	echo json_encode($return);
}
function Upload($file,$course_id)
{
	global $FILE_PATH;
	$path = $FILE_PATH."/syllabus";
	$filename = $file['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$uploadfile = $path."/".$course_id.'.'.$ext;
	if (!move_uploaded_file($file['tmp_name'], $uploadfile))
	{
		$return['status'] = "error";
		$return['msg'] = 'ไม่สามารถบันทึกไฟล์ course syllabus ได้';
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
 ?>
