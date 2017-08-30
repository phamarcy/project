<?php
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/database.php');
require_once(__DIR__.'/../class/course.php');
require_once(__DIR__.'/../class/approval.php');
require_once('fpdf17/fpdf.php');
require_once(__DIR__.'/../lib/thai_date.php');
define('FPDF_FONTPATH','font/');
$deadline = new Deadline();
$semester = $deadline->Get_Current_Semester();
$db = new Database();
// var_dump($_POST);
if(isset($_POST['DATA']))
{

	$data = $_POST['DATA'];
	$DATA = json_decode($data,true);
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
	if(isset($_FILES['cv']))
	{
  	$file = $_FILES['cv'];
		Upload($file,$instructor_id);
	}
	Write_temp_data($data,$instructor_id);
	if($DATA['SUBMIT_TYPE'] == '2')
	{
		$return['status'] = "success";
		$return['msg'] = "บันทึกสำเร็จ";
		echo json_encode($return);
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
	}
}
else
{
	$return['status'] = "error";
	$return['msg'] = 'ไม่มีข้อมูลนำเข้า';
	echo json_encode($return);
}
function Upload($file,$course_id,$instructor_id)
{
	global $FILE_PATH;
	$path = $FILE_PATH."/cv";
	$filename = $file['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$uploadfile = $path."/".$course_id.'_'.$instructor_id."_".$semester['semester']."_".$semester['year'].'.'.$ext;
	if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
	{
		$return['status'] = "error";
		$return['msg'] = 'ไม่สามารถบันทึกไฟล์ CV ได้';
		echo json_encode($return);
    die();
	}
}
function Write_temp_data($temp_data,$instructor_id)
{
	global $semester;
	$data = json_decode($temp_data,true);
	$path = Create_Folder($data['COURSEDATA']['COURSE_ID'],'special_instructor');
	$temp_file = fopen($path."/".$instructor_id."_".$semester['semester']."_".$semester['year'].".txt", "w");
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

//start generate pdf
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

$pdf->SetX(75);
$pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','ภาควิชา'),0,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','    '.$DATA['TEACHERDATA']['DEPARTMENT'].'     '),0,"C");
$pdf->Ln();

$pdf->SetX(60);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','ภาคการศึกษาที่'),0,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','        '.'2'.'         '),0,"C");
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','ปีการศึกษา'),0,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','        '.'2559'.'         '),0,"C");
$pdf->Ln();
#1
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','1. รายละเอียดของอาจารย์พิเศษ'),0,1);

$pdf->SetX(25);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.1 ชื่อ ')),7,iconv( 'UTF-8','TIS-620','1.1 ชื่อ '),0,"C");

$RANK = $DATA['TEACHERDATA']['PREFIX'];
$FIRSTNAME = $DATA['TEACHERDATA']['FNAME'];
$LASTNAME = $DATA['TEACHERDATA']['LNAME'];
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
$POSITION = $DATA['TEACHERDATA']['POSITION'];
$count = 155 - strlen($POSITION);
$space_position = '';
for($i=0;$i<$count;$i++)
{
	$space_position .= ' ';
}
$pdf->MultiCell( 100, 7, iconv( 'UTF-8','TIS-620',$POSITION), 0,1);
// $pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','        '.$POSITION.$space_position),0,1);

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.3 คุณวุฒิ/สาขาที่เชี่ยวชาญ ')),7,iconv( 'UTF-8','TIS-620','1.3 คุณวุฒิ/สาขาที่เชี่ยวชาญ '),0,"C");
$QUALIFICATION = $DATA['TEACHERDATA']['QUALIFICATION'];
$count = 155 - strlen($QUALIFICATION);
$space_qualification = '';
for($i=0;$i<$count;$i++)
{
	$space_qualification .= ' ';
}
$pdf->MultiCell( 100, 7, iconv( 'UTF-8','TIS-620',$QUALIFICATION), 0,1);
// $pdf->Write(7,iconv( 'UTF-8','TIS-620','    '.$QUALIFICATION.$space_qualification),0,1);
// $pdf->Ln();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','1.4 สถานที่ทำงาน/สถานที่ติดต่อ    ')),7,iconv( 'UTF-8','TIS-620','1.4 สถานที่ทำงาน/สถานที่ติดต่อ    '),0,"C");
$pdf->Ln();
$pdf->SetX(35);
$pdf->MultiCell( 140, 7, iconv( 'UTF-8','TIS-620',$DATA['TEACHERDATA']['WORKPLACE']), 0,1);
// $pdf->Ln();

