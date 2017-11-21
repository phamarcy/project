<?php
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/database.php');
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/log.php');
require_once(__DIR__.'/../class/person.php');
require_once(__DIR__.'/../lib/fpdf17/fpdf.php');
require_once(__DIR__.'/../lib/thai_date.php');
$log = new Log();
$curl = new CURL();
$db = new Database();
$deadline = new Deadline();
$course = new Course();
$person = new Person();
$approve =
$semester = $deadline->Get_Current_Semester();
$instructor_id = '';
function Upload($file,$course_id,$instructor_id)
{
	global $FILE_PATH,$semester,$log,$db;
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
	else
	{
		$sql = "UPDATE `special_instructor` SET `cv` =  '".$instructor_id.'.'.$ext."' WHERE `instructor_id` = '".$instructor_id."'";
		$result = $db->Insert_Update_Delete($sql);
		if(!$result)
		{
			$return['status'] = "error";
			$return['msg'] = "ไม่สามารถบันทึกไฟล์ได้";
			echo json_encode($return);
			Close_connection();
	    die();
		}
	}
}

function Close_connection()
{
	global $deadline,$course;
	$deadline->Close_connection();
	$course->Close_connection();
}



//submit type 1 = draft, 2 = temporary save,3 = assessor agree,4 = approve
if(isset($_POST['DATA']))
{
	$data = $_POST['DATA'];
	$DATA = json_decode($data,true);
	$course_id = $DATA["COURSEDATA_COURSE_ID"];

	if($DATA['SUBMIT_TYPE'] != 3 && $DATA['SUBMIT_TYPE'] != 4)
	{
		$year = (int)$DATA["YEAR"]-543;
		$submit_date = strtotime((int)$DATA["DATE"]."-".(int)$DATA["MONTH"]."-".$year);
		$mysqldate = date( 'Y-m-d ', $submit_date );
			//insert data into database

			$sql = "INSERT INTO `expense_special_instructor`(`level_teacher`,`payment_method`,`level_descript`,`expense_lec_checked`, `expense_lec_number`, `expense_lec_hour`, `expense_lec_cost`,`expense_lab_checked`,`expense_lab_number`,`expense_lab_hour`,`expense_lab_cost`, `expense_plane_check`, `expense_plane_depart`, `expense_plane_arrive`, `expense_plane_cost`, `expense_taxi_check`, `expense_taxi_depart`, `expense_taxi_arrive`, `expense_taxi_cost`, `expense_car_check`, `expense_car_distance`, `expense_car_unit`, `expense_car_cost`, `expense_hotel_choice`, `expense_hotel_per_night`, `expense_hotel_number`, `expense_hotel_cost`, `cost_total`) VALUES ('".$DATA["PAYMENT_LVLTEACHER_CHOICE"]."','".$DATA['PAYMENT_METHOD']."','".$DATA["PAYMENT_LVLTEACHER_DESCRIPT"]."','".$DATA["PAYMENT_COSTSPEC_LEC_CHECKED"]."',".$DATA["PAYMENT_COSTSPEC_LEC_NUMBER"].",".$DATA["PAYMENT_COSTSPEC_LEC_HOUR"].",".$DATA["PAYMENT_COSTSPEC_LEC_COST"].",'".$DATA["PAYMENT_COSTSPEC_LAB_CHECKED"]."',".$DATA["PAYMENT_COSTSPEC_LAB_NUMBER"].",".$DATA["PAYMENT_COSTSPEC_LAB_HOUR"].",".$DATA["PAYMENT_COSTSPEC_LAB_COST"].",'".$DATA["PAYMENT_COSTTRANS_TRANSPLANE_CHECKED"]."','".$DATA["PAYMENT_COSTTRANS_TRANSPLANE_DEPART"]."','".$DATA["PAYMENT_COSTTRANS_TRANSPLANE_ARRIVE"]."',".$DATA["PAYMENT_COSTTRANS_TRANSPLANE_COST"].",'".$DATA["PAYMENT_COSTTRANS_TRANSTAXI_CHECKED"]."','".$DATA["PAYMENT_COSTTRANS_TRANSTAXI_DEPART"]."','".$DATA["PAYMENT_COSTTRANS_TRANSTAXI_ARRIVE"]."',".$DATA["PAYMENT_COSTTRANS_TRANSTAXI_COST"].",'".$DATA["PAYMENT_COSTTRANS_TRANSSELFCAR_CHECKED"]."','".$DATA["PAYMENT_COSTTRANS_TRANSSELFCAR_DISTANCE"]."',".$DATA["PAYMENT_COSTTRANS_TRANSSELFCAR_UNIT"].",".$DATA["PAYMENT_COSTTRANS_TRANSSELFCAR_COST"].",'".$DATA["PAYMENT_COSTHOTEL_CHOICE"]."',".$DATA["PAYMENT_COSTHOTEL_NUMBER"].",".$DATA["PAYMENT_COSTHOTEL_PERNIGHT"].",".$DATA["PAYMENT_COSTHOTEL_COST"].",".$DATA["PAYMENT_TOTALCOST"].")";

			$result = $db->Insert_Update_Delete($sql);

			if($result)
			{
				$sql = "SELECT max(`expense_id`) as `expense_id` FROM `expense_special_instructor`";
				$result = $db->Query($sql);
				if($result)
				{
					$expense_id = $result[0]['expense_id'];
					$sql = "INSERT INTO `special_instructor`(`prefix`, `firstname`, `lastname`, `position`, `qualification`, `work_place`, `phone`, `phone_sub`, `phone_mobile`, `email`)VALUES ('".$DATA["TEACHERDATA_PREFIX"]."','".$DATA["TEACHERDATA_FNAME"]."','".$DATA["TEACHERDATA_LNAME"]."','".$DATA["TEACHERDATA_POSITION"]."','".$DATA["TEACHERDATA_QUALIFICATION"]."','".$DATA["TEACHERDATA_WORKPLACE"]."','".$DATA["TEACHERDATA_TELEPHONE_NUMBER"]."','".$DATA['TEACHERDATA_TELEPHONE_SUB']."','".$DATA["TEACHERDATA_MOBILE"]."','".$DATA["TEACHERDATA_EMAIL"]."')";

					$sql .= " ON DUPLICATE KEY UPDATE `prefix` = '".$DATA["TEACHERDATA_PREFIX"]."', `firstname` = '".$DATA["TEACHERDATA_FNAME"]."', `lastname` = '".$DATA["TEACHERDATA_LNAME"]."', `position` = '".$DATA["TEACHERDATA_POSITION"]."', `qualification` = '".$DATA["TEACHERDATA_QUALIFICATION"]."', `work_place` = '".$DATA["TEACHERDATA_WORKPLACE"]."' , `phone` = '".$DATA["TEACHERDATA_TELEPHONE_NUMBER"]."', `phone_sub` = '".$DATA['TEACHERDATA_TELEPHONE_SUB']."', `phone_mobile` = '".$DATA["TEACHERDATA_MOBILE"]."', `email` = '".$DATA["TEACHERDATA_EMAIL"]."'";

					$result = $db->Insert_Update_Delete($sql);
					if($result)
					{
						$sql = "SELECT `instructor_id` FROM  `special_instructor` WHERE `firstname` = '".$DATA["TEACHERDATA_FNAME"]."' AND `lastname` = '".$DATA["TEACHERDATA_LNAME"]."'";
						$temp_id = $db->Query($sql);
						if($temp_id)
						{
							$instructor_id = $temp_id[0]['instructor_id'];
							$sql = "INSERT INTO `course_hire_special_instructor`(`course_id`, `instructor_id`,`expense_id`,`department`, `num_student`, `type_course`, `semester_id`, `status`,`reason`,`percent_hour`,`submit_user_id`,`submit_date`) VALUES ('".$DATA["COURSEDATA_COURSE_ID"]."',".$instructor_id.",".$expense_id.",'".$DATA['TEACHERDATA_DEPARTMENT']."',".$DATA["COURSEDATA_NOSTUDENT"].",'".$DATA["COURSEDATA_TYPE_COURSE"]."',".$semester['id'].",'0','".$DATA["COURSEDATA_REASON"]."',".$DATA["COURSEDATA_PERCENT_HOUR"].",'".$DATA["USERID"]."','".$mysqldate."')";
							$sql .= " ON DUPLICATE KEY UPDATE `course_id` = '".$DATA["COURSEDATA_COURSE_ID"]."', `instructor_id` = ".$instructor_id." ,`expense_id` = ".$expense_id.",`department` = '".$DATA['TEACHERDATA_DEPARTMENT']."' ,`num_student` = ".$DATA["COURSEDATA_NOSTUDENT"].", `type_course` = '".$DATA["COURSEDATA_TYPE_COURSE"]."', `semester_id` = ".$semester['id'].", `status` = '0',`reason` = '".$DATA["COURSEDATA_REASON"]."' , `percent_hour` = ".$DATA["COURSEDATA_PERCENT_HOUR"].",`submit_user_id` = '".$DATA["USERID"]."' ,`submit_date` = '".$mysqldate."'";
							$result = $db->Insert_Update_Delete($sql);

							$sql = "SELECT `hire_id` FROM `course_hire_special_instructor` WHERE `course_id` = '".$DATA["COURSEDATA_COURSE_ID"]."' AND  `instructor_id` = ".$instructor_id." AND `semester_id` = ".$semester['id'];
							$hire_id = $db->Query($sql);
							if($hire_id)
							{
								$hire_id = $hire_id[0]['hire_id'];
								for ($i=0; $i <$DATA["NUMTABLE"] ; $i++)
								{
									$sql = "DELETE FROM `special_lecture_teach` WHERE `topic_name` = '".$DATA["COURSEDATA_DETAIL"]["TOPICLEC"][$i]."' AND `hire_id` = ".$hire_id;
									$result = $db->Insert_Update_Delete($sql);
									$sql = "INSERT INTO `special_lecture_teach`(`topic_name`,`teaching_date`,`teaching_time_start`, `teaching_time_end`, `teaching_room`, `hire_id`) VALUES ('".$DATA["COURSEDATA_DETAIL"]["TOPICLEC"][$i]."','".$DATA["COURSEDATA_DETAIL"]["DATE"][$i]."','".$DATA["COURSEDATA_DETAIL"]["TIME_BEGIN"][$i]."','".$DATA["COURSEDATA_DETAIL"]["TIME_END"][$i]."','".$DATA["COURSEDATA_DETAIL"]["ROOM"][$i]."',".$hire_id.")";
									$sql .= " ON DUPLICATE KEY UPDATE `topic_name` = '".$DATA["COURSEDATA_DETAIL"]["TOPICLEC"][$i]."', `teaching_date` = '".$DATA["COURSEDATA_DETAIL"]["DATE"][$i]."',`teaching_time_start` = '".$DATA["COURSEDATA_DETAIL"]["TIME_BEGIN"][$i]."', `teaching_time_end` = '".$DATA["COURSEDATA_DETAIL"]["TIME_END"][$i]."', `teaching_room` = '".$DATA["COURSEDATA_DETAIL"]["ROOM"][$i]."', `hire_id` = ".$hire_id;
									$result = $db->Insert_Update_Delete($sql);
								}
							}
							else
							{
								$return['status'] = "error";
								$return['msg'] = "ไม่สามารถบันทึกข้อมูลได้" ;
								echo json_encode($return);
								die;
							}
						}
						else
						{
							$return['status'] = "error";
							$return['msg'] = "ไม่สามารถบันทึกข้อมูลได้" ;
							echo json_encode($return);
							die;
						}
					}
					else
					{
						$return['status'] = "error";
						$return['msg'] = "ไม่สามารถบันทึกข้อมูลได้" ;
						echo json_encode($return);
						die;
					}
				}
				else
				{
					$return['status'] = "error";
					$return['msg'] = "ไม่สามารถบันทึกข้อมูลได้" ;
					echo json_encode($return);
					die;
				}
			}
	}
	else
	{
		$instructor_id = $DATA["TEACHERDATA_ID"];
	}
	if(isset($_FILES['file']))
	{
  	$file = $_FILES['file'];
		Upload($file,$course_id,$instructor_id);
	}
}
else
{
	$return['status'] = "error";
	$return['msg'] = 'ไม่มีข้อมูลนำเข้า';
	echo json_encode($return);
}
if($DATA['SUBMIT_TYPE'] == '2')
{
	Close_connection();
	$return['status'] = "success";
	$return['msg'] = "บันทึกสำเร็จ";
	echo json_encode($return);
	die;
}
//get data to generate pdf
$data_pdf = $course->Get_Document('special',$course_id,$instructor_id,null,$semester['semester'],$semester['year']);
if($data_pdf == false)
{
	$return['status'] = "error";
	$return['msg'] = "ไม่สามารถดึงข้อมูลได้" ;
	echo json_encode($return);
	die;
}
$data_pdf = array_map(function($data_pdf) {
 return $data_pdf === null ? '' : $data_pdf;
}, $data_pdf);
//start generate pdf
define('FPDF_FONTPATH','font/');
$pdf=new FPDF();

