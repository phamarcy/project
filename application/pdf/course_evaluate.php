<?php
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/../class/manage_deadline.php');
require_once(__DIR__.'/../class/approval.php');
require_once('example_data.php');
require('fpdf17/fpdf.php');
require_once(__DIR__.'/../lib/thai_date.php');
$deadline = new Deadline();
$semester = $deadline->Get_Current_Semester();
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
	Write_temp_data($data);

	if($DATA['SUBMIT_TYPE'] == '2')
	{
		$return['status'] = "success";
		$return['msg'] = "บันทึกสำเร็จ";
		echo json_encode($return);
		die;
			// Write_temp_data($data);
	}
	else if($DATA['SUBMIT_TYPE'] == '1')
	{
		$file_path = $FILE_PATH."/draft/evaluate";
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

//start generate pdf

define('FPDF_FONTPATH','font/');

$pdf=new FPDF();

$pdf->AddPage();
$pdf->SetMargins(20,10,20,0);
$pdf->AddFont('angsa','','angsa.php');
$pdf->AddFont('angsab','','angsab.php');
$pdf->AddFont('cordiab','','cordiab.php');


$pdf->SetFont('angsab','',20);
$pdf->SetX(25);
$pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','แบบแจ้งวิธีการวัดผลและประเมิณผลการศึกษา คณะเภสัชศาสตร์'),0,1,"C");
//$pdf->SetFont('angsa','',20);
$pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','ภาคการศึกษาที่ 2 ปีการศึกษา 2560'),0,1,"C");

$pdf->SetX(20);
$pdf->SetFont('angsab','',14);
if($DATA['NORORSPE'] == "NORMAL")
{
	$nor_section = $DATA['SECTION'];
	$nor_credit = $DATA['CREDIT']['TOTAL'];
	$nor_student = $DATA['STUDENT'];
	$spe_sction = '-';
	$spe_credit = '-';
	$spe_student = '-';
}
else if($DATA['NORORSPE'] == "SPECIAL")
{
	$spe_sction = $DATA['SECTION'];
	$spe_credit = $DATA['CREDIT']['TOTAL'];
	$spe_student = $DATA['STUDENT'];
	$nor_section = '-';
	$nor_credit = '-';
	$nor_student = '-';
}
// Topic 1
$pdf->Cell(26,7,iconv( 'UTF-8','TIS-620','1. รหัสกระบวนวิชา'),0,0,"L");

$pdf->SetFont('angsa','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','   '.$DATA['COURSE_ID'].'   ตอนที่   '.$nor_section.'   จำนวนหน่วยกิจ   '.$nor_credit.'   จำนวนนักศึกษาลงทะเบียนเรียน   '.$nor_student.'   คน'),0,1,"L");

$pdf->SetFont('angsab','',14);
$pdf->SetX(30);

$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','ภาคพิเศษ'),0,0,"L");

$pdf->SetFont('angsa','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','ตอนที่   '.$spe_sction.'   จำนวนหน่วยกิจ '.$spe_credit.' จำนวนนักศึกษาลงทะเบียนเรียน   '.$spe_student.'   คน'),0,1,"L");

$pdf->SetX(20);
// $pdf->Ln();
// Topic 2
$pdf->SetFont('angsab','',14);
$pdf->Cell(40,7,iconv( 'UTF-8','TIS-620','2. ลักษณะการเรียนการสอน: '),0,0,"L");

$CHECKBOX['LEC'] = $CHECKBOX['LECLAB'] = $CHECKBOX['SPE'] = $CHECKBOX['TRA'] = $CHECKBOX['SEM'] = $CHECKBOX['LAB'] = $CHECKBOX['OTH'] = '[   ]';

switch ($DATA['TYPE_TEACHING']) {
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

$pdf->SetFont('angsa','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$CHECKBOX['LEC'].' บรรยาย'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$CHECKBOX['LECLAB'].' บรรยายและงานปฏิบัติการ'),0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620',$CHECKBOX['SPE'].' โครงงานทางเภสัชกรรม'),0);
$pdf->Ln();

$pdf->SetX(60);

