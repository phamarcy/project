<html>
<head>
</head>
<body>
<?php
require_once('example_data.php');
$course_id = '462452';
$section = 3;
require('fpdf17/fpdf.php');
require_once('thai_date.php');
define('FPDF_FONTPATH','font/');

$pdf=new FPDF();

$pdf->AddPage();
$pdf->SetMargins(20,10,20,0);
$pdf->AddFont('angsa','','angsa.php');
$pdf->AddFont('angsab','','angsab.php');
$pdf->SetFont('angsab','',20);

$pdf->SetX(25);   
$pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','แบบแจ้งวิธีการวัดผลและประเมิณผลการศึกษา คณะเภสัชศาสตร์'),0,1,"C");
//$pdf->SetFont('angsa','',20);
$pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','ภาคการศึกษาที่ 2 ปีการศึกษา 2560'),0,1,"C");

$pdf->SetX(20);    
$pdf->SetFont('angsab','',14);

// Topic 1
$pdf->Cell(26,7,iconv( 'UTF-8','TIS-620','1. รหัสกระบวนวิชา'),0,0,"L");

$pdf->SetFont('angsa','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','   '.$DATA['COURSE_ID'].'   ตอนที่   '.$DATA['SECTION'].'   จำนวนหน่วยกิจ   '.$DATA['CREDIT']['TOTAL'].'   ( '.$DATA['CREDIT']['LEC'].'-'.$DATA['CREDIT']['LAB'] .'-'.$DATA['CREDIT']['SELF'].'..)จำนวนนักสึกษาลงทะเบียนเรียน   '.$DATA['STUDENT'].'   คน'),0,1,"L");

$pdf->SetFont('angsab','',14);
$pdf->SetX(30);  
$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','ภาคพิเศษ'),0,0,"L");

$pdf->SetFont('angsa','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','ตอนที่...-...จำนวนหน่วยกิจ...-...(......)จำนวนนักศึกษาลงทะเบียนเรียน.....-.....คน'),0,1,"L");

$pdf->SetX(20);
$pdf->Ln();
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
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620',$CHECKBOX['LECLAB'].' บรรยายและงานปฏิบัติการทดลอง'),0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620',$CHECKBOX['SPE'].' กระบวนวิชาปัญหาพิเศษ'),0);
$pdf->Ln();

$pdf->SetX(60); 

$pdf->Cell(20, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['TRA'].' ฝึกงาน'), 0);
$pdf->Cell(20, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['SEM'].' สัมนา'), 0);
$pdf->Cell(30, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['LAB'].' ปฏิบัติการ'), 0);
$pdf->Cell(10, 7, iconv( 'UTF-8','TIS-620',$CHECKBOX['OTH'].' อื่นๆ'), 0);
$pdf->Ln();

$pdf->SetX(20);
$pdf->Ln();
// Topic 3
$pdf->SetFont('angsab','',14); 
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620','3. รายชื่ออาจารย์ผู้สอน บรรยาย: '),0,0,"L");
$j=0;
$pdf->SetFont('angsa','',14);
for($i=1;$i<12;$i++)
{

	$pdf->Cell(30,7,$i < count($DATA['TEACHER']['LEC']) +1  ? $i.' '.$DATA['TEACHER']['LEC'][$i-1] : $i."" ,0);
	$j++;
	if($j==4)
	{
		$j=0;
		$pdf->Ln();
		$pdf->SetX(70);
	}
	
}
$pdf->Ln();

$pdf->SetX(50);
$pdf->SetFont('angsab','',14); 
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','ปฏิบัติการ: '),0,0,"L");

$pdf->SetFont('angsa','',14);
$j=0;

for($i=1;$i<=12;$i++)
{

	$pdf->Cell(30,7,$i < count($DATA['TEACHER']['LAB']) +1  ? $i.' '.$DATA['TEACHER']['LAB'][$i-1] : $i."",0);
	$j++;
	if($j==4)
	{
		$j=0;
		$pdf->Ln();
		$pdf->SetX(70);
	}
	
}
$pdf->Ln();
// Topic 4