$pdf->AddPage();
$pdf->SetMargins(20,10,20,0);
$pdf->AddFont('angsa','','angsa.php');
$pdf->AddFont('angsab','','angsab.php');
$pdf->AddFont('THSarabun','','THSarabun.php');
$pdf->AddFont('THSarabun_B','','THSarabun_B.php');
$pdf->AddFont('cordiab','','cordiab.php');
$pdf->AddFont('cordia','','cordia.php');
$pdf->AddFont('tahoma','','tahoma.php');
$pdf->AddFont('ZapfDingbats','','zapfdingbats.php');

$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','แบบขออนุมัติเชิญอาจารย์พิเศษ'),0,1,"C");

$department_name = '-';
$dept_all = $course->Get_Dept_All();
for ($i=0; $i <count($dept_all) ; $i++)
{
	if($dept_all[$i]['code'] == $data_pdf['department'])
	{
		$department_name = $dept_all[$i]['name'];
		break;
	}
}

$pdf->SetX(75);
$pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','ภาควิชา'),0,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','    '.$department_name.'     '),0,"C");
$pdf->Ln();

$pdf->SetX(60);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','ภาคการศึกษาที่'),0,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','        '.$semester['semester'].'         '),0,"C");
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','ปีการศึกษา'),0,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','        '.$semester['year'].'         '),0,"C");
$pdf->Ln();
#1
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','1. รายละเอียดของอาจารย์พิเศษ'),0,1);