$pdf->Cell(20, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['TRA'].' ฝึกงาน'), 0);
$pdf->Cell(20, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['SEM'].' สัมมนา'), 0);
$pdf->Cell(30, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['LAB'].' ปฏิบัติการ'), 0);
$pdf->Cell(10, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['OTH'].' อื่นๆ '.$DATA['TYPE_TEACHING_NAME']), 0);
$pdf->Ln();

$pdf->SetX(20);
// $pdf->Ln();
// Topic 3
$pdf->SetFont('angsab','',14);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620','3. รายชื่ออาจารย์ผู้สอน '),0,1,"L");
$pdf->SetX(35);
$pdf->SetFont('angsa','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','บรรยาย: '),0,0,"L");
$j=0;

for($i=1;$i<6;$i++)
{

	$pdf->Cell(30,7,$i < count($DATA['TEACHER']) +1  ? iconv( 'UTF-8','TIS-620',$i.') '.$DATA['TEACHER'][$i-1]) : $i.")" ,0);
	$pdf->Ln();
	$pdf->SetX(55);

}

//$pdf->Ln();

// Topic 4

$pdf->SetX(20);
$pdf->SetFont('angsab','',14);
$pdf->Cell(100,7,iconv( 'UTF-8','TIS-620','4. การวัดผลการศึกษา'),0);

$pdf->SetFont('angsa','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','สัดส่วนการให้คะแนน (ระบุเป็นร้อยละ)'),0);
$pdf->Ln();

$pdf->SetFont('angsab','',14);
$pdf->SetX(120);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','ภาคทฤษฏี'),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','ภาคปฏิบัติ'),0,0,"C");
$pdf->Ln();

$pdf->SetFont('angsa','',14);
$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','1. สอบกลางภาคฯ ครั้งที่ 1'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['MID1']['LEC'] ),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['MID1']['LAB'] ),0,0,"C");

$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','2. สอบกลางภาคฯ ครั้งที่ 2'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['MID2']['LEC'] ),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['MID2']['LAB'] ),0,0,"C");

$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','3. สอบไล่'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['FINAL']['LEC']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['FINAL']['LAB']),0,0,"C");
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','4. งานมอบหมาย '),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['WORK']['LEC']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['WORK']['LAB']),0,0,"C");
$pdf->Ln();


$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','5. อื่นๆ '.$DATA['MEASURE']['OTHER']['OTH']),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['OTHER']['LEC']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['OTHER']['LAB']),0,0,"C");
$pdf->Ln();


$pdf->SetX(40);
$pdf->SetFont('angsab','',14);
$pdf->Cell(80,7,iconv( 'UTF-8','TIS-620','รวมคะแนน'),0);
$pdf->SetFont('angsa','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['TOTAL']['LEC']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['TOTAL']['LAB']),0,0,"C");
$pdf->Ln();

$pdf->SetX(30);
$pdf->SetFont('angsa','',14);
$pdf->Write( 7 , iconv( 'UTF-8','TIS-620' , $DATA['EXAM']['SUGGESTION'] ) );
$pdf->Ln();
$pdf->Ln();

// Topic 5

$pdf->SetX(20);
$pdf->SetFont('angsab','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','5. การสอบ โปรดระบุให้ชัดเจน และครบถ้วน เพื่อใช้เป็นข้อมูลการจัดตารางสอบ (กรุณาระบุชื่ออาจารย์ที่ร่วมสอนในกระบวนวิชา'),0,1,"L");
$pdf->SetX(20);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','และจำนวนกรรมการคุมสอบอาจระบุอย่างน้อย 3 คน'),0,1,"L");

$pdf->SetFont('angsa','',14);
$pdf->SetX(25);