$pdf->SetX(20);
$pdf->SetFont('angsab','',14); 
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','4. การสอบ โปรดระบุให้ชัดเจน และครบถ้วน เพื่อใช้เป็นข้อมูลการจัดตารางสอบ (กรุณาระบุชื่ออาจารย์ที่ร่วมสอนในกระบวนวิชา'),0,1,"L");
$pdf->SetX(20);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','และจำนวนกรรมการคุมสอบอาจระบุอย่างน้อย 3 คน'),0,1,"L");

$pdf->SetFont('angsa','',14);
$pdf->SetX(65);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','จำนวน ชม.สอบ    กรรมการคุมสอบ'),0,1,"L");
$pdf->SetX(25);

$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','4.1 สอบกลางภาคฯ-บรรยาย '),0,0,"L");
$pdf->SetX(65);
$pdf->Cell(23,7,$DATA['EXAM']['MID']['HOUR']['LEC'],0 ,0,"C");
for($i=1;$i<=4;$i++)
{
	$pdf->Cell(20,7,$i < count($DATA['EXAM']['MID']['COMMITTEE']['LEC']) +1  ? $i.' '.$DATA['EXAM']['MID']['COMMITTEE']['LEC'][$i-1] : $i."",0);
}
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','แยกห้องกันคุม'),0);
$pdf->Ln();

$pdf->SetX(48);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','-ปฏิบัติการ '),0,0,"L");

$pdf->SetX(65);
$pdf->Cell(23,7,$DATA['EXAM']['MID']['HOUR']['LAB'],0,0,"C");
for($i=1;$i<=5;$i++)
{
	$pdf->Cell(20,7,$i < count($DATA['EXAM']['MID']['COMMITTEE']['LAB']) +1  ? $i.' '.$DATA['EXAM']['MID']['COMMITTEE']['LAB'][$i-1] : $i."",0);
}
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','4.2 สอบไล่'),0,0,"L");

$pdf->SetX(48);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','-บรรยาย '),0,0,"L");

$pdf->SetX(65);
$pdf->Cell(23,7,$DATA['EXAM']['FINAL']['HOUR']['LEC'],0 ,0,"C");
for($i=1;$i<=4;$i++)
{
	$pdf->Cell(20,7,$i < count($DATA['EXAM']['FINAL']['COMMITTEE']['LEC']) +1  ? $i.' '.$DATA['EXAM']['FINAL']['COMMITTEE']['LEC'][$i-1] : $i."",0);
}
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','แยกห้องกันคุม'),0);
$pdf->Ln();

$pdf->SetX(48);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','-ปฏิบัติการ '),0,0,"L");

$pdf->SetX(65);
$pdf->Cell(23,7,$DATA['EXAM']['FINAL']['HOUR']['LAB'],0,0,"C");
for($i=1;$i<=5;$i++)
{
	$pdf->Cell(20,7,$i < count($DATA['EXAM']['FINAL']['COMMITTEE']['LAB']) +1  ? $i.' '.$DATA['EXAM']['FINAL']['COMMITTEE']['LAB'][$i-1] : $i."",0);
}
$pdf->Ln();

$pdf->Ln();
// Topic 5
$SUMSCORE['LEC'] = 0;
$SUMSCORE['LAB'] = 0;

$pdf->SetX(20);
$pdf->SetFont('angsab','',14); 
$pdf->Cell(100,7,iconv( 'UTF-8','TIS-620','5. การวัดผลการศึกษา'),0);

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
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','1. สอบกลางภาคการศึกษา'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['MID']['LEC'] ),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['MID']['LAB'] ),0,0,"C");
$SUMSCORE['LEC'] += $DATA['MEASURE']['MID']['LEC'];
$SUMSCORE['LAB'] += $DATA['MEASURE']['MID']['LAB'];
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','2. สอบไล่'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['FINAL']['LEC']),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['FINAL']['LAB']),0,0,"C");
$SUMSCORE['LEC'] += $DATA['MEASURE']['FINAL']['LEC'];
$SUMSCORE['LAB'] += $DATA['MEASURE']['FINAL']['LAB'];
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell(95,7,iconv( 'UTF-8','TIS-620','3. อื่นๆ โปรดระบุ'),0);
$pdf->Ln();

for($i=0;$i<count($DATA['MEASURE']['OTHER']);$i++)
{
	$pdf->SetX(35);
	$pdf->Cell(85,7,iconv( 'UTF-8','TIS-620','- '.$DATA['MEASURE']['OTHER'][$i]['NAME']),0,0);
	$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['OTHER'][$i]['LEC']),0,0,"C");
	$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',$DATA['MEASURE']['OTHER'][$i]['LAB']),0,0,"C");
	$SUMSCORE['LEC'] += $DATA['MEASURE']['OTHER'][$i]['LEC'];
	$SUMSCORE['LAB'] += $DATA['MEASURE']['OTHER'][$i]['LAB'];
	$pdf->Ln();
}