$pdf->SetX(25);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.1 ชื่อ ')),7,iconv( 'UTF-8','TIS-620','1.1 ชื่อ '),0,"C");

$RANK = $data_pdf['prefix'];
$FIRSTNAME = $data_pdf['firstname'];
$LASTNAME = $data_pdf['lastname'];
$space_firstname = '';
$space_lastname = '';
$count = 80 - strlen($RANK) - strlen($FIRSTNAME);
for($i=0;$i<$count;$i++)
{
	$space_firstname .= ' ';
}
$count = 80 - strlen($LASTNAME);
for($i=0;$i<$count;$i++)
{
	$space_lastname .= ' ';
}
$pdf->Cell(60,7,iconv( 'UTF-8','TIS-620','    '.$RANK.' '.$FIRSTNAME.'  '.$space_firstname),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','นามสกุล ')),7,iconv( 'UTF-8','TIS-620','นามสกุล '),0,"C");
$pdf->Cell(60,7,iconv( 'UTF-8','TIS-620','    '.$LASTNAME.'  '.$space_lastname),0,"C");

$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.2 ตำแหน่ง ')),7,iconv( 'UTF-8','TIS-620','1.2 ตำแหน่ง '),0,"C");
$POSITION = $data_pdf['position'];
$pdf->MultiCell( 100, 7, iconv( 'UTF-8','TIS-620',$POSITION), 0,1);

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.3 คุณวุฒิ/สาขาที่เชี่ยวชาญ ')),7,iconv( 'UTF-8','TIS-620','1.3 คุณวุฒิ/สาขาที่เชี่ยวชาญ '),0,"C");
$QUALIFICATION = $data_pdf['qualification'];
$pdf->MultiCell( 100, 7, iconv( 'UTF-8','TIS-620',$QUALIFICATION), 0,1);

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.4 สถานที่ทำงาน/สถานที่ติดต่อ    ')),7,iconv( 'UTF-8','TIS-620','1.4 สถานที่ทำงาน/สถานที่ติดต่อ    '),0,"C");
$pdf->Ln();
$pdf->SetX(35);
$pdf->MultiCell( 140, 7, iconv( 'UTF-8','TIS-620',$data_pdf['work_place']), 0,1);
// $pdf->Ln();

$pdf->SetX(30);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรศัพท์ '.$data_pdf['phone'].' ต่อ '.$data_pdf['phone_sub'])) + 5,7,iconv( 'UTF-8','TIS-620','โทรศัพท์ '.$data_pdf['phone'].' ต่อ '.$data_pdf['phone_sub']),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรศัพท์มือถือ '.$data_pdf['phone_mobile']))+3,7,iconv( 'UTF-8','TIS-620','โทรศัพท์มือถือ '.$data_pdf['phone_mobile']),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อีเมลล์ '.$data_pdf['email'])),7,iconv( 'UTF-8','TIS-620','อีเมลล์ '.$data_pdf['email']),0,1,"C");
$pdf->SetX(32);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','กระบวนวิชานี้เป็นวิชา'))+5,7,iconv( 'UTF-8','TIS-620','หัวข้อที่เชิญมาสอน      '),0,"C");
$pdf->SetFont('ZapfDingbats','',14);
if((int)$data_pdf['invited'] == 0)
{
	$HISTORY['yet'] = 3;
	$HISTORY['already'] = '';
}
else
{
	$HISTORY['yet'] = '';
	$HISTORY['already'] = 3;
}
$pdf->Cell(4,4, $HISTORY['already'], 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เคยเชิญมาสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เคยเชิญมาสอน'),0);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $HISTORY['yet'], 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ไม่เคยเชิญมาสอน'))+5,7,iconv( 'UTF-8','TIS-620',' ไม่เคยเชิญมาสอน'),0);
$pdf->Ln();
#2
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','2 รายละเอียดกระบวนวิชา'),0,1);

