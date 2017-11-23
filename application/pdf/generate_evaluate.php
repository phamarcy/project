<?php
session_start();
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/person.php');
require_once(__DIR__.'/../class/database.php');
require_once(__DIR__.'/../lib/thai_date.php');
require_once(__DIR__.'/../class/log.php');
require_once(__DIR__.'/../lib/fpdf17/fpdf.php');
$log = new Log();
$deadline = new Deadline();
$semester = $deadline->Get_Current_Semester();
$curl = new CURL();
$course = new Course();
$person = new Person();
$db = new Database();
$file_path = '';
function Upload($file,$course_id)
{
	global $FILE_PATH,$semester,$log,$db;
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
	else
	{
		$sql = "UPDATE `course_evaluate` SET `syllabus` =  '".$course_id."_".$semester['semester']."_".$semester['year'].'.'.$ext."' WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester['id'];
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
	$course_id = $DATA["COURSE_ID"];

	if($DATA['SUBMIT_TYPE'] == '0') //upload syllabus only
	{
		$return['status'] = "success";
		$return['msg'] = 'อัพโหลดไฟล์เรียบร้อยแล้ว';
		echo json_encode($return);
		Close_connection();
		die;
	}
	else if($DATA['SUBMIT_TYPE'] != 3 && $DATA['SUBMIT_TYPE'] != 4)
	{
			//insert data into database
			//criterion_grade
			$sql_criterion_grade = "INSERT INTO `criterion_grade`(`criterion_type`, `explaination`, `A_min`, `A_max`, `B+_min`, `B+_max`, `B_min`, `B_max`, `C+_min`, `C+_max`, `C_min`, `C_max`, `D+_min`, `D+_max`, `D_max`, `D_min`, `F_max`, `S_min`, `U_max`) VALUES ('".$DATA["CALCULATE_TYPE"]."','".$DATA["CALCULATE_EXPLAINATION"]."',".$DATA["CALCULATE_A_MIN"].",100,".$DATA["CALCULATE_B+_MIN"].",".$DATA["CALCULATE_B+_MAX"].",".$DATA["CALCULATE_B_MIN"].",".$DATA["CALCULATE_B_MAX"].",".$DATA["CALCULATE_C+_MIN"].",".$DATA["CALCULATE_C+_MAX"].",".$DATA["CALCULATE_C_MIN"].",".$DATA["CALCULATE_C_MAX"].",".$DATA["CALCULATE_D+_MIN"].",".$DATA["CALCULATE_D+_MAX"].",".$DATA["CALCULATE_D_MIN"].",".$DATA["CALCULATE_D_MAX"].",".$DATA["CALCULATE_F_MAX"].",".$DATA["CALCULATE_S_MIN"].",".$DATA["CALCULATE_U_MAX"].")";
			$lastrow_criterion_grade_id = "SELECT criterion_grade_id FROM criterion_grade ORDER BY criterion_grade_id DESC LIMIT 1;";

			$result_criterion_grade = $db->Insert_Update_Delete($sql_criterion_grade);
			if ($result_criterion_grade) {
			    $result_criterion_grade_id = $db->Query($lastrow_criterion_grade_id);
			}


			//measure_evaluate
			$sql_measure_evaluate = "INSERT INTO `measure_evaluate`( `mid1_lec`, `mid1_lab`, `mid2_lec`, `mid2_lab`, `final_lec`, `final_lab`, `work_lec`, `work_lab`, `other_lec`, `other_lab`, `other_oth`, `total_lec`, `total_lab`, `msg`)VALUES (".$DATA["MEASURE_MID1_LEC"].",".$DATA["MEASURE_MID1_LAB"].",".$DATA["MEASURE_MID2_LEC"].",".$DATA["MEASURE_MID1_LAB"].",".$DATA["MEASURE_FINAL_LEC"].",".$DATA["MEASURE_FINAL_LAB"].",".$DATA["MEASURE_WORK_LEC"].",".$DATA["MEASURE_WORK_LAB"].",".$DATA["MEASURE_OTHER_LEC"].",".$DATA["MEASURE_OTHER_LAB"].",'".$DATA["MEASURE_OTHER_OTH"]."',".$DATA["MEASURE_TOTAL_LEC"].",".$DATA["MEASURE_TOTAL_LAB"].",'".trim($DATA["MEASURE_MSG"])."')";
			$lastrow_measure_evaluate_id = "SELECT measure_evaluate_id FROM measure_evaluate ORDER BY measure_evaluate_id DESC LIMIT 1;";

			$result_measure_evaluate = $db->Insert_Update_Delete($sql_measure_evaluate);
			if ($result_measure_evaluate) {
			    $result_measure_evaluate_id = $db->Query($lastrow_measure_evaluate_id);

			}


			//exam_evaluate
			$sql_exam_evaluate = "INSERT INTO `exam_evaluate`(`mid1_hour_lec`, `mid1_hour_lab`, `mid1_number_lec`, `mid1_number_lab`, `mid2_hour_lec`, `mid2_hour_lab`, `mid2_number_lec`, `mid2_number_lab`, `final_hour_lec`, `final_hour_lab`, `final_number_lec`, `final_number_lab`, `suggestion`)VALUES (".$DATA["EXAM_MID1_HOUR_LEC"].",".$DATA["EXAM_MID1_HOUR_LAB"].",".$DATA["EXAM_MID1_NUMBER_LEC"].",".$DATA["EXAM_MID1_NUMBER_LAB"].",".$DATA["EXAM_MID2_HOUR_LEC"].",".$DATA["EXAM_MID2_HOUR_LAB"].",".$DATA["EXAM_MID2_NUMBER_LEC"].",".$DATA["EXAM_MID2_NUMBER_LAB"].",".$DATA["EXAM_FINAL_HOUR_LEC"].",".$DATA["EXAM_FINAL_HOUR_LAB"].",".$DATA["EXAM_FINAL_NUMBER_LEC"].",".$DATA["EXAM_FINAL_NUMBER_LAB"].",'".trim($DATA["EXAM_SUGGESTION"])."')";
			$lastrow_exam_evaluate_id = "SELECT exam_evaluate_id FROM exam_evaluate ORDER BY exam_evaluate_id DESC LIMIT 1;";

			$result_exam_evaluate = $db->Insert_Update_Delete($sql_exam_evaluate);
			if ($result_exam_evaluate) {
			    $result_exam_evaluate_id = $db->Query($lastrow_exam_evaluate_id);
			}
			//exam_commitee
			//MID1
			for ($i=0; $i < count($DATA["EXAM_MID1_COMMITTEE_LEC"]); $i++) {
				if($DATA["EXAM_MID1_COMMITTEE_LEC"] != "")
				{
					if(strlen($DATA["EXAM_MID1_COMMITTEE_LEC"][$i]) != mb_strlen($DATA["EXAM_MID1_COMMITTEE_LEC"][$i], 'utf-8'))
					{
						$name_type = 'TH';
					}
					else
					{
						$name_type = 'EN';
					}
					$teacher_id =$person->Get_Teacher_Id($DATA["EXAM_MID1_COMMITTEE_LEC"][$i]);
					if (!$teacher_id) {
							$log->Write("find failed : not found EXAM_MID1_COMMITTEE_LEC id".$DATA["EXAM_MID1_COMMITTEE_LEC"][$i] );
					}
					if ($teacher_id) {
							$sql_exam_commitee="INSERT INTO `exam_commitee`( `exam_evaluate_id`, `teacher_id`,`name_type`, `type`, `type_commitee`) VALUES (".$result_exam_evaluate_id[0]["exam_evaluate_id"].",'".$teacher_id."','".$name_type."','MID1','LEC')";
							$result_exam_commitee = $db->Insert_Update_Delete($sql_exam_commitee);
					}
				}

			}

			for ($i=0; $i < count($DATA["EXAM_MID1_COMMITTEE_LAB"]); $i++) {
				if($DATA["EXAM_MID1_COMMITTEE_LAB"][$i] != "")
				{
					if(strlen($DATA["EXAM_MID1_COMMITTEE_LAB"][$i]) != mb_strlen($DATA["EXAM_MID1_COMMITTEE_LAB"][$i], 'utf-8'))
					{
						$name_type = 'TH';
					}
					else
					{
						$name_type = 'EN';
					}
			    $teacher_id =$person->Get_Teacher_Id($DATA["EXAM_MID1_COMMITTEE_LAB"][$i]);
			    if (!$teacher_id) {
			        $log->Write("find failed : not found EXAM_MID1_COMMITTEE_LAB id".$DATA["EXAM_MID1_COMMITTEE_LAB"][$i] );
			    }
			    if ($teacher_id) {
			        $sql_exam_commitee="INSERT INTO `exam_commitee`( `exam_evaluate_id`, `teacher_id`,`name_type`, `type`, `type_commitee`) VALUES (".$result_exam_evaluate_id[0]["exam_evaluate_id"].",'".$teacher_id."','".$name_type."','MID1','LAB')";
			        $result_exam_commitee = $db->Insert_Update_Delete($sql_exam_commitee);
			    }
				}
			}

			//MID2
			for ($i=0; $i < count($DATA["EXAM_MID2_COMMITTEE_LEC"]); $i++) {
				if($DATA["EXAM_MID2_COMMITTEE_LEC"][$i] != "")
				{
					if(strlen($DATA["EXAM_MID2_COMMITTEE_LEC"][$i]) != mb_strlen($DATA["EXAM_MID2_COMMITTEE_LEC"][$i], 'utf-8'))
					{
						$name_type = 'TH';
					}
					else
					{
						$name_type = 'EN';
					}
					$teacher_id =$person->Get_Teacher_Id($DATA["EXAM_MID2_COMMITTEE_LEC"][$i]);
					if (!$teacher_id) {
							$log->Write("find failed : not found EXAM_MID2_COMMITTEE_LEC id".$DATA["EXAM_MID2_COMMITTEE_LEC"][$i] );
					}
					if ($teacher_id) {
							$sql_exam_commitee="INSERT INTO `exam_commitee`( `exam_evaluate_id`, `teacher_id`,`name_type`, `type`, `type_commitee`) VALUES (".$result_exam_evaluate_id[0]["exam_evaluate_id"].",'".$teacher_id."','".$name_type."','MID2','LEC')";
							$result_exam_commitee = $db->Insert_Update_Delete($sql_exam_commitee);

					}
				}
			}

			for ($i=0; $i < count($DATA["EXAM_MID2_COMMITTEE_LAB"]); $i++) {
				if($DATA["EXAM_MID2_COMMITTEE_LAB"] != "")
				{
					if(strlen($DATA["EXAM_MID2_COMMITTEE_LAB"][$i]) != mb_strlen($DATA["EXAM_MID2_COMMITTEE_LAB"][$i], 'utf-8'))
					{
						$name_type = 'TH';
					}
					else
					{
						$name_type = 'EN';
					}
					$teacher_id = $person->Get_Teacher_Id($DATA["EXAM_MID2_COMMITTEE_LAB"][$i]);
					if ($teacher_id) {
							$sql_exam_commitee="INSERT INTO `exam_commitee`( `exam_evaluate_id`, `teacher_id`,`name_type`, `type`, `type_commitee`) VALUES (".$result_exam_evaluate_id[0]["exam_evaluate_id"].",'".$teacher_id."','".$name_type."','MID2','LAB')";
							$result_exam_commitee = $db->Insert_Update_Delete($sql_exam_commitee);

					}
				}
			}

			//FINAL
			for ($i=0; $i < count($DATA["EXAM_FINAL_COMMITTEE_LEC"]); $i++) {
				if($DATA["EXAM_FINAL_COMMITTEE_LEC"][$i] != "")
				{
					if(strlen($DATA["EXAM_FINAL_COMMITTEE_LEC"][$i]) != mb_strlen($DATA["EXAM_FINAL_COMMITTEE_LEC"][$i], 'utf-8'))
					{
						$name_type = 'TH';
					}
					else
					{
						$name_type = 'EN';
					}
			    $teacher_id =$person-> Get_Teacher_Id($DATA["EXAM_FINAL_COMMITTEE_LEC"][$i]);
			    if (!$teacher_id) {
			        $log->Write("find failed : not found EXAM_FINAL_COMMITTEE_LEC id".$DATA["EXAM_FINAL_COMMITTEE_LEC"][$i] );
			    }
			    if ($teacher_id) {
			        $sql_exam_commitee="INSERT INTO `exam_commitee`( `exam_evaluate_id`, `teacher_id`,`name_type`, `type`, `type_commitee`) VALUES (".$result_exam_evaluate_id[0]["exam_evaluate_id"].",'".$teacher_id."','".$name_type."','FINAL','LEC')";
			        $result_exam_commitee = $db->Insert_Update_Delete($sql_exam_commitee);
			    }
				}
			}

			for ($i=0; $i < count($DATA["EXAM_FINAL_COMMITTEE_LAB"]); $i++) {
				if($DATA["EXAM_FINAL_COMMITTEE_LAB"][$i] != "")
				{
					if(strlen($DATA["EXAM_FINAL_COMMITTEE_LAB"][$i]) != mb_strlen($DATA["EXAM_FINAL_COMMITTEE_LAB"][$i], 'utf-8'))
					{
						$name_type = 'TH';
					}
					else
					{
						$name_type = 'EN';
					}
					$teacher_id =$person->Get_Teacher_Id($DATA["EXAM_FINAL_COMMITTEE_LAB"][$i]);
					if (!$teacher_id) {
							$log->Write("find failed : not found EXAM_FINAL_COMMITTEE_LAB id".$DATA["EXAM_FINAL_COMMITTEE_LAB"][$i] );
					}
					if ($teacher_id) {
							$sql_exam_commitee="INSERT INTO `exam_commitee`( `exam_evaluate_id`, `teacher_id`,`name_type`, `type`, `type_commitee`) VALUES (".$result_exam_evaluate_id[0]["exam_evaluate_id"].",'".$teacher_id."','".$name_type."','FINAL','LAB')";
							$result_exam_commitee = $db->Insert_Update_Delete($sql_exam_commitee);
					}
				}
			}

			//course_evaluate
			$year = (int)$DATA["YEAR"]-543;
			$submit_date = strtotime((int)$DATA["DATE"]."-".(int)$DATA["MONTH"]."-".$year);
			$mysqldate = date( 'Y-m-d ', $submit_date );

			$sql_course_evaluate = "INSERT INTO `course_evaluate`(`course_id`,`noorspe`,`num_section`,`credit_total`,`type`, `type_other`,`teacher_co`, `semester_id`, `criterion_grade_id`, `exam_evaluate_id`,`measure_evaluate_id`,`absent`,`status`, `submit_user_id`,`submit_date`)
			                        VALUES ('".$DATA["COURSE_ID"]."','".$DATA["NORORSPE"]."',".$DATA["SECTION"].",'".$DATA["CREDIT_TOTAL"]."','".$DATA["TYPE_TEACHING"]."','".$DATA["TYPE_TEACHING_NAME"]."','".$DATA["TEACHER-CO"]."','".$semester['id']."','".$result_criterion_grade_id[0]["criterion_grade_id"]."','".$result_exam_evaluate_id[0]["exam_evaluate_id"]."','".$result_measure_evaluate_id[0]["measure_evaluate_id"]."','".$DATA["ABSENT"]."','0','".$DATA["USERID"]."','".$mysqldate."')";

			$sql_course_evaluate .= "ON DUPLICATE KEY UPDATE `noorspe` = '".$DATA["NORORSPE"]."',`num_section` = ".$DATA["SECTION"].",`credit_total` = '".$DATA["CREDIT_TOTAL"]."',`type` = '".$DATA["TYPE_TEACHING"]."',`type_other` = '".$DATA["TYPE_TEACHING_NAME"]."',`teacher_co` = '".$DATA["TEACHER-CO"]."', `semester_id` = '".$semester['id']."',`criterion_grade_id` = '".$result_criterion_grade_id[0]["criterion_grade_id"]."',`exam_evaluate_id` = '".$result_exam_evaluate_id[0]["exam_evaluate_id"]."', `measure_evaluate_id` = '".$result_measure_evaluate_id[0]["measure_evaluate_id"]."',`absent` = '".$DATA["ABSENT"]."',`status` = '0',`submit_user_id` = '".$DATA["USERID"]."',`submit_date` = '".$mysqldate."'";
			$lastrow_course_evaluate = "SELECT course_evaluate_id FROM course_evaluate ORDER BY course_evaluate_id DESC LIMIT 1";

			$result_course_evaluate = $db->Insert_Update_Delete($sql_course_evaluate);
			if ($result_course_evaluate) {
			    $result_course_evaluate_id = $db->Query($lastrow_course_evaluate);
			}


			//teacher_exam_evaluate

			for ($i=0; $i <sizeof($DATA["STUDENT"]);  $i++) {
			    $sql_student_evaluate="INSERT INTO `student_evaluate`(`course_evaluate_id`,`section`, `student`) VALUES ('".$result_course_evaluate_id[0]["course_evaluate_id"]."',".($i+1).",".$DATA["STUDENT"][$i].")";
					$sql_student_evaluate .= "ON DUPLICATE KEY UPDATE `section` = ".($i+1).", `student` = ".$DATA["STUDENT"][$i]."";
			    $result_student_evaluate = $db->Insert_Update_Delete($sql_student_evaluate);

			}


			//teacher_exam_evaluate
			$sql = "DELETE FROM `teacher_exam_evaluate` WHERE `course_eveluate_id` =  ".$result_course_evaluate_id[0]["course_evaluate_id"];
			$result = $db->Insert_Update_Delete($sql);
			for ($i=0; $i < sizeof($DATA["TEACHER"]); $i++) {
				if($DATA["TEACHER"][$i] != '')
				{
					if(strlen($DATA["TEACHER"][$i]) != mb_strlen($DATA["TEACHER"][$i], 'utf-8'))
					{
						$name_type = 'TH';
					}
					else
					{
						$name_type = 'EN';
					}
			    $teacher_id = $person->Get_Teacher_Id($DATA["TEACHER"][$i]);
			    if (!$teacher_id) {
			        $log->Write("insert data into database failed : not found TEACHER id on ".$DATA["TEACHER"][$i]);
			    }
			    if ($teacher_id) {
			        $sql_teacher_exam_evaluate = "INSERT INTO `teacher_exam_evaluate`(`teacher_id`, `course_eveluate_id`,`name_type`)VALUES ('".$teacher_id."',".$result_course_evaluate_id[0]["course_evaluate_id"].",'".$name_type."')";
							$sql_teacher_exam_evaluate .= "ON DUPLICATE KEY UPDATE `teacher_id` = '".$teacher_id."' , `course_eveluate_id` = ".$result_course_evaluate_id[0]["course_evaluate_id"].", `name_type` = '".$name_type."'";
			        $result_teacher_exam_evaluate = $db->Insert_Update_Delete($sql_teacher_exam_evaluate);
			    }
				}
			}
		}
		if(isset($_FILES['file']))
		{
			$file = $_FILES['file'];
			Upload($file,$DATA['COURSE_ID']);
		}
	if($DATA['SUBMIT_TYPE'] == '2')
		{
			//type 1 , 2
			Close_connection();
			$return['status'] = "success";
			$return['msg'] = "บันทึกสำเร็จ";
			echo json_encode($return);
			die;
		}
}
else
{

	$return['status'] = "error";
	$return['msg'] = 'ไม่มีข้อมูลนำเข้า';
	echo json_encode($return);
	Close_connection();
}
$data_pdf = $course->Get_Document('evaluate',$course_id,null,null,$semester['semester'],$semester['year']);
if($data_pdf == false)
{
	$return['status'] = "error";
	$return['msg'] = "ไม่สามารถดึงข้อมูลได้" ;
	echo json_encode($return);
	die;
}
//start generate pdf
define('FPDF_FONTPATH','font/');
if($DATA['SUBMIT_TYPE'] != '4')
{
	$data_pdf['num_section'] = 1;
}
for($num_section = 0 ; $num_section < $data_pdf['num_section']; $num_section ++)
{
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
// tahoma.php

$pdf->SetFont('THSarabun_B','',20);
$pdf->SetX(25);
$pdf->Cell(0,10,iconv( 'UTF-8','cp874','แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา คณะเภสัชศาสตร์'),0,1,"C");
//$pdf->SetFont('THSarabun','',20);
$pdf->Cell(0,10,iconv( 'UTF-8','cp874','ภาคการศึกษาที่ '.$semester['semester'].' ปีการศึกษา '.$semester['year']),0,1,"C");

$pdf->SetX(20);
$pdf->SetFont('THSarabun_B','',14);
$SECTION = '1';
if($data_pdf['noorspe'] == "NORMAL")
{
	$nor_section = $data_pdf['num_section'];
	$nor_credit = $data_pdf['credit_total'];
	$nor_student = $data_pdf['student'][$num_section];
	$spe_sction = '-';
	$spe_credit = '-';
	$spe_student = '-';
}
else if($data_pdf['noorspe'] == "SPECIAL")
{
	$spe_sction = $SECTION = $data_pdf['num_section'];
	$spe_credit = $data_pdf['credit_total'];
	$spe_student = $data_pdf['student'][$num_section];
	$nor_section = '-';
	$nor_credit = '-';
	$nor_student = '-';
}
// Topic 1
$pdf->Cell(26,7,iconv( 'UTF-8','cp874','1. รหัสกระบวนวิชา'),0,0,"L");

$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','   '.$data_pdf['course_id'].'   ตอนที่   '.$nor_section.'   จำนวนหน่วยกิต   '.$nor_credit.'   จำนวนนักศึกษาลงทะเบียนเรียน   '.$nor_student.'   คน'),0,1,"L");

$pdf->SetFont('THSarabun_B','',14);
$pdf->SetX(30);

$pdf->Cell(15,7,iconv( 'UTF-8','cp874','ภาคพิเศษ'),0,0,"L");

$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','ตอนที่   '.$spe_sction.'   จำนวนหน่วยกิต '.$spe_credit.' จำนวนนักศึกษาลงทะเบียนเรียน   '.$spe_student.'   คน'),0,1,"L");

$pdf->SetX(20);
// $pdf->Ln();
// Topic 2
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(40,7,iconv( 'UTF-8','cp874','2. ลักษณะการเรียนการสอน: '),0,0,"L");

$CHECKBOX['LEC'] = $CHECKBOX['LECLAB'] = $CHECKBOX['SPE'] = $CHECKBOX['TRA'] = $CHECKBOX['SEM'] = $CHECKBOX['LAB'] = $CHECKBOX['OTH'] = '[   ]';

switch ($data_pdf['type']) {
	case 'LEC':
		$CHECKBOX['LEC'] = '[ / ]';
		break;
	case 'LECLAB':
		$CHECKBOX['LECLAB'] = '[ / ]';
		break;
	case 'SPE':
		$CHECKBOX['SPE'] = '[ / ]';
		break;
	case 'TRA':
		$CHECKBOX['TRA'] = '[ / ]';
		break;
	case 'TRA':
		$CHECKBOX['TRA'] = '[ / ]';
		break;
	case 'SEM':
		$CHECKBOX['SEM'] = '[ / ]';
		break;
	case 'LAB':
		$CHECKBOX['LAB'] = '[ / ]';
		break;
	case 'OTH':
		$CHECKBOX['OTH'] = '[ / ]';
		break;
	default:
		# code...
		break;
}

$pdf->SetFont('THSarabun','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$CHECKBOX['LEC'].' บรรยาย'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','cp874',$CHECKBOX['LECLAB'].' บรรยายและงานปฏิบัติการ'),0);
$pdf->Cell(30,7,iconv( 'UTF-8','cp874',$CHECKBOX['SPE'].' โครงงานทางเภสัชกรรม'),0);
$pdf->Ln();

$pdf->SetX(60);

$pdf->Cell(20, 7, iconv( 'UTF-8','cp874',$CHECKBOX['TRA'].' ฝึกงาน'), 0);
$pdf->Cell(20, 7, iconv( 'UTF-8','cp874',$CHECKBOX['SEM'].' สัมมนา'), 0);
$pdf->Cell(30, 7, iconv( 'UTF-8','cp874',$CHECKBOX['LAB'].' ปฏิบัติการ'), 0);
$pdf->Cell(10, 7, iconv( 'UTF-8','cp874',$CHECKBOX['OTH'].' อื่นๆ '.$data_pdf['type_other']), 0);
$pdf->Ln();

$pdf->SetX(20);
// $pdf->Ln();
// Topic 3
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(50,7,iconv( 'UTF-8','cp874','3. รายชื่ออาจารย์ผู้สอน '),0,1,"L");
$pdf->SetX(35);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874','บรรยาย: '),0,0,"L");
$j=0;

for($i=1;$i<6;$i++)
{

	$pdf->Cell(30,7,$i < count($data_pdf['teacher']) +1  ? iconv( 'UTF-8','cp874',$i.') '.$data_pdf['teacher'][$i-1]) : $i.")" ,0);
	$pdf->Ln();
	$pdf->SetX(55);

}
$pdf->SetX(35);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874','อาจารย์ผู้ร่วมสอน '),0,1,"L");
$pdf->SetX(50);
$pdf->MultiCell( 140, 7, iconv( 'UTF-8','TIS-620',$data_pdf['teacher_co']), 0,1);
//$pdf->Ln();

// Topic 4

$pdf->SetX(20);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(100,7,iconv( 'UTF-8','cp874','4. การวัดผลการศึกษา'),0);

$pdf->SetFont('THSarabun','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874','สัดส่วนการให้คะแนน (ระบุเป็นร้อยละ)'),0);
$pdf->Ln();

