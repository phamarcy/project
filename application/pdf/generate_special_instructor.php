<?php
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/database.php');
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/curl.php');
require_once(__DIR__.'/../class/log.php');
require_once(__DIR__.'/../class/person.php');
$log = new Log();
$curl = new CURL();
$db = new Database();
$deadline = new Deadline();
$course = new Course();
$person = new Person();
$semester = $deadline->Get_Current_Semester();
$instructor_id = '';
// var_dump($_POST['DATA']);die;
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
	$DATA['PAYMENT']["COSTHOTEL"]['COST'] = '111';
	if($DATA['SUBMIT_TYPE'] != 3 && $DATA['SUBMIT_TYPE'] != 4)
	{
		$course_id  = $DATA['COURSEDATA']['COURSE_ID'];
		$fname = $DATA['TEACHERDATA']['FNAME'];
		$lname = $DATA['TEACHERDATA']['LNAME'];
			//insert data into database
			$DATA["TEACHERDATA"]["HISTORY"] = '1';
			$sql="INSERT INTO `special_instructor`( `department_name`,`prefix`, `firstname`, `lastname`, `position`, `qualification`, `work_place`, `phone`, `phone_sub`, `phone_mobile`, `email`, `invited`, `course_id`, `num_student`, `type_course`, `reason`, `lecture_topic`, `lecture_date`, `lecture_time_start`,`lecture_time_end`, `lecture_room`, `lecture_hour`, `level_teacher`, `level_descript`, `cost_lec_choice`, `cost_lec_number`, `cost_lec_hour`, `cost_lec_cost`,`cost_plane_check`, `cost_plane_depart`, `cost_plane_arrive`, `cost_plane_cost`,`cost_taxi_check` ,`cost_taxi_depart`, `cost_taxi_arrive`, `cost_taxi_cost`,`cost_car_check`, `cost_car_distance`, `cost_car_unit`, `cost_car_cost`, `cost_hotel_choice`, `cost_hotel_per_night`, `cost_hotel_number`,`cost_hotel_cost`, `cost_total`,`submit_user_id`,`semester_id`,`num_topic`)";
			$sql .= "VALUES ('".$DATA["TEACHERDATA"]['DEPARTMENT']."','".$DATA['TEACHERDATA']['PREFIX']."','".$DATA['TEACHERDATA']['FNAME']."','".$DATA['TEACHERDATA']['LNAME']."','".$DATA['TEACHERDATA']['POSITION']."','".$DATA['TEACHERDATA']['QUALIFICATION']."','".$DATA['TEACHERDATA']['WORKPLACE']."','".$DATA['TEACHERDATA']['TELEPHONE']['NUMBER']."','".$DATA['TEACHERDATA']['TELEPHONE']['SUB']."','".$DATA['TEACHERDATA']['MOBILE']."','".$DATA['TEACHERDATA']['EMAIL']."','".$DATA["TEACHERDATA"]["HISTORY"]."','".$DATA['COURSEDATA']['COURSE_ID']."',".$DATA['COURSEDATA']["NOSTUDENT"].",'".$DATA['COURSEDATA']['TYPE_COURSE']."','".$DATA['COURSEDATA']['REASON']."','".$DATA['COURSEDATA']['DETAIL']['TOPICLEC']."','".$DATA['COURSEDATA']['DETAIL']['DATE']."','".$DATA['COURSEDATA']['DETAIL']['TIME']['BEGIN']."','".$DATA['COURSEDATA']['DETAIL']['TIME']['END']."','".$DATA['COURSEDATA']['DETAIL']['ROOM']."',".$DATA['COURSEDATA']['HOUR'].",'".$DATA['PAYMENT']["LVLTEACHER"]["CHOICE"]."','".$DATA['PAYMENT']['LVLTEACHER']['DESCRIPT']."','".$DATA["PAYMENT"]["COSTSPEC"]['CHOICE']."','".$DATA['PAYMENT']['COSTSPEC']['NUMBER']."','".$DATA['PAYMENT']['COSTSPEC']['HOUR']."','".$DATA['PAYMENT']['COSTSPEC']['COST']."',".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]["CHECKED"].",'".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]['DEPART']."','".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]['ARRIVE']."','".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]['COST']."',".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['CHECKED'].",'".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['DEPART']."','".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['ARRIVE']."','".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['COST']."',".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['CHECKED'].",'".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['DISTANCT']."','".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['UNIT']."','".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['COST']."','".$DATA['PAYMENT']["COSTHOTEL"]['CHOICE']."',".$DATA['PAYMENT']["COSTHOTEL"]['PERNIGHT'].",".$DATA['PAYMENT']["COSTHOTEL"]['NUMBER'].",".$DATA['PAYMENT']["COSTHOTEL"]['COST'].",".$DATA['PAYMENT']["TOTALCOST"].",'".$DATA['USERID']."',".$semester['id'].",".$DATA['NUMTABLE'].")";

			$sql .= "  ON DUPLICATE KEY UPDATE `department_name` = '".$DATA["TEACHERDATA"]['DEPARTMENT']."',`prefix` = '".$DATA['TEACHERDATA']['PREFIX']."',`firstname` = '".$DATA['TEACHERDATA']['FNAME']."',`lastname` = '".$DATA['TEACHERDATA']['LNAME']."',`position` = '".$DATA['TEACHERDATA']['POSITION']."', `qualification` = '".$DATA['TEACHERDATA']['QUALIFICATION']."', `work_place` = '".$DATA['TEACHERDATA']['WORKPLACE']."',`phone` = '".$DATA['TEACHERDATA']['TELEPHONE']['NUMBER']."',`phone_sub` = '".$DATA['TEACHERDATA']['TELEPHONE']['SUB']."',`phone_mobile` =  '".$DATA['TEACHERDATA']['MOBILE']."',`email` = '".$DATA['TEACHERDATA']['EMAIL']."',`invited` = '".$DATA["TEACHERDATA"]["HISTORY"]."', `course_id` = '".$DATA['COURSEDATA']['COURSE_ID']."',`num_student` = ".$DATA['COURSEDATA']["NOSTUDENT"].",`type_course` = '".$DATA['COURSEDATA']['TYPE_COURSE']."',`reason` = '".$DATA['COURSEDATA']['REASON']."',`lecture_topic` =  '".$DATA['COURSEDATA']['DETAIL']['TOPICLEC']."',`lecture_date` = '".$DATA['COURSEDATA']['DETAIL']['DATE']."',`lecture_time_start` = '".$DATA['COURSEDATA']['DETAIL']['TIME']['BEGIN']."',`lecture_time_end` = '".$DATA['COURSEDATA']['DETAIL']['TIME']['END']."',`lecture_room` = '".$DATA['COURSEDATA']['DETAIL']['ROOM']."',`lecture_hour` = ".$DATA['COURSEDATA']['HOUR'].",`level_teacher` = '".$DATA['PAYMENT']["LVLTEACHER"]["CHOICE"]."',`level_descript` = '".$DATA['PAYMENT']['LVLTEACHER']['DESCRIPT']."',`cost_lec_choice` = '".$DATA["PAYMENT"]["COSTSPEC"]['CHOICE']."', `cost_lec_number` = '".$DATA['PAYMENT']['COSTSPEC']['NUMBER']."',`cost_lec_hour` = '".$DATA['PAYMENT']['COSTSPEC']['HOUR']."',`cost_lec_cost` = '".$DATA['PAYMENT']['COSTSPEC']['COST']."',`cost_plane_depart` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]['DEPART']."',`cost_plane_arrive` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]['ARRIVE']."',`cost_plane_cost` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]['COST']."',`cost_taxi_depart` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['DEPART']."',`cost_taxi_arrive` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['ARRIVE']."',`cost_taxi_cost` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['COST']."',`cost_car_distance`= '".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['DISTANCT']."',`cost_car_unit` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['UNIT']."',`cost_car_cost` = '".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['COST']."',`cost_hotel_choice` = '".$DATA['PAYMENT']["COSTHOTEL"]['CHOICE']."',`cost_hotel_per_night` = ".$DATA['PAYMENT']["COSTHOTEL"]['PERNIGHT'].",`cost_hotel_number` = ".$DATA['PAYMENT']["COSTHOTEL"]['NUMBER'].",`cost_hotel_cost` = ".$DATA['PAYMENT']["COSTHOTEL"]['COST'].",`cost_total` = ".$DATA['PAYMENT']["TOTALCOST"].",`submit_user_id` = '".$DATA['USERID']."',`semester_id` = ".$semester['id'].",`cost_car_check` = ".$DATA['PAYMENT']['COSTTRANS']["TRANSSELFCAR"]['CHECKED'].",`cost_taxi_check` = ".$DATA['PAYMENT']['COSTTRANS']["TRANSTAXI"]['CHECKED'].",`cost_plane_check` = ".$DATA['PAYMENT']['COSTTRANS']["TRANSPLANE"]["CHECKED"].",`num_topic` =  ".$DATA['NUMTABLE']." ;";

			$result = $db->Insert_Update_Delete($sql);
			if($result)
			{
				$sql = "SELECT `instructor_id` FROM `special_instructor` WHERE `firstname` = '".$fname."' AND `lastname` = '".$lname."' AND `semester_id` = ".$semester['id'];
				$temp_id = $db->Query($sql);
				if($temp_id)
				{
					$instructor_id = $temp_id[0]['instructor_id'];
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

//get data to generate pdf
$data_pdf = $course->Get_Document('special',$course_id,$instructor_id,null,$semester['semester'],$semester['year']);
if($data_pdf == false)
{
	$return['status'] = "error";
	$return['msg'] = "ไม่สามารถดึงข้อมูลได้" ;
	die;
}
echo json_encode($data_pdf);
die;
//start generate pdf
// $pdf=new FPDF();
//
// $pdf->AddPage();
// $pdf->SetMargins(20,10,20,0);
// $pdf->AddFont('angsa','','angsa.php');
// $pdf->AddFont('angsab','','angsab.php');
// $pdf->AddFont('THSarabun','','THSarabun.php');
// $pdf->AddFont('THSarabun_B','','THSarabun_B.php');
// $pdf->AddFont('cordiab','','cordiab.php');
// $pdf->AddFont('cordia','','cordia.php');
// $pdf->AddFont('tahoma','','tahoma.php');
// $pdf->AddFont('ZapfDingbats','','zapfdingbats.php');
//
// $pdf->SetFont('THSarabun_B','',14);
// $pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','แบบขออนุมัติเชิญอาจารย์พิเศษ'),0,1,"C");
//
// $pdf->SetX(75);
// $pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','ภาควิชา'),0,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','    '.$data_pdf['department_name'].'     '),0,"C");
// $pdf->Ln();
//
// $pdf->SetX(60);
// $pdf->SetFont('THSarabun_B','',14);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','ภาคการศึกษาที่'),0,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','        '.$semester['semester'].'         '),0,"C");
// $pdf->SetFont('THSarabun_B','',14);
// $pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','ปีการศึกษา'),0,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','        '.$semester['year'].'         '),0,"C");
// $pdf->Ln();
// #1
// $pdf->SetFont('THSarabun_B','',14);
// $pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','1. รายละเอียดของอาจารย์พิเศษ'),0,1);
//
// $pdf->SetX(25);
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.1 ชื่อ ')),7,iconv( 'UTF-8','TIS-620','1.1 ชื่อ '),0,"C");
//
// $RANK = $data_pdf['prefix'];
// $FIRSTNAME = $data_pdf['firstname'];
// $LASTNAME = $data_pdf['lastname'];
// $space_firstname = '';
// $space_lastname = '';
// $count = 80 - strlen($RANK) - strlen($FIRSTNAME);
// for($i=0;$i<$count;$i++)
// {
// 	$space_firstname .= ' ';
// }
// $count = 80 - strlen($LASTNAME);
// for($i=0;$i<$count;$i++)
// {
// 	$space_lastname .= ' ';
// }
// $pdf->Cell(60,7,iconv( 'UTF-8','TIS-620','    '.$RANK.' '.$FIRSTNAME.'  '.$space_firstname),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','นามสกุล ')),7,iconv( 'UTF-8','TIS-620','นามสกุล '),0,"C");
// $pdf->Cell(60,7,iconv( 'UTF-8','TIS-620','    '.$LASTNAME.'  '.$space_lastname),0,"C");
//
// $pdf->Ln();
//
// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.2 ตำแหน่ง ')),7,iconv( 'UTF-8','TIS-620','1.2 ตำแหน่ง '),0,"C");
// $POSITION = $data_pdf['position'];
// $pdf->MultiCell( 100, 7, iconv( 'UTF-8','TIS-620',$POSITION), 0,1);
//
// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.3 คุณวุฒิ/สาขาที่เชี่ยวชาญ ')),7,iconv( 'UTF-8','TIS-620','1.3 คุณวุฒิ/สาขาที่เชี่ยวชาญ '),0,"C");
// $QUALIFICATION = $data_pdf['qualification'];
// $pdf->MultiCell( 100, 7, iconv( 'UTF-8','TIS-620',$QUALIFICATION), 0,1);

// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.4 สถานที่ทำงาน/สถานที่ติดต่อ    ')),7,iconv( 'UTF-8','TIS-620','1.4 สถานที่ทำงาน/สถานที่ติดต่อ    '),0,"C");
// $pdf->Ln();
// $pdf->SetX(35);
// $pdf->MultiCell( 140, 7, iconv( 'UTF-8','TIS-620',$data_pdf['work_place']), 0,1);
// // $pdf->Ln();
//
// $pdf->SetX(30);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรศัพท์ '.$data_pdf['phone'].' ต่อ '.$data_pdf['phone_sub'])) + 5,7,iconv( 'UTF-8','TIS-620','โทรศัพท์ '.$data_pdf['phone'].' ต่อ '.$data_pdf['phone_sub']),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรศัพท์มือถือ '.$data_pdf['phone_mobile']))+3,7,iconv( 'UTF-8','TIS-620','โทรศัพท์มือถือ '.$data_pdf['phone_mobile']),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อีเมลล์ '.$data_pdf['email'])),7,iconv( 'UTF-8','TIS-620','อีเมลล์ '.$data_pdf['email']),0,1,"C");
// $pdf->SetX(32);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','กระบวนวิชานี้เป็นวิชา'))+5,7,iconv( 'UTF-8','TIS-620','หัวข้อที่เชิญมาสอน      '),0,"C");
// $pdf->SetFont('ZapfDingbats','',14);
// if((int)$data_pdf['invited'] == 1)
// {
// 	$HISTORY['yet'] = 3;
// 	$HISTORY['already'] = '';
// }
// else
// {
// 	$HISTORY['yet'] = '';
// 	$HISTORY['already'] = 3;
// }
// $pdf->Cell(4,4, $HISTORY['already'], 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เคยเชิญมาสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เคยเชิญมาสอน'),0);
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $HISTORY['yet'], 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ไม่เคยเชิญมาสอน'))+5,7,iconv( 'UTF-8','TIS-620',' ไม่เคยเชิญมาสอน'),0);
// $pdf->Ln();
// #2
// $pdf->SetFont('THSarabun_B','',14);
// $pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','2 รายละเอียดกระบวนวิชา'),0,1);
//
// $pdf->SetX(25);
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.1 กระบวนวิชาที่สอน    ')),9,iconv( 'UTF-8','TIS-620','2.1 กระบวนวิชาที่สอน    '),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',$data_pdf['course_id'])),9,iconv( 'UTF-8','TIS-620',$data_pdf['course_id']),0,'C');
// $pdf->SetX(100);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวนนักศึกษาทั้งหมด    ')),9,iconv( 'UTF-8','TIS-620','จำนวนนักศึกษาทั้งหมด   '),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',$data_pdf['num_student'].' คน')),9,iconv( 'UTF-8','TIS-620',$data_pdf['num_student'].' คน'),0,1,'C');
//
// if($data_pdf['type_course'] == "require")
// {
// 	$type['require'] = 3;
// 	$type['choose'] = '';
// }
// else if($data_pdf['type_course'] == "choose")
// {
// 	$type['choose'] = 3;
// 	$type['require'] = '';
// }
// else
// {
// 	$type['choose'] = '';
// 	$type['require'] = '';
// }
//
//
//
// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.2 กระบวนวิชานี้เป็นวิชา'))+5,7,iconv( 'UTF-8','TIS-620','2.2 กระบวนวิชานี้เป็นวิชา'),0);
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $type['require'], 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' บังคับ'),0,"C");
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $type['choose'], 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เลือก'),0,"C");
// $pdf->Ln();
// $pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.2 กระบวนวิชานี้เป็นวิชา'))+30);
//
//
// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.3 เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ   ')),7,iconv( 'UTF-8','TIS-620','2.3 เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ'),0,1,"C");
// $pdf->SetX(35);
// $pdf->MultiCell( 140, 7, iconv( 'UTF-8','TIS-620',$data_pdf['reason']), 0,1);
// // $pdf->Ln();
// $pdf->SetX(25);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','2.4 รายละเอียดในการสอน'),0,1);
// $pdf->SetX(35);
// $pdf->Cell(70,7,iconv( 'UTF-8','TIS-620','หัวข้อบรรยาย/ปฏิบัติการ '));
// $pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ว/ด/ป ที่สอน '));
// $pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','เวลา '));
// $pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ห้องเรียน'));
// $pdf->Ln();
// for($i=0;$i<count($data_pdf['COURSEDATA']['DETAIL']["TOPICLEC"]);$i++)
// {
// 	$num = $i+1;
// 	$pdf->SetX(30);
// 	$pdf->Cell(5,7,iconv('UTF-8','TIS-620',$num.'.'));
// 	$pdf->SetX(35);
// 	$before_y = $pdf->GetY();
// 	$before_x = $pdf->GetX();
// 	$pdf->MultiCell( 70, 7, iconv( 'UTF-8','TIS-620',$data_pdf['COURSEDATA']['DETAIL']["TOPICLEC"][$i]), 0,1);
// 	//$pdf->Ln();
// 	$current_y = $pdf->GetY();
// 	$current_x = $pdf->GetX();
//
// 	$data_date = strtotime($data_pdf['COURSEDATA']['DETAIL']["DATE"][$i]);
//  	$date = date('d-m-Y',$data_date);
//
// 	$pdf->SetXY($before_x + 70, $before_y);
// 	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$date));
//
// 	$current_x += 30;
// 	$pdf->SetXY($before_x + 100, $before_y);
// 	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$data_pdf['COURSEDATA']['DETAIL']["TIME"]["BEGIN"][$i].' - '.$data_pdf['COURSEDATA']['DETAIL']["TIME"]["END"][$i]));
//
// 	$current_x += 30;
// 	$pdf->SetXY($before_x + 130 , $before_y);
// 	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$data_pdf['COURSEDATA']['DETAIL']["ROOM"][$i]),0,1);
//
// 	$pdf->SetXY($current_x, $current_y);
//
//
// }
//
// $pdf->SetX(32);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'))+5,7,iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'),0,"C");
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620'," ".$data_pdf['lecture_hour']." "),0);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'))+5,7,iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'),0,"C");
// $pdf->Ln();
//
//
// #3
// $pdf->SetX(20);
// $pdf->SetFont('THSarabun_B','',14);
// $pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','3 ค่าใช้จ่าย'),0,1);
//
// $pdf->SetX(30);
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อาจารย์พิเศษเป็น '))+3,7,iconv('UTF-8','TIS-620','อาจารย์พิเศษเป็น'),0);
//
// if($data_pdf["level_teacher"] == "offical")
// {
// 	$pro = 3;
// 	$level_pro = $data_pdf["level_descript"];
// 	$norm = '';
// 	$level_norm = '';
// }
// else if($data_pdf["level_teacher"][CHOICE"] == "equivalent")
// {
// 	$pro = '';
// 	$level_pro = '';
// 	$norm = 3;
// 	$level_norm = $data_pdf["level_descript"];
// }
//
//
//
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $pro, 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ข้าราชการระดับ'))+1,7,iconv( 'UTF-8','TIS-620',' ข้าราชการระดับ'),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' '.$level_pro))+5,7,iconv( 'UTF-8','TIS-620',' '.$level_pro),0,"C");
//
// $pdf->Ln();
// $pdf->SetX(56);
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $norm, 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บุคคลเอกชนเทียบตำแหน่ง'))+1,7,iconv( 'UTF-8','TIS-620',' บุคคลเอกชนเทียบตำแหน่ง'),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ชำนาญการ '))+2,7,iconv( 'UTF-8','TIS-620',' '.$level_norm),0,"C");
// $pdf->Ln();
// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.1 ค่าสอนพิเศษ '))+3,10,iconv('UTF-8','TIS-620','3.1 ค่าสอนพิเศษ'),0,1);
//
// if($data_pdf["cost_lec_choice"] == "1")
// {
// 	$choice1 = 3;
// 	$choice2 = '';
// 	$cost1 = $data_pdf["cost_lec_cost"];
// 	$cost2 = '';
// 	$hour1 = $data_pdf["cost_lec_hour"];
// 	$hour2 = '';
// }
// else if($data_pdf["cost_lec_choice"] == "2")
// {
// 	$choice1 = '';
// 	$choice2 = 3;
// 	$cost2 = $data_pdf["cost_lec_cost"];
// 	$cost1 = '';
// 	$hour2 = $data_pdf["cost_lec_hour"];
// 	$hour1 = '';
// }
// else
// {
// 	$choice1 = '';
// 	$choice2 = '';
// 	$cost2 = '';
// 	$cost1 = '';
// 	$hour2 = '';
// 	$hour1 = '';
// }
//
//
//
// $pdf->SetX(40);
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $choice1, 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ 400/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีบรรยาย '.$data_pdf["PAYMENT"]["COSTSPEC"]["NUMBER"].'/ชม.'),0);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
// $pdf->Cell(13,7,iconv( 'UTF-8','TIS-620',$hour1),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
// $pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง 60 กม.ๆ ละ 4 บาท'))+50);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$cost1),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
// $pdf->Ln();
//
// $pdf->SetX(40);
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $choice2, 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ 200/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีปฏิบัติการ 200/ชม.'),0);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
// $pdf->Cell(13,7,iconv( 'UTF-8','TIS-620',$hour2),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
// $pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง 60 กม.ๆ ละ 4 บาท'))+50);
// $money_position = $pdf->GetX();
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$cost2),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
// $pdf->Ln();
//
// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.2 ค่าพาหนะเดินทาง '))+3,10,iconv('UTF-8','TIS-620','3.2 ค่าพาหนะเดินทาง'),0,1);
// $pdf->SetX(40);
// $pdf->SetFont('ZapfDingbats','',14);
// if((int)$data_pdf["cost_plane_check"] == 1)
// {
// 	$pdf->Cell(4,4, 3, 1,"C");
// }
// else
// {
// 	$pdf->Cell(4,4, '', 1,"C");
// }
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เครื่องบิน  ระหว่าง'))+1,7,iconv( 'UTF-8','TIS-620','เครื่องบิน ระหว่าง'),0);
// $pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$data_pdf["cost_plane_depart"].' - '.$data_pdf["cost_plane_arrive"]),0);
// $pdf->SetX($money_position);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["cost_plane_cost"]),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
// $pdf->Ln();
//
//
//
//
//
//
// $pdf->SetX(40);
// $pdf->SetFont('ZapfDingbats','',14);
// if((int)$data_pdf["cost_taxi_check"] == 1)
// {
// 	$pdf->Cell(4,4, 3, 1,"C");
// }
// else
// {
// 	$pdf->Cell(4,4, '', 1,"C");
// }
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ค่า taxi'))+1,7,iconv( 'UTF-8','TIS-620','ค่า taxi'),0);
// $pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$data_pdf["cost_taxi_depart"].' - '.$data_pdf["cost_taxi_arrive"]),0);
// $pdf->SetX($money_position);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["cost_taxi_cost"]),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
// $pdf->Ln();
//
//
//
//
// $pdf->SetX(40);
// $pdf->SetFont('ZapfDingbats','',14);
// if($data_pdf["cost_car_check"] == "true")
// {
// 	$pdf->Cell(4,4, 3, 1,"C");
// }
// else
// {
// 	$pdf->Cell(4,4, '', 1,"C");
// }
// $pdf->SetFont('THSarabun','',14);
// $pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง '.$data_pdf["distance"].' กม.ๆ ละ '.$data_pdf["unit"].' บาท')),7,iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง '.$data_pdf["distance"].' กม.ๆ ละ '.$data_pdf["unit"].' บาท'),0);
// $pdf->SetX($money_position);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["cost_car_cost"]),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);
//
//
//
// if($data_pdf["cost_hotel_choice"] == "1")
// {
// 	$choice_hotel1 = 3;
// 	$choice_hotel2 = '';
// 	$number = $data_pdf["PAYMENT"]["COSTHOTEL"]["NUMBER"];
// 	$per_night1 = $data_pdf["PAYMENT"]["COSTHOTEL"]["PERNIGHT"];
//  $per_night2 = '  ';
//
// }
// else if($data_pdf["cost_hotel_choice"] == "2")
// {
// 	$choice_hotel1 = '';
// 	$choice_hotel2 = 3;
// 	$number = $data_pdf["PAYMENT"]["COSTHOTEL"]["NUMBER"];
//  $per_night1 = '  ';
// 	$per_night2 = $data_pdf["PAYMENT"]["COSTHOTEL"]["PERNIGHT"];
//
// }
// else if ($data_pdf["cost_hotel_choice"] == "3")
// {
// 	$choice_hotel1 = '  ';
// 	$choice_hotel2 = '  ';
// 	$per_night1 = '  ';
//  $per_night2 = '  ';
// 	$price = '  ';
//  $number = '  ';
// }
//
//
//
// $pdf->AddPage();
// $pdf->SetX(25);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.3 ค่าที่พัก '))+3,7,iconv('UTF-8','TIS-620','3.3 ค่าที่พัก'),0);
// $pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $choice_hotel1, 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน '.$per_night1.' บาท/คน/คืน'))+10,7,iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน '.$per_night1.' บาท/คน/คืน'),0);
// $pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
// $pdf->SetFont('ZapfDingbats','',14);
// $pdf->Cell(4,4, $choice_hotel2, 1,"C");
// $pdf->SetFont('THSarabun','',14);
// $pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน '.$per_night2.' บาท/คน/คืน'))+1,7,iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน '.$per_night2.' บาท/คน/คืน'),0);
// $pdf->Ln();
// $pdf->SetX(50);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวน ')),7,iconv('UTF-8','TIS-620','จำนวน'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','  '.$number),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','คืน ')),7,iconv('UTF-8','TIS-620','คืน'),0);
// $pdf->SetX($money_position);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$price),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);
// $pdf->SetX($money_position-17);
// $pdf->SetFont('THSarabun_B','',14);
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','สรุปค่าใช้จ่ายทั้งหมด'))+5,7,iconv( 'UTF-8','TIS-620',' สรุปค่าใช้จ่ายทั้งหมด'),0);
// $pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$data_pdf["cost_total"]),0,"C");
// $pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);
//
// //get teacher name and signature
// $person = new Person();
// $signature_file = $person->Get_Teacher_Signature($data_pdf['submit_user_id']);
// $teacher_name = $person->Get_Teacher_Name($data_pdf['submit_user_id']);
// //end get
//
// $pdf->SetX(35);
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
// if($signature_file != null)
// {
// 	$pdf->Cell( 40, 7, $pdf->Image($signature_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
// }
// $pdf->SetX($money_position-10);
// $pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
// if($signature_file != null)
// {
// 	$pdf->Cell( 40, 7, $pdf->Image($signature_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
// }
// $pdf->Ln();
//
// $pdf->SetXY(40,$pdf->GetY()+3);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','('.$teacher_name.')'),0);
// $pdf->SetX($money_position-5);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','('.$teacher_name.')'),0,1);
// $pdf->SetX(45);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้เชิญอาจารย์พิเศษ'),0);
// $pdf->SetX($money_position-5);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้รับผิดชอบกระบวนวิชา'),0,1);
//
// $day = date('d', strtotime($data_pdf['updated_date']));
// $month = date('m', strtotime($data_pdf['updated_date']));
// $year = date('Y', strtotime($data_pdf['updated_date']));
// $pdf->SetX(35);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.$day.'   เดือน   '.$THAI_MONTH[(int)month-1].'   พ.ศ.   '.$year),0);
// $pdf->SetX($money_position-17);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.$day.'   เดือน   '.$THAI_MONTH[(int)month-1].'   พ.ศ.   '.$year),0);
//
// //update approval special instructor
//
//
// //end update
//
// //check if document is approve
// if($DATA['SUBMIT_TYPE'] == '3' || $DATA['SUBMIT_TYPE'] == '4')
// {
//  $course_dep = $person->Get_Staff_Dep($data_pdf['submit_user_id']);
//  $head_department_id = $person->Get_Head_Department($course_dep['code'],$data_pdf['course_id']);
// 	$approver_name = $person->Get_Teacher_Name($head_department_id);
// 	$signature_approver_file = $person->Get_Teacher_Signature($head_department_id);
//
// $pdf->Ln();
// $pdf->SetX(20);
// $pdf->Cell(0+5,7,iconv( 'UTF-8','TIS-620',' การขอเชิญอาจารย์พิเศษนี้ได้ผ่านความเห็นชอบของกรรมการวิชาการภาควิชาแล้ว เมื่อวันที่ '.date(" j ").'   เดือน   '.$THAI_MONTH[(int)date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0,1);
//
// $pdf->SetX($money_position-25);
// $pdf->SetFont('THSarabun','',14);
// $pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
//
// if($signature_approver_file != null)
// {
// 	$pdf->Cell( 40, 7, $pdf->Image($signature_approver_file, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
// }
// $pdf->Ln();
//
// $pdf->SetXY($money_position-15,$pdf->GetY()+3);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620',$approver_name),0,1);
// $pdf->SetXY($money_position-15,$pdf->GetY()+3);
// $pdf->Cell(0,7,iconv('UTF-8','TIS-620','หัวหน้า/ผู้แทนหัวหน้าภาควิชา'),0,1);
//
// // $pdf->SetX($money_position-20);
// // $pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" d ").'   เดือน   '.$THAI_MONTH[(int)date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
// }
// $person->Close_connection();
// if($DATA['SUBMIT_TYPE'] == '1' || $DATA['SUBMIT_TYPE'] == '3')
// {
// 	$file_path = $FILE_PATH."/draft";
// }
// else if ($DATA['SUBMIT_TYPE'] == '4')
// {
// 	$file_path = $FILE_PATH."/complete";
// }
// else
// {
// 	$file_path = $FILE_PATH;
// }

// $pdf->Output($file_path."/".$data_pdf['course_id']."_".$instructor_id."_".$semester['semester']."_".$semester['year'].".pdf","F");
//
// if($submit_type == 1)
// {
// 	$result = $approve->Append_Special_Instructor($data_pdf['course_id'],$instructor_id);
// }
//
// $return['status'] = "success";
// $return['msg'] = "บันทึกสำเร็จ";
// echo json_encode($return);
//

 ?>