$pdf->SetX(25);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.1 กระบวนวิชาที่สอน    ')),9,iconv( 'UTF-8','TIS-620','2.1 กระบวนวิชาที่สอน    '),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',$data_pdf['course_id'])),9,iconv( 'UTF-8','TIS-620',$data_pdf['course_id']),0,'C');
$pdf->SetX(100);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวนนักศึกษาทั้งหมด    ')),9,iconv( 'UTF-8','TIS-620','จำนวนนักศึกษาทั้งหมด   '),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',$data_pdf['num_student'].' คน')),9,iconv( 'UTF-8','TIS-620',$data_pdf['num_student'].' คน'),0,1,'C');

if($data_pdf['type_course'] == "require")
{
	$type['require'] = 3;
	$type['choose'] = '';
}
else if($data_pdf['type_course'] == "choose")
{
	$type['choose'] = 3;
	$type['require'] = '';
}
else
{
	$type['choose'] = '';
	$type['require'] = '';
}



$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.2 กระบวนวิชานี้เป็นวิชา'))+5,7,iconv( 'UTF-8','TIS-620','2.2 กระบวนวิชานี้เป็นวิชา'),0);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $type['require'], 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' บังคับ'),0,"C");
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $type['choose'], 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เลือก'),0,"C");
$pdf->Ln();
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.2 กระบวนวิชานี้เป็นวิชา'))+30);