$pdf->SetFont('THSarabun_B','',14);
$pdf->SetX(120);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874','ภาคทฤษฏี'),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','cp874','ภาคปฏิบัติ'),0,0,"C");
$pdf->Ln();

$pdf->SetFont('THSarabun','',14);
$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','cp874','1. สอบกลางภาค ครั้งที่ 1'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['mid1_lec'] ),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['mid1_lab'] ),0,0,"C");

$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','cp874','2. สอบกลางภาค ครั้งที่ 2'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['mid2_lec'] ),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['mid2_lab'] ),0,0,"C");

$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','cp874','3. สอบไล่'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['final_lec']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['final_lab']),0,0,"C");
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','cp874','4. งานมอบหมาย '),0);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['work_lec']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['work_lab']),0,0,"C");
$pdf->Ln();


$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','cp874','5. อื่นๆ '.$data_pdf['other_oth']),0);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['other_lec']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['other_lab']),0,0,"C");
$pdf->Ln();


$pdf->SetX(40);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(80,7,iconv( 'UTF-8','cp874','รวมคะแนน'),0);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['total_lec']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','cp874',$data_pdf['total_lab']),0,0,"C");
$pdf->Ln();

$pdf->SetX(30);
$pdf->SetFont('THSarabun','',14);
$pdf->Write( 7 , iconv( 'UTF-8','cp874' , $data_pdf['suggestion'] ) );
$pdf->Ln();
$pdf->Ln();