$pdf->SetX(30);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรศัพท์ '.$DATA['TEACHERDATA']['TELEPHONE']["NUMBER"].' ต่อ '.$DATA['TEACHERDATA']['TELEPHONE']["SUB"])) + 5,7,iconv( 'UTF-8','TIS-620','โทรศัพท์ '.$DATA['TEACHERDATA']['TELEPHONE']["NUMBER"].' ต่อ '.$DATA['TEACHERDATA']['TELEPHONE']["SUB"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรศัพท์มือถือ '.$DATA['TEACHERDATA']["MOBILE"]))+3,7,iconv( 'UTF-8','TIS-620','โทรศัพท์มือถือ '.$DATA['TEACHERDATA']["MOBILE"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อีเมลล์ '.$DATA['TEACHERDATA']["EMAIL"])),7,iconv( 'UTF-8','TIS-620','อีเมลล์ '.$DATA['TEACHERDATA']["EMAIL"]),0,1,"C");
$pdf->SetX(32);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','กระบวนวิชานี้เป็นวิชา'))+5,7,iconv( 'UTF-8','TIS-620','หัวข้อที่เชิญมาสอน      '),0,"C");
$pdf->SetFont('ZapfDingbats','',14);
if($DATA['TEACHERDATA']['HISTORY'] == "yet")
{
	$HISTORY['yet'] = 3;
	$HISTORY['already'] = '';
}
else
{
	$HISTORY['yet'] = '';
	$HISTORY['already'] = 3;
}
$pdf->Cell(4,4, $HISTORY['yet'], 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เคยเชิญมาสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เคยเชิญมาสอน'),0);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $HISTORY['already'], 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ไม่เคยเชิญมาสอน'))+5,7,iconv( 'UTF-8','TIS-620',' ไม่เคยเชิญมาสอน'),0);
$pdf->Ln();
#2
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','2 รายละเอียดกระบวนวิชา'),0,1);

$pdf->SetX(25);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','2.1 กระบวนวิชาที่สอน    ')),9,iconv( 'UTF-8','TIS-620','2.1 กระบวนวิชาที่สอน    '),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',$DATA['COURSEDATA']['COURSE_ID'])),9,iconv( 'UTF-8','TIS-620',$DATA['COURSEDATA']['COURSE_ID']),0,1,'C');


if($DATA['COURSEDATA']['TYPE_COURSE'] == "require")
{
	$type['require'] = 3;
	$type['choose'] = '';
}
else if($DATA['COURSEDATA']['TYPE_COURSE'] == "require")
{
	$type['choose'] = 3;
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
$pdf->MultiCell( 140, 7, iconv( 'UTF-8','TIS-620',$DATA['COURSEDATA']['REASON']), 0,1);
// $pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','2.4 รายละเอียดในการสอน'),0,1);
$pdf->SetX(35);
$pdf->Cell(70,7,iconv( 'UTF-8','TIS-620','หัวข้อบรรยาย/ปฏิบัติการ '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ว/ด/ป ที่สอน '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','เวลา '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ห้องเรียน'));
$pdf->Ln();
$TOPIC[0] = 'ปัญหาด้านยาและผลิตภัณฑ์สุขภาพในเชงกฏหม';
$TOPIC[1] = 'ปัญหาด้านยาและผลิตภัณฑ์สุขภาพในเชงกฏหมายและการคุ้มครองผู้บริโภค';
for($i=0;$i<count($DATA['COURSEDATA']['DETAIL']["TOPICLEC"]);$i++)
{
	$num = $i+1;
	$pdf->SetX(30);
	$pdf->Cell(5,7,iconv('UTF-8','TIS-620',$num.'.'));
	$pdf->SetX(35);
	$before_y = $pdf->GetY();
	$before_x = $pdf->GetX();
	$pdf->MultiCell( 70, 7, iconv( 'UTF-8','TIS-620',$DATA['COURSEDATA']['DETAIL']["TOPICLEC"][$i]), 0,1);
	//$pdf->Ln();
	$current_y = $pdf->GetY();
	$current_x = $pdf->GetX();

	$pdf->SetXY($before_x + 70, $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$DATA['COURSEDATA']['DETAIL']["DATE"][$i]));

	$current_x += 30;
	$pdf->SetXY($before_x + 100, $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$DATA['COURSEDATA']['DETAIL']["TIME"]["BEGIN"][$i].' - '.$DATA['COURSEDATA']['DETAIL']["TIME"]["END"][$i]));

	$current_x += 30;
	$pdf->SetXY($before_x + 130 , $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620',$DATA['COURSEDATA']['DETAIL']["ROOM"][$i]),0,1);

	$pdf->SetXY($current_x, $current_y);


}

$pdf->SetX(32);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'))+5,7,iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'),0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620'," ".$DATA['COURSEDATA']["HOUR"]." "),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'))+5,7,iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'),0,"C");
$pdf->Ln();