$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.3 เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ   ')),7,iconv( 'UTF-8','TIS-620','2.3 เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ'),0,1,"C");
$pdf->SetX(35);
$pdf->MultiCell( 140, 7, iconv( 'UTF-8','TIS-620',$data_pdf['reason']), 0,1);
// $pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','2.4 รายละเอียดในการสอน'),0,1);
$pdf->SetX(35);
$pdf->Cell(70,7,iconv( 'UTF-8','TIS-620','หัวข้อบรรยาย/ปฏิบัติการ '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ว/ด/ป ที่สอน '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','เวลา '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ห้องเรียน'));
$pdf->Ln();
for($i=0;$i<count($data_pdf["lecture_detail"]);$i++)
{
	$num = $i+1;
	$pdf->SetX(30);
	$pdf->Cell(5,7,iconv('UTF-8','TIS-620',$num.'.'));
	$pdf->SetX(35);
	$before_y = $pdf->GetY();
	$before_x = $pdf->GetX();
	$pdf->MultiCell( 70, 7, iconv( 'UTF-8','TIS-620',$data_pdf["lecture_detail"][$i]["topic_name"]), 0,1);
	//$pdf->Ln();
	$current_y = $pdf->GetY();
	$current_x = $pdf->GetX();

	$data_date = strtotime($data_pdf["lecture_detail"][$i]["teaching_date"][$i]);
 	$date = date('d-m-Y',$data_date);

	$pdf->SetXY($before_x + 70, $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$date));

	$current_x += 30;
	$pdf->SetXY($before_x + 100, $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$data_pdf["lecture_detail"][$i]["teaching_time_start"].' - '.$data_pdf["lecture_detail"][$i]["teaching_time_end"]));

	$current_x += 30;
	$pdf->SetXY($before_x + 130 , $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$data_pdf["lecture_detail"][$i]["teaching_room"]),0,1);

	$pdf->SetXY($current_x, $current_y);

}