// Topic 5

$pdf->SetX(20);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','5. การสอบ โปรดระบุให้ชัดเจน และครบถ้วน เพื่อใช้เป็นข้อมูลการจัดตารางสอบ (กรุณาระบุชื่ออาจารย์ที่ร่วมสอนในกระบวนวิชา'),0,1,"L");
$pdf->SetX(20);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','และจำนวนกรรมการคุมสอบอาจระบุอย่างน้อย 3 คน'),0,1,"L");

$pdf->SetFont('THSarabun','',14);
$pdf->SetX(25);

$pdf->Cell(0,7,iconv( 'UTF-8','cp874','5.1 สอบกลางภาค ครั้งที่ 1  '),0,1,"L");
$pdf->SetX(55);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','จำนวน ชม.สอบ                                            กรรมการคุมสอบ'),0,1,"L");

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','cp874','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','cp874','- บรรยาย '),0,0,"L");
$pdf->Cell(15,7,$data_pdf['mid1_hour_lec'],0 ,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($data_pdf['exam_mid1_committee_lec']) +1  ? iconv( 'UTF-8','cp874',$i.') '.$data_pdf['exam_mid1_committee_lec'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j = 0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','cp874','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','cp874','- ปฏิบัติการ '),0,0,"L");
$pdf->Cell(15,7,$data_pdf['mid1_hour_lab'],0,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($data_pdf['exam_mid1_committee_lab']) +1  ? iconv( 'UTF-8','cp874',$i.') '.$data_pdf['exam_mid1_committee_lab'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j = 0;
		$pdf->Ln();
		$pdf->SetX(80);

	}
}
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','5.2 สอบกลางภาค ครั้งที่ 2  '),0,1,"L");
$pdf->SetX(55);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','จำนวน ชม.สอบ                                            กรรมการคุมสอบ'),0,1,"L");
$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','cp874','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','cp874','- บรรยาย '),0,0,"L");
$pdf->Cell(15,7,$data_pdf['mid2_hour_lec'],0 ,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($data_pdf['exam_mid2_committee_lec']) +1  ? iconv( 'UTF-8','cp874',$i.') '.$data_pdf['exam_mid2_committee_lec'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j = 0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','cp874','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','cp874','- ปฏิบัติการ '),0,0,"L");
$pdf->Cell(15,7,$data_pdf['mid2_hour_lab'],0,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($data_pdf['exam_mid2_committee_lab']) +1  ? iconv( 'UTF-8','cp874',$i.') '.$data_pdf['exam_mid2_committee_lab'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j=0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(25);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','5.3 สอบไล่'),0,1,"L");
$pdf->SetX(55);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','จำนวน ชม.สอบ                                            กรรมการคุมสอบ'),0,1,"L");
$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','cp874','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','cp874','- บรรยาย '),0,0,"L");
$pdf->Cell(15,7,$data_pdf['final_hour_lec'],0 ,0,"C");

$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($data_pdf['exam_final_committee_lec']) +1  ? iconv( 'UTF-8','cp874',$i.') '.$data_pdf['exam_final_committee_lec'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j=0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','cp874','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','cp874','- ปฏิบัติการ '),0,0,"L");
$j = 0 ;
$pdf->Cell(15,7,$data_pdf['final_hour_lab'],0,0,"C");
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($data_pdf['exam_final_committee_lec']) +1  ? iconv( 'UTF-8','cp874',$i.') '.$data_pdf['exam_final_committee_lab'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j = 0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}
$pdf->Ln();

$pdf->Ln();

 $pdf->AddPage();

// Topic 6

$CAL_CRITERIA = $CAL_GROUP = $CAL_SU = '[   ]';
if($data_pdf['criterion_type'] == 'GROUP')
{
	$CAL_GROUP = '[ / ]';
}
else if($data_pdf['criterion_type'] == 'CRITERIA')
{
	$CAL_CRITERIA = '[ / ]';
}
else if ($data_pdf['criterion_type'] == 'SU')
{
	$CAL_SU = '[ / ]';
}

$pdf->SetFont('THSarabun_B','',14);
$pdf->SetX(20);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','6. วิธีการตัดเกรด'),0,1,"L");
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','cp874',' '.$CAL_GROUP.' อิงกลุ่ม'),0,1);
$pdf->SetX(35);
$pdf->Write( 7 , iconv( 'UTF-8','cp874' ,'คำอธิบาย '.$data_pdf['explaination']));
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(30,7,iconv('UTF-8','cp874',' '.$CAL_CRITERIA.' อิงเกณฑ์'),0,1);
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','cp874',' '.$CAL_SU.' ให้อักษร S หรือ U (ได้รับการอนุมัติจากมหาวิทยาลัยแล้ว)  '),0);
$pdf->SetFont('THSarabun','',14);
$pdf->Ln();

$pdf->SetFont('THSarabun_B','',14);
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','cp874','การประเมินผล'),0,1);
$pdf->SetX(25);
$pdf->SetFont('THSarabun','',14);
if($data_pdf['criterion_type'] == 'SU')
{
	$pdf->SetX(35);
	$pdf->Cell(10,7,'S   = ',0,0,'C');
	$pdf->Cell(50,7,iconv('UTF-8','cp874'," ตั้งแต่ ".$data_pdf['S_min']),0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนนขึ้นไป '),0,0,'C');
	$pdf->Ln();

	$pdf->SetX(35);
	$pdf->Cell(10,7,'U   = ',0,0,'C');
	$pdf->Cell(50,7,iconv('UTF-8','cp874'," น้อยกว่า ".$data_pdf['U_max']),0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนนลงมา '),0,0,'C');
	$pdf->Ln();

}
else if($data_pdf['criterion_type'] == 'CRITERIA')
{
	$pdf->SetX(35);
	$pdf->Cell(10,7,'A   = ',0,0,'C');
	$pdf->Cell(50,7,iconv('UTF-8','cp874',' ตั้งแต่ '.$data_pdf['A_min']),0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนนขึ้นไป '),0,0,'C');

	$pdf->Cell(10,7,'D+  = ',0,0,'C');
	$pdf->Cell(20,7,$data_pdf['D+_min'],0,0,'C');
	$pdf->Cell(10,7,iconv('UTF-8','cp874','  ถึง  '),0,0,'C');
	$pdf->Cell(20,7,$data_pdf['D_max'],0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนน'),0,0,'C');
	$pdf->Ln();

	$pdf->SetX(35);
	$pdf->Cell(10,7,'B+  = ',0,0,'C');
	$pdf->Cell(20,7,$data_pdf['B+_min'],0,0,'C');
	$pdf->Cell(10,7,iconv('UTF-8','cp874','  ถึง  '),0,0,'C');
	$pdf->Cell(20,7,$data_pdf['B+_max'],0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนน'),0,0,'C');

	$pdf->Cell(10,7,'D   = ',0,0,'C');
	$pdf->Cell(20,7,$data_pdf['D_min'],0,0,'C');
	$pdf->Cell(10,7,iconv('UTF-8','cp874','  ถึง  '),0,0,'C');
	$pdf->Cell(20,7,$data_pdf['D_max'],0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนน'),0,0,'C');

	$pdf->Ln();

	$pdf->SetX(35);

	$pdf->Cell(10,7,'B   = ',0,0,'C');
	$pdf->Cell(20,7,$data_pdf['B_min'],0,0,'C');
	$pdf->Cell(10,7,iconv('UTF-8','cp874','  ถึง  '),0,0,'C');
	$pdf->Cell(20,7,$data_pdf['B_max'],0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนน'),0,0,'C');

	$pdf->Cell(10,7,'F   = ',0,0,'C');
	$pdf->Cell(50,7,iconv('UTF-8','cp874',' น้อยกว่า '.$data_pdf['F_max']),0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนนลงมา '),0,0,'C');
	$pdf->Ln();

	$pdf->SetX(35);
	$pdf->Cell(10,7,'C+   = ',0,0,'C');
	$pdf->Cell(20,7,$data_pdf['C+_min'],0,0,'C');
	$pdf->Cell(10,7,iconv('UTF-8','cp874','  ถึง  '),0,0,'C');
	$pdf->Cell(20,7,$data_pdf['C+_max'],0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนน'),0,0,'C');
	$pdf->Ln();

	$pdf->SetX(35);
	$pdf->Cell(10,7,'C   = ',0,0,'C');
	$pdf->Cell(20,7,$data_pdf['C_min'],0,0,'C');
	$pdf->Cell(10,7,iconv('UTF-8','cp874','  ถึง  '),0,0,'C');
	$pdf->Cell(20,7,$data_pdf['C_max'],0,0,'C');
	$pdf->Cell(20,7,iconv('UTF-8','cp874','คะแนน'),0,0,'C');
	$pdf->Ln();
}

$pdf->Ln();
// Topic 7
$AB_F = $AB_U = $AB_CAL = '[   ]';
if($data_pdf['absent'] == 'F')
{
	$AB_F = '[ / ]';
}
else if($data_pdf['absent'] == 'U')
{
	$AB_U = '[ / ]';
}
else if($data_pdf['absent'] == 'CAL')
{
	$AB_CAL = '[ / ]';
}


$pdf->SetFont('THSarabun_B','',14);
$pdf->SetX(20);
$pdf->Cell(65,7,iconv( 'UTF-8','cp874','7. นักศึกษาที่ขาดสอบในการวัดผลครั้งสุดท้าย'),0);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','โดยไม่ได้รับอนุญาตให้เลื่อนการสอบตามข้อบังคับฯ ของมหาวิทยาลัยเชียงใหม่'),0);
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874','ว่าด้วยการศึกษาชั้นปริญญาตรี อาจารย์ผู้สอนจะประเมินดังนี้'),0);
$pdf->Ln();
$pdf->SetX(30);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874',$AB_F.' ให้ลำดับขั้น F    '.$AB_U.' ให้อักษร U   '.$AB_CAL.' นำคะแนนทั้งหมดที่นักศึกษาได้รับก่อนการสอบไล่มาประเมิน'),0,1);
$pdf->SetX(25);


$person = new Person();
$respond_teacher = $course->Get_Responsible_Teacher($data_pdf['course_id'],$semester['id']);
$signature_file = $person->Get_Teacher_Signature($respond_teacher['id']);
$teacher_name = $person->Get_Teacher_Name($respond_teacher['id'],'TH');

$pdf->Cell(10,7,iconv('UTF-8','cp874','ลงชื่อ'),0);
if($signature_file != null)
{
	$pdf->Cell( 40, 7, $pdf->Image($signature_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
}

$day = date('d', strtotime($data_pdf['submit_date']));
$month = date('m', strtotime($data_pdf['submit_date']));
$year = date('Y', strtotime($data_pdf['submit_date'])) + 543;

$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','cp874','('.$teacher_name.')'),0,1);
$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','cp874','(ผู้รับผิดชอบกระบวนวิชา)'),0,1);
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','cp874','วันที่  '.$day.'   เดือน   '.$THAI_MONTH[(int)$month-1].'   พ.ศ.   '.$year),0,1);




///check if docment is approved

if($DATA['SUBMIT_TYPE'] == '3' || $DATA['SUBMIT_TYPE'] == '4')
{
	$course_dep = $person->Get_Staff_Dep($respond_teacher['id']);
  $head_department_id = $person->Get_Head_Department($course_dep['code'],$data_pdf['course_id']);
 	$approver_name = $person->Get_Teacher_Name($head_department_id,'TH');
 	$signature_approver_file = $person->Get_Teacher_Signature($head_department_id);
//if approve
	$pdf->Ln();
	$pdf->SetFont('THSarabun_B','',14);
	$pdf->SetX(20);
	$pdf->Cell(65,7,iconv( 'UTF-8','cp874','8. ความเห็นของหัวหน้าภาควิชา'),0);
	$pdf->SetFont('THSarabun','',14);
	$pdf->SetX(85);
	$pdf->Write( 7 , iconv( 'UTF-8','cp874' , 'เห็นชอบ' ) );
	$pdf->Ln();
	$pdf->SetX(25);
	$pdf->Cell(10,7,iconv('UTF-8','cp874','ลงชื่อ'),0);
	if($signature_approver_file != null)
	{
		$pdf->Cell( 40, 7, $pdf->Image($signature_approver_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
	}
	// $pdf->Cell(0,7,iconv('UTF-8','cp874','วันที่  '.date(" d ").'   เดือน   '.$THAI_MONTH[(int)date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
	$pdf->Ln();

	$pdf->SetX(35);
	$pdf->Cell(0,7,iconv('UTF-8','cp874','('.$approver_name.')'),0,1);
	$pdf->SetX(35);
	$pdf->Cell(0,7,iconv('UTF-8','cp874','(หัวหน้าภาควิชา)'),0,1);
	$person->Close_connection();

}
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
$file_path = $file_path."/evaluate";
$sec = (int)$num_section + 1;
$file_path_sql = $file_path_sql."/evaluate/evaluate_".$data_pdf['course_id']."_".$sec."_".$semester['semester']."_".$semester['year'].".pdf";
if(!file_exists($file_path))
{
	mkdir($file_path);
}

$pdf->Output($file_path."/evaluate_".$data_pdf['course_id']."_".$sec."_".$semester['semester']."_".$semester['year'].".pdf","F");

$sql = "UPDATE `student_evaluate` SET `pdf_file` = '".$file_path_sql."' WHERE `course_evaluate_id` = '".$data_pdf['course_evaluate_id']."' AND `section` = ".$sec;
$result = $db->Insert_Update_Delete($sql);
}
if($DATA['SUBMIT_TYPE'] == '1')
{
	$approve = new approval('1');
	$result = $approve->Update_Status_Evaluate($DATA['COURSE_ID'],'1','all','');
	if($result)
	{
		$url = $curl->GET_SERVER_URL();
    $view_url = $url."/application/pdf/view.php";
		$return['status'] = "success";
		$return['msg'] = $view_url."?course=".$data_pdf['course_id']."&type=draft&info=evaluate&semester=".$semester['semester']."&year=".$semester['year'];
	}
	else
	{
		$return['status'] = "error";
		$return['msg'] = 'ไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
	}
}
else
{
	$return['status'] = "success";
	$return['msg'] = "บันทึกสำเร็จ";
}
echo json_encode($return);
 ?>