#3
$pdf->SetX(20);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','3 ค่าใช้จ่าย'),0,1);

$pdf->SetX(30);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อาจารย์พิเศษเป็น '))+3,7,iconv('UTF-8','TIS-620','อาจารย์พิเศษเป็น'),0);

if($DATA["PAYMENT"]["LVLTEACHER"]["CHOICE"] == "pro")
{
	$pro = 3;
	$norm = '';
}
else if($DATA["PAYMENT"]["LVLTEACHER"]["CHOICE"] == "norm")
{
	$pro = '';
	$norm = 3;
}



$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $pro, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ข้าราชการระดับ'))+1,7,iconv( 'UTF-8','TIS-620',' ข้าราชการระดับ'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ชำนาญการ '))+5,7,iconv( 'UTF-8','TIS-620',' '.$DATA["PAYMENT"]["LVLTEACHER"]["DESCRIPT"]),0,"C");

$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $norm, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บุคคลเอกชนเทียบตำแหน่ง'))+1,7,iconv( 'UTF-8','TIS-620',' บุคคลเอกชนเทียบตำแหน่ง'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ชำนาญการ '))+2,7,iconv( 'UTF-8','TIS-620',' '.$DATA["PAYMENT"]["LVLTEACHER"]["DESCRIPT"]),0,"C");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.1 ค่าสอนพิเศษ '))+3,10,iconv('UTF-8','TIS-620','3.1 ค่าสอนพิเศษ'),0,1);

if($DATA["PAYMENT"]["COSTSPEC"]["CHOICE"] == "choice1")
{
	$choice1 = 3;
	$choice2 = '';
}
else if($DATA["PAYMENT"]["COSTSPEC"]["CHOICE"] == "choice2")
{
	$choice1 = '';
	$choice2 = 3;
}