$pdf->SetX(32);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'))+5,7,iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'),0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620'," ".$data_pdf['percent_hour']." "),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'))+5,7,iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'),0,"C");
$pdf->Ln();


#3
$pdf->SetX(20);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','3 ค่าใช้จ่าย'),0,1);

$pdf->SetX(30);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อาจารย์พิเศษเป็น '))+3,7,iconv('UTF-8','TIS-620','อาจารย์พิเศษเป็น'),0);

if($data_pdf["level_teacher"] == "official")
{
	$pro = 3;
	$level_pro = $data_pdf["level_descript"];
	$norm = '';
	$level_norm = '';
}
else if($data_pdf["level_teacher"] == "equivalent")
{
	$pro = '';
	$level_pro = '';
	$norm = 3;
	$level_norm = $data_pdf["level_descript"];
}
if($data_pdf['payment_method'] == '0')
{
	$norm = '';
	$pro = '';
	$level_norm = '';
	$level_pro = '';
}
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $pro, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ข้าราชการระดับ'))+1,7,iconv( 'UTF-8','TIS-620',' ข้าราชการระดับ'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' '.$level_pro))+5,7,iconv( 'UTF-8','TIS-620',' '.$level_pro),0,"C");

$pdf->Ln();
$pdf->SetX(56);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $norm, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บุคคลเอกชนเทียบตำแหน่ง'))+1,7,iconv( 'UTF-8','TIS-620',' บุคคลเอกชนเทียบตำแหน่ง'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ชำนาญการ '))+2,7,iconv( 'UTF-8','TIS-620',' '.$level_norm),0,"C");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.1 ค่าสอนพิเศษ '))+3,10,iconv('UTF-8','TIS-620','3.1 ค่าสอนพิเศษ'),0,1);

$cost1 = $data_pdf["expense_lec_cost"];
$hour1 = $data_pdf["expense_lec_hour"];
$num1 = $data_pdf["expense_lec_number"];
$cost2 = $data_pdf["expense_lab_cost"];
$hour2 = $data_pdf["expense_lab_hour"];
$num2 = $data_pdf["expense_lab_number"];
if($data_pdf["expense_lec_checked"] == "1")
{
	$choice1 = 3;
}
if($data_pdf["expense_lab_checked"] == "1")
{
	$choice2 = 3;
}
if($data_pdf['payment_method'] == '0')
{
	$choice1 = '';
	$choice2 = '';
	$cost2 = '';
	$cost1 = '';
	$hour2 = '';
	$hour1 = '';
	$num1 = ' ';
	$num2 = ' ';
}


$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice1, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ '.$num1.'/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีบรรยาย '.$num1.'/ชม.'),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
$pdf->Cell(13,7,iconv( 'UTF-8','TIS-620',$hour1),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง 60 กม.ๆ ละ 4 บาท'))+50);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$cost1),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice2, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ '.$num2.'/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีปฏิบัติการ '.$num2.'/ชม.'),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
$pdf->Cell(13,7,iconv( 'UTF-8','TIS-620',$hour2),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง 60 กม.ๆ ละ 4 บาท'))+50);
$money_position = $pdf->GetX();
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$cost2),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.2 ค่าพาหนะเดินทาง '))+3,10,iconv('UTF-8','TIS-620','3.2 ค่าพาหนะเดินทาง'),0,1);
$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
if((int)$data_pdf["expense_plane_check"] == 1)
{
	$pdf->Cell(4,4, 3, 1,"C");
}
else
{
	$pdf->Cell(4,4, '', 1,"C");
}