$pdf->Ln();

$pdf->SetX(30);
$pdf->SetFont('angsab','',16); 
$pdf->Write( 7 , iconv( 'UTF-8','TIS-620' , $DATA['MEASURE']['COMMENT'] ) );
$pdf->Ln();
$pdf->Ln();

$pdf->SetX(40);
$pdf->SetFont('angsab','',14); 
$pdf->Cell(80,7,iconv( 'UTF-8','TIS-620','รวมคะแนน'),0);
$pdf->SetFont('angsa','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',number_format($SUMSCORE['LEC'], 1, '.', '')),0,0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',number_format($SUMSCORE['LAB'], 1, '.', '')),0,0,"C");

$pdf->AddPage();
$pdf->SetMargins(20,10,10,0);
$pdf->SetFont('angsab','',14); 
$pdf->Cell(30,7,'','LT',0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','กระบวนวิชาสัมนา'),'T','C',0);
$pdf->Cell(30,7,'','RT',0);
$pdf->Cell(30,7,'','LT',0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ฝึกปฏิบัติ/ปัญหาพิเศษ'),'T','C',0);
$pdf->Cell(30,7,'','RT',0);
$pdf->Ln();

$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','กิจกรรม'),'LT','C',0);
$pdf->Cell(30,7,'','RT',0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','สัดส่วนการให้คะแนน'),'T',0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','กิจกรรม'),'LT','C',0);
$pdf->Cell(30,7,'','RT',0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','สัดส่วนการให้คะแนน'),'TR',0);
$pdf->Ln();

$count_seminar = count($DATA['SEMINAR']);
$count_training = count($DATA['TRAIN']);
$max = 4;
if($count_seminar >= $count_training)
{
	$max = $count_seminar;
}
else
{
	$max = $count_training;
}
$SUMSCORE['SEMINAR'] = 0;
$SUMSCORE['TRAIN'] = 0;
//calculate score
for($i=0;$i<$count_seminar;$i++)
{
	$SUMSCORE['SEMINAR'] += $DATA['SEMINAR'][$i]['SCORE'];
}
for($i=0;$i<$count_training;$i++)
{
	$SUMSCORE['TRAIN'] += $DATA['TRAIN'][$i]['SCORE'];
}

for($i=0;$i<$max;$i++)
{
	$pdf->Cell(60,7,iconv( 'UTF-8','TIS-620',$i < $count_seminar ? $DATA['SEMINAR'][$i]['NAME'] : ''),'LTR',0); #ชื่อวิชาสัมมนา
	$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620',$i < $count_seminar ? $DATA['SEMINAR'][$i]['SCORE'] :''),'T',0,"C"); #คะแนนวิชาสัมมนา
	$pdf->Cell(60,7,iconv( 'UTF-8','TIS-620',$i < $count_training ? $DATA['TRAIN'][$i]['NAME'] :''),'LTR',0); #ชื่อปฏิบัติ
 	$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620',$i < $count_training ? $DATA['TRAIN'][$i]['SCORE']  :''),'TR',0,"C"); #คะแนนปฏิบัติ
	$pdf->Ln();
}

$pdf->Cell(30,7,'','LT',0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','รวมคะแนน'),'RT','R',0);
$pdf->Cell(30,7,number_format($SUMSCORE['SEMINAR'], 1, '.', ''),'T',0,"C");
$pdf->Cell(30,7,'','LT',0);
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','รวมคะแนน'),'RT','R',0);
$pdf->Cell(30,7,number_format($SUMSCORE['TRAIN'], 1, '.', ''),'RT',0,"C");
$pdf->Ln();

$pdf->Cell(180,7,'','T',0);

$pdf->Ln();
// Topic 6
$pdf->SetFont('angsab','',14); 
$pdf->SetX(20);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','6. การประเมิณผล'),0,1,"L");
$pdf->SetX(25);
$pdf->SetFont('angsa','',14); 
$pdf->Cell(0,7,iconv('UTF-8','TIS-620',' [  ] ให้อักษร S หรือ U (ได้รับการอนุมัติจากมหาวิทยาลัยแล้ว  [  ] ให้ลำดับขั้น A, B+ ,B, C+, C, D+, D, F'),0);
$pdf->Ln();

$pdf->SetFont('angsab','',14);
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วิธีการตัดเกรด'),0,1);
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620',' [   ] อิงกลุ่ม'),0,1);
$pdf->SetX(25);
$pdf->Cell(30,7,iconv('UTF-8','TIS-620',' [ / ] อิงเกณฑ์'),0);
$pdf->SetFont('angsa','',14); 
$pdf->Cell(30,7,iconv('UTF-8','TIS-620','ได้กำหนดเกณฑ์ดังต่อไปนี้'),0);
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'A   = ',0,0,'C');
$pdf->Cell(50,7,'...> 80.0...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนขึ้นไป '),0,0,'C');

$pdf->Cell(10,7,'D+  = ',0,0,'C');
$pdf->Cell(20,7,'...55.0...',0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,'...59.9...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'B+  = ',0,0,'C');
$pdf->Cell(20,7,'...75.0...',0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,'...79.9...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'D   = ',0,0,'C');
$pdf->Cell(20,7,'...55.0...',0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,'...54.9...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Ln();

$pdf->SetX(35);

$pdf->Cell(10,7,'B   = ',0,0,'C');
$pdf->Cell(20,7,'...70.0...',0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,'...74.9...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'F   = ',0,0,'C');
$pdf->Cell(50,7,'...< 50.0...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนลงมา '),0,0,'C');
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'C+   = ',0,0,'C');
$pdf->Cell(20,7,'...65.0...',0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,'...69.9...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'S   = ',0,0,'C');
$pdf->Cell(50,7,'.........................',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนขึ้นไป '),0,0,'C');
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(10,7,'C   = ',0,0,'C');
$pdf->Cell(20,7,'...60.0...',0,0,'C');
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','  ถึง  '),0,0,'C');
$pdf->Cell(20,7,'...64.9...',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนน'),0,0,'C');

$pdf->Cell(10,7,'U   = ',0,0,'C');
$pdf->Cell(50,7,'.........................',0,0,'C');
$pdf->Cell(20,7,iconv('UTF-8','TIS-620','คะแนนลงมา '),0,0,'C');
$pdf->Ln();
$pdf->Ln();
// Topic 7
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
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','[ / ] ให้ลำดับขั้น F  [   ] ให้อักษร U [   ] นำคะแนนทั้งหมดที่นักศึกษาได้รับก่อนการสอบไล่มาประเมิณ'),0,1);
$pdf->SetX(25);

$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
$pdf->Ln();

$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','(ผู้รับผิดชอบกระบวนวิชา)'),0,1);

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

echo $THAI_WEEK[date("w")] ,"ที่",date(" j "), $THAI_MONTH[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543,"<br>"; 
$pdf->Output("MyPDF.pdf","F");
?>
PDF Created Click <a href="MyPDF.pdf" >here</a> to Download
</body>
</html>