$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice1, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ 400/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีบรรยาย '.$DATA["PAYMENT"]["COSTSPEC"]["NUMBER"].'/ชม.'),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
$pdf->Cell(13,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTSPEC"]["HOUR"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง 60 กม.ๆ ละ 4 บาท'))+50);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTSPEC"]["COST"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice2, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ 200/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีปฏิบัติการ 200/ชม.'),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
$pdf->Cell(13,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTSPEC"]["HOUR"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง 60 กม.ๆ ละ 4 บาท'))+50);
$money_position = $pdf->GetX();
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTSPEC"]["COST"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.2 ค่าพาหนะเดินทาง '))+3,10,iconv('UTF-8','TIS-620','3.2 ค่าพาหนะเดินทาง'),0,1);
$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
if($DATA["PAYMENT"]["COSTTRANS"]["TRANSPLANE"]["CHECKED"] == "true")
{
	$pdf->Cell(4,4, 3, 1,"C");
}
else
{
	$pdf->Cell(4,4, '', 1,"C");
}
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เครื่องบิน  ระหว่าง'))+1,7,iconv( 'UTF-8','TIS-620','เครื่องบิน ระหว่าง'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTTRANS"]["TRANSPLANE"]["DEPART"].' - '.$DATA["PAYMENT"]["COSTTRANS"]["TRANSPLANE"]["ARRIVE"]),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTTRANS"]["TRANSPLANE"]["COST"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();






$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
if($DATA["PAYMENT"]["COSTTRANS"]["TRANSTAXI"]["CHECKED"] == "true")
{
	$pdf->Cell(4,4, 3, 1,"C");
}
else
{
	$pdf->Cell(4,4, '', 1,"C");
}
$pdf->SetFont('THSarabun','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ค่า taxi'))+1,7,iconv( 'UTF-8','TIS-620','ค่า taxi'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTTRANS"]["TRANSTAXI"]["DEPART"].' - '.$DATA["PAYMENT"]["COSTTRANS"]["TRANSTAXI"]["ARRIVE"]),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTTRANS"]["TRANSTAXI"]["COST"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();




$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
if($DATA["PAYMENT"]["COSTTRANS"]["TRANSSELFCAR"]["CHECKED"] == "true")
{
	$pdf->Cell(4,4, 3, 1,"C");
}
else
{
	$pdf->Cell(4,4, '', 1,"C");
}
$pdf->SetFont('THSarabun','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง '.$DATA["PAYMENT"]["COSTTRANS"]["TRANSSELFCAR"]["DISTANCT"].' กม.ๆ ละ '.$DATA["PAYMENT"]["COSTTRANS"]["TRANSSELFCAR"]["UNIT"].' บาท')),7,iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง '.$DATA["PAYMENT"]["COSTTRANS"]["TRANSSELFCAR"]["DISTANCT"].' กม.ๆ ละ '.$DATA["PAYMENT"]["COSTTRANS"]["TRANSSELFCAR"]["UNIT"].' บาท'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["COSTTRANS"]["TRANSSELFCAR"]["COST"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);


$night = ' ';
$price = ' ';

if($DATA["PAYMENT"]["COSTHOTEL"]["CHOICE"] == "way1")
{
	$choice_hotel1 = 3;
	$choice_hotel2 = '';
	$unit1 = $DATA["PAYMENT"]["COSTHOTEL"]["UNIT"];
	$night = $DATA["PAYMENT"]["COSTHOTEL"]["NUMBER"];
	$price = $DATA["PAYMENT"]["COSTHOTEL"]["PERNIGHT"];
	$unit2 = ' ';

}
else if($DATA["PAYMENT"]["COSTHOTEL"]["CHOICE"] == "way2")
{
	$choice_hotel1 = '';
	$choice_hotel2 = 3;
	$unit2 = $DATA["PAYMENT"]["COSTHOTEL"]["UNIT"];
	$night = $DATA["PAYMENT"]["COSTHOTEL"]["NUMBER"];
	$price = $DATA["PAYMENT"]["COSTHOTEL"]["PERNIGHT"];
	$unit1 = ' ';

}



$pdf->AddPage();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','3.3 ค่าที่พัก '))+3,7,iconv('UTF-8','TIS-620','3.3 ค่าที่พัก'),0);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice_hotel1, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน '.$unit1.' บาท/คน/คืน'))+10,7,iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน '.$unit1.' บาท/คน/คืน'),0);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, $choice_hotel2, 1,"C");
$pdf->SetFont('THSarabun','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน '.$unit2.' บาท/คน/คืน'))+1,7,iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน '.$unit2.' บาท/คน/คืน'),0);
$pdf->Ln();
$pdf->SetX(50);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวน ')),7,iconv('UTF-8','TIS-620','จำนวน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','  '.$night),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','คืน ')),7,iconv('UTF-8','TIS-620','คืน'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$price),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);
$pdf->SetX($money_position-17);
$pdf->SetFont('THSarabun_B','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','สรุปค่าใช้จ่ายทั้งหมด'))+5,7,iconv( 'UTF-8','TIS-620',' สรุปค่าใช้จ่ายทั้งหมด'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA["PAYMENT"]["TOTALCOST"]),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);

$pdf->SetX(35);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->SetX($money_position-10);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->Ln();

$pdf->SetXY(40,$pdf->GetY()+3);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','(ผศ.ภก.ยงยุทธ เรือนทา)'),0);
$pdf->SetX($money_position-5);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','(ผศ.ภก.ยงยุทธ เรือนทา)'),0,1);
$pdf->SetX(45);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้เชิญอาจารย์พิเศษ'),0);
$pdf->SetX($money_position-5);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้รับผิดชอบกระบวนวิชา'),0,1);

$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
$pdf->SetX($money_position-17);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);

//update approval special instructor
$approve = new approval('1');
$result = $approve->Append_Special_Instructor($DATA['COURSEDATA']['COURSE_ID'],$instructor_id);
if(isset($result['error']))
{
	$return['status'] = "error";
  $return['msg'] = $result['error'];
	echo json_encode($return);
	die;
}
//end update


//check if document is approve
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(0+5,7,iconv( 'UTF-8','TIS-620',' การขอเชิญอาจารย์พิเศษนี้ได้ผ่านความเห็นชอบของกรรมการวิชาการภาควิชาฯ แล้ว เมื่อวันที่ '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0,1);

$pdf->SetX($money_position-25);
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->Ln();

$pdf->SetXY($money_position-15,$pdf->GetY()+3);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','หัวหน้าภาควิชา'),0,1);

$pdf->SetX($money_position-20);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.'10'.'   เดือน   '.'กันยายน'.'   พ.ศ.   '.'2560'),0);
$pdf->Output($file_path."/".$DATA['COURSEDATA']['COURSE_ID']."_".$instructor_id."_".$semester['semester']."_".$semester['year'].".pdf","F");

//end check

$return['status'] = "success";
$return['msg'] = "บันทึกสำเร็จ";
echo json_encode($return);
 ?>