$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เครื่องบิน  ระหว่าง'))+1,7,iconv( 'UTF-8','TIS-620','เครื่องบิน ระหว่าง'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$data_pdf["expense_plane_depart"].' - '.$data_pdf["expense_plane_arrive"]),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["expense_plane_cost"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();


$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
if((int)$data_pdf["expense_taxi_check"] == 1)
{
	$pdf->Cell(4,4, 3, 1,"C");
}
else
{
	$pdf->Cell(4,4, '', 1,"C");
}
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ค่า taxi'))+1,7,iconv( 'UTF-8','TIS-620','ค่า taxi'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$data_pdf["expense_taxi_depart"].' - '.$data_pdf["expense_taxi_arrive"]),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["expense_taxi_cost"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();


$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
if($data_pdf["expense_car_check"] == "1")
{
	$pdf->Cell(4,4, 3, 1,"C");
}
else
{
	$pdf->Cell(4,4, '', 1,"C");
}
$pdf->SetFont('THSarabun','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง '.$data_pdf["expense_car_distance"].' กม.ๆ ละ '.$data_pdf["expense_car_unit"].' บาท')),7,iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง '.$data_pdf["expense_car_distance"].' กม.ๆ ละ '.$data_pdf["expense_car_unit"].' บาท'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["expense_car_cost"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);



if($data_pdf["expense_hotel_choice"] == "1")
{
	$choice_hotel1 = 3;
	$choice_hotel2 = '';
	$number = $data_pdf["expense_hotel_number"];
	$per_night1 = $data_pdf["expense_hotel_per_night"];
 $per_night2 = '  ';

}
else if($data_pdf["expense_hotel_choice"] == "2")
{
	$choice_hotel1 = '';
	$choice_hotel2 = 3;
	$number = $data_pdf["expense_hotel_number"];
 $per_night1 = '  ';
	$per_night2 = $data_pdf["expense_hotel_per_night"];


}
else if ($data_pdf["expense_hotel_choice"] == "3")
{
	$choice_hotel1 = '  ';
	$choice_hotel2 = '  ';
	$per_night1 = '  ';
 	$per_night2 = '  ';
 	$number = '  ';
}

if($data_pdf['payment_method'] == '0')
{
	$choice_hotel1 = '  ';
	$choice_hotel2 = '  ';
	$per_night1 = '  ';
	$per_night2 = '  ';
	$number = '  ';
}