$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','5.1 สอบกลางภาคฯ ครั้งที่ 1  '),0,1,"L");
$pdf->SetX(55);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','จำนวน ชม.สอบ                                            กรรมการคุมสอบ'),0,1,"L");

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','TIS-620','- บรรยาย '),0,0,"L");
$pdf->Cell(15,7,$DATA['EXAM']['MID1']['HOUR']['LEC'],0 ,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($DATA['EXAM']['MID1']['COMMITTEE']['LEC']) +1  ? iconv( 'UTF-8','TIS-620',$i.') '.$DATA['EXAM']['MID1']['COMMITTEE']['LEC'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j = 0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','TIS-620','- ปฏิบัติการ '),0,0,"L");
$pdf->Cell(15,7,$DATA['EXAM']['MID1']['HOUR']['LAB'],0,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($DATA['EXAM']['MID1']['COMMITTEE']['LAB']) +1  ? iconv( 'UTF-8','TIS-620',$i.') '.$DATA['EXAM']['MID1']['COMMITTEE']['LAB'][$i-1]) : $i.")",0);
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
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','5.2 สอบกลางภาคฯ ครั้งที่ 2  '),0,1,"L");
$pdf->SetX(55);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','จำนวน ชม.สอบ                                            กรรมการคุมสอบ'),0,1,"L");
$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','TIS-620','- บรรยาย '),0,0,"L");
$pdf->Cell(15,7,$DATA['EXAM']['MID2']['HOUR']['LEC'],0 ,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($DATA['EXAM']['MID2']['COMMITTEE']['LEC']) +1  ? iconv( 'UTF-8','TIS-620',$i.') '.$DATA['EXAM']['MID2']['COMMITTEE']['LEC'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j = 0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','TIS-620','- ปฏิบัติการ '),0,0,"L");
$pdf->Cell(15,7,$DATA['EXAM']['MID2']['HOUR']['LAB'],0,0,"C");
$j=0;
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($DATA['EXAM']['MID2']['COMMITTEE']['LAB']) +1  ? iconv( 'UTF-8','TIS-620',$i.') '.$DATA['EXAM']['MID2']['COMMITTEE']['LAB'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j=0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(25);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','5.3 สอบไล่'),0,1,"L");
$pdf->SetX(55);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','จำนวน ชม.สอบ                                            กรรมการคุมสอบ'),0,1,"L");
$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','TIS-620','- บรรยาย '),0,0,"L");
$pdf->Cell(15,7,$DATA['EXAM']['FINAL']['HOUR']['LEC'],0 ,0,"C");

$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($DATA['EXAM']['FINAL']['COMMITTEE']['LEC']) +1  ? iconv( 'UTF-8','TIS-620',$i.') '.$DATA['EXAM']['FINAL']['COMMITTEE']['LEC'][$i-1]) : $i.")",0);
	$j++;
	if($j >=2)
	{
		$j=0;
		$pdf->Ln();
		$pdf->SetX(80);
	}
}

$pdf->SetX(40);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','- ปฏิบัติการ'))+2,7,iconv( 'UTF-8','TIS-620','- ปฏิบัติการ '),0,0,"L");
$j = 0 ;
$pdf->Cell(15,7,$DATA['EXAM']['FINAL']['HOUR']['LAB'],0,0,"C");
$pdf->SetX(80);
for($i=1;$i<=10;$i++)
{
	$pdf->Cell(60,7,$i < count($DATA['EXAM']['FINAL']['COMMITTEE']['LAB']) +1  ? iconv( 'UTF-8','TIS-620',$i.') '.$DATA['EXAM']['FINAL']['COMMITTEE']['LAB'][$i-1]) : $i.")",0);
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
$EVA_AF = $EVA_SU = '[   ]';
if($DATA['EVALUATE'] == 'SU')
{
	$EVA_SU = '[ / ]';
}
else if ($DATA['EVALUATE'] =='AF')
{
	$EVA_AF = '[ / ]';
}
$CAL_CRITERIA = $CAL_GROUP = '[   ]';
if($DATA['CALCULATE']['TYPE'] == 'GROUP')
{
	$CAL_GROUP = '[ / ]';
}
else if($DATA['CALCULATE']['TYPE'] = 'CRITERIA')
{
	$CAL_CRITERIA = '[ / ]';
}

$pdf->SetFont('angsab','',14);
$pdf->SetX(20);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','6. วิธีการตัดเกรด'),0,1,"L");
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620',' '.$CAL_GROUP.' อิงกลุ่ม'),0,1);
$pdf->SetX(25);
$pdf->Cell(30,7,iconv('UTF-8','TIS-620',' '.$CAL_CRITERIA.' อิงเกณฑ์'),0);
$pdf->SetFont('angsa','',14);
$pdf->Ln();

$pdf->SetFont('angsab','',14);
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','การประเมิณผล'),0,1);
$pdf->SetX(25);
$pdf->SetFont('angsa','',14);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620',' '.$EVA_SU.' ให้อักษร S หรือ U (ได้รับการอนุมัติจากมหาวิทยาลัยแล้ว)  '),0);
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620',' '.$EVA_AF.' ให้ลำดับขั้น A, B+ ,B, C+, C, D+, D, F'),0);
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'A   = ',0,0,'C');
$pdf->Cell(50,7,$DATA['CALCULATE']['A']['MIN'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนขึ้นไป '),0,0,'C');

$pdf->Cell(10,7,'D+  = ',0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['D+']['MIN'],0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['D+']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'B+  = ',0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['B+']['MIN'],0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['B+']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'D   = ',0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['D']['MIN'],0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['D']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Ln();

$pdf->SetX(35);

$pdf->Cell(10,7,'B   = ',0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['B']['MIN'],0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['B']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'F   = ',0,0,'C');
$pdf->Cell(50,7,$DATA['CALCULATE']['F']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนลงมา '),0,0,'C');
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'C+   = ',0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['C+']['MIN'],0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['C+']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'S   = ',0,0,'C');
$pdf->Cell(50,7,$DATA['CALCULATE']['S']['MIN'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนขึ้นไป '),0,0,'C');
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'C   = ',0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['C']['MIN'],0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,$DATA['CALCULATE']['C']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'U   = ',0,0,'C');
$pdf->Cell(50,7,$DATA['CALCULATE']['U']['MAX'],0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนลงมา '),0,0,'C');
$pdf->Ln();
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','อื่นๆ '),0,1);
$pdf->SetX(25);
$pdf->Write( 7 , iconv( 'UTF-8','TIS-620' ,$DATA['CALCULATE']['OTHERGRADE']) );
$pdf->Ln();
$pdf->Ln();
// Topic 7
$AB_F = $AB_U = $AB_CAL = '[   ]';
if($DATA['ABSENT'] == 'F')
{
	$AB_F = '[ / ]';
}
else if($DATA['ABSENT'] == 'U')
{
	$AB_U = '[ / ]';
}
else if($DATA['ABSENT'] == 'CAL')
{
	$AB_CAL = '[ / ]';
}


$pdf->SetFont('angsab','',14);
$pdf->SetX(20);
$pdf->Cell(65,7,iconv( 'UTF-8','TIS-620','7. นักศึกษาที่ขาดสอบในการวัดผลครั้งสุดท้าย'),0);
$pdf->SetFont('angsa','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','โดยไม่ได้รับอนุญาตให้เลื่อนการสอบตามข้อบังคับฯ ของมหาวิทยาลัยเชียงใหม่'),0);
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','ว่าด้วยการศึกษาชั้นปริญญาตรี อาจารย์ผู้สอนจะประเมิณดังนี้'),0);
$pdf->Ln();
$pdf->SetX(30);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620',$AB_F.' ให้ลำดับขั้น F    '.$AB_U.' ให้อักษร U   '.$AB_CAL.' นำคะแนนทั้งหมดที่นักศึกษาได้รับก่อนการสอบไล่มาประเมิณ'),0,1);
$pdf->SetX(25);

$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','(ผู้รับผิดชอบกระบวนวิชา)'),0,1);

//change doc status from wating for create to pending
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
	$return['msg'] = 'ไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';

}

//end change

///check if docment is approved


//if approve
$pdf->Ln();
$pdf->SetFont('angsab','',14);
$pdf->SetX(20);
$pdf->Cell(65,7,iconv( 'UTF-8','TIS-620','8. ความเห็นของหัวหน้าภาควิชา'),0);
$pdf->SetFont('angsa','',14);
$pdf->SetX(85);
$pdf->Write( 7 , iconv( 'UTF-8','TIS-620' , 'เห็นชอบ' ) );
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','(หัวหน้าภาควิชา)'),0,1);
//endif
//if not, do nothing

//save file
$pdf->Output($file_path."/".$DATA['COURSE_ID']."_evaluate.pdf","F");
echo json_encode($return);
?>