$pdf->AddPage();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.3 ค่าที่พัก '))+3,7,iconv('UTF-8','TIS-620','3.3 ค่าที่พัก'),0);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice_hotel1, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน '.$per_night1.' บาท/คน/คืน'))+10,7,iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน '.$per_night1.' บาท/คน/คืน'),0);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice_hotel2, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน '.$per_night2.' บาท/คน/คืน'))+1,7,iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน '.$per_night2.' บาท/คน/คืน'),0);
$pdf->Ln();
$pdf->SetX(50);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวน ')),7,iconv('UTF-8','TIS-620','จำนวน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','  '.$number),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','คืน ')),7,iconv('UTF-8','TIS-620','คืน'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["expense_hotel_cost"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);
$pdf->SetX($money_position-17);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','สรุปค่าใช้จ่ายทั้งหมด'))+5,7,iconv( 'UTF-8','TIS-620',' สรุปค่าใช้จ่ายทั้งหมด'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["cost_total"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);

//get teacher name and signature
$person = new Person();
$respond_teacher = $course->Get_Responsible_Teacher($data_pdf['course_id'],$semester['id']);
$signature_file = $person->Get_Teacher_Signature($respond_teacher['id']);
$teacher_name = $person->Get_Teacher_Name($respond_teacher['id'],'TH');
//end get

$pdf->SetX(35);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
if($signature_file != null)
{
	$pdf->Cell( 40, 7, $pdf->Image($signature_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
}
$pdf->SetX($money_position-10);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
if($signature_file != null)
{
	$pdf->Cell( 40, 7, $pdf->Image($signature_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
}
$pdf->Ln();

$pdf->SetXY(40,$pdf->GetY()+3);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','('.$teacher_name.')'),0);
$pdf->SetX($money_position-5);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','('.$teacher_name.')'),0,1);
$pdf->SetX(45);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้เชิญอาจารย์พิเศษ'),0);
$pdf->SetX($money_position-5);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้รับผิดชอบกระบวนวิชา'),0,1);

$day = date('d', strtotime($data_pdf['submit_date']));
$month = date('m', strtotime($data_pdf['submit_date']));
$year = date('Y', strtotime($data_pdf['submit_date'])) + 543;
$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.$day.'   เดือน   '.$THAI_MONTH[(int)$month-1].'   พ.ศ.   '.$year),0);
$pdf->SetX($money_position-17);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.$day.'   เดือน   '.$THAI_MONTH[(int)$month-1].'   พ.ศ.   '.$year),0);

//update approval special instructor


//end update

//check if document is approve
if($DATA['SUBMIT_TYPE'] == '3' || $DATA['SUBMIT_TYPE'] == '4')
{
 $course_dep = $person->Get_Staff_Dep($respond_teacher['id']);
 $head_department_id = $person->Get_Head_Department($course_dep['code'],$data_pdf['course_id']);
	$approver_name = $person->Get_Teacher_Name($head_department_id,'TH');
	$signature_approver_file = $person->Get_Teacher_Signature($head_department_id);

$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(0+5,7,iconv( 'UTF-8','TIS-620',' การขอเชิญอาจารย์พิเศษนี้ได้ผ่านความเห็นชอบของกรรมการวิชาการภาควิชาแล้ว เมื่อวันที่ '.date(" j ").'   เดือน   '.$THAI_MONTH[(int)date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0,1);

$pdf->SetX($money_position-25);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);

if($signature_approver_file != null)
{
	$pdf->Cell( 40, 7, $pdf->Image($signature_approver_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
}
$pdf->Ln();

$pdf->SetXY($money_position-15,$pdf->GetY()+3);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620',$approver_name),0,1);
$pdf->SetXY($money_position-15,$pdf->GetY()+3);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','หัวหน้า/ผู้แทนหัวหน้าภาควิชา'),0,1);

// $pdf->SetX($money_position-20);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" d ").'   เดือน   '.$THAI_MONTH[(int)date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
}
$person->Close_connection();
if($DATA['SUBMIT_TYPE'] == '1' || $DATA['SUBMIT_TYPE'] == '3')
{
	if(!file_exists($FILE_PATH."/draft"))
	{
		mkdir($FILE_PATH."/draft");
	}
	$file_path = $FILE_PATH."/draft/".$data_pdf['course_id'];
	$file_path_sql = "/draft/".$data_pdf['course_id'];
	if(!file_exists($file_path))
	{
		mkdir($file_path);
	}
}
else if ($DATA['SUBMIT_TYPE'] == '4')
{
	if(!file_exists($FILE_PATH."/complete"))
	{
		mkdir($FILE_PATH."/complete");
	}
	$file_path = $FILE_PATH."/complete/".$data_pdf['course_id'];
	$file_path_sql = "/complete/".$data_pdf['course_id'];
	if(!file_exists($file_path))
	{
		mkdir($file_path);
	}
}
else
{
	$file_path = $FILE_PATH;

}
$file_path = $file_path."/special_instructor";
$file_path_sql = $file_path_sql."/special_instructor/instructor_".$data_pdf['course_id']."_".$instructor_id."_".$semester['semester']."_".$semester['year'].".pdf";
if(!file_exists($file_path))
{
	mkdir($file_path);
}
$pdf->Output($file_path."/instructor_".$data_pdf['course_id']."_".$instructor_id."_".$semester['semester']."_".$semester['year'].".pdf","F");

$sql = "UPDATE `course_hire_special_instructor` SET `pdf_file` = '".$file_path_sql."' WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."' AND `semester_id` = ".$semester['id'];
$result = $db->Insert_Update_Delete($sql);

if($DATA['SUBMIT_TYPE'] == '1')
{
	$approve = new approval('1');
	$result = $approve->Append_Special_Instructor($data_pdf['course_id'],$instructor_id);
	$url = $curl->GET_SERVER_URL();
	$view_url = $url."/application/pdf/view.php";
	$return['status'] = "success";
	$return['msg'] = 	$view_url."?course=".$data_pdf['course_id']."&id=".$instructor_id."&info=special&semester=".$semester['semester']."&year=".$semester['year'];

}
else
{
	$return['status'] = "success";
	$return['msg'] = "บันทึกสำเร็จ";
}
echo json_encode($return);


 ?>